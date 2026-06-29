<?php
session_start();
// --- HÀM GỌI API DÙNG CHUNG CHO NHÓM ---
function callAPI($url, $data = null)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Nếu có dữ liệu gửi đi (như ma_sv), tự động chuyển sang chế độ POST
    if ($data) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    }

    $response = curl_exec($ch);

    // Kiểm tra lỗi kết nối nếu có
    if (curl_errno($ch)) {
        return array("status" => "error", "message" => curl_error($ch));
    }

    curl_close($ch);
    return json_decode($response, true);
}
// --- KẾT THÚC HÀM ---
require_once 'Model/lop.php';
require_once 'Model/sinhvien.php';
require_once 'Model/Diemchitiep.php';
require_once 'Model/diemhocpham.php';
require_once 'Model/monhocphan.php';
require_once 'Model/hocky.php';

// 1. Kiểm tra đăng nhập cơ bản để bảo vệ toàn bộ Controller
if (!isset($_SESSION['username'])) {
    header('location:index.php?controllers=login');
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : NULL;

switch ($action) {
    case 'List_Diem': // Trang xem bảng điểm chi tiết
        if (isset($_GET['maSV'])) {
            $maSV = $_GET['maSV'];

            // BẢO MẬT: Giữ nguyên logic cũ của bạn
            if ($_SESSION['quyen'] != 1 && $maSV != $_SESSION['ma_sv']) {
                $maSV = $_SESSION['ma_sv'];
            }

            // --- ĐOẠN SỬA SANG API ---
            $url = "http://localhost/Quan_ly_diem/api/get_diem.php";
            $dataPost = array("ma_sv" => $maSV);

            // Gọi hàm callAPI (Nhớ copy hàm này vào đầu file hoặc dùng helpers.php)
            $res = callAPI($url, $dataPost);


            if ($res && $res['status'] == "success") {
                $dHP = $res['data']; // Mảng điểm từ API trả về

                // Nếu có tìm kiếm môn học, chúng ta lọc mảng ngay tại đây
                if (isset($_GET['gtTimkiem']) && !empty($_GET['gtTimkiem'])) {
                    $key = strtolower($_GET['gtTimkiem']);
                    $dHP = array_filter($dHP, function ($item) use ($key) {
                        return strpos(strtolower($item['ten_mon']), $key) !== false ||
                            strpos(strtolower($item['ma_mon']), $key) !== false;
                    });
                }
            } else {
                $dHP = []; // Nếu lỗi API hoặc không có điểm
            }
        }
        require_once 'View/Diem/list_diem.php';
        break;

    case 'Dashboard_SV':
        $maSV = $_SESSION['ma_sv'];

        // GỌI API THAY CHO Model
        $url = "http://localhost/Quan_ly_diem/api/get_diem.php";
        $res = callAPI($url, ["ma_sv" => $maSV]);
        $sv_tc_sv = ($res && $res['status'] == "success") ? $res['data'] : [];

        $TongSTC = 0;
        $TongHDS = 0;
// ... Giữ nguyên đoạn foreach tính toán GPA bên dưới của bạn ...

    case 'Thong_ke_ca_nhan':
        $maSV = $_SESSION['ma_sv'];

        // GỌI API THAY CHO Model (Sửa lỗi sót bài)
        $url = "http://localhost/Quan_ly_diem/api/get_diem.php";
        $res = callAPI($url, ["ma_sv" => $maSV]);
        $sv_tc_sv = ($res && $res['status'] == "success") ? $res['data'] : [];

        $TongSTC = 0;
        // ... phần dưới giữ nguyên ...
        if ($sv_tc_sv) {
            foreach ($sv_tc_sv as $value) {
                $diemHP = round(($value['diem_giua_ky'] * 0.3) + ($value['diem_thi_hp'] * 0.7), 1);

                // LOGIC CẬP NHẬT: Chỉ tính điểm trung bình trên các môn đã qua
                if ($value['diem_thi_hp'] >= 2 && $diemHP >= 4) {
                    $TongSTC += $value['sotinchi'];
                    $TongHDS += ($value['sotinchi'] * TongDiemChitiet::HDS($diemHP));
                }
            }
        }
        $gpa = ($TongSTC > 0) ? round($TongHDS / $TongSTC, 2) : 0;
        $xep_loai = TongDiemChitiet::XL_TK($gpa);

        require_once 'View/Diem/thong_ke_ca_nhan.php';
        break;

    case 'List_Thi_Lai_SV':
        $maSV = $_SESSION['ma_sv'];

        // Gọi API lấy tất cả điểm
        $url = "http://localhost/Quan_ly_diem/api/get_diem.php";
        $res = callAPI($url, ["ma_sv" => $maSV]);
        $all_diem = ($res && $res['status'] == "success") ? $res['data'] : [];

        // Tự lọc môn thi lại ngay trên Controller cho nhanh
        $list_thi_lai = array_filter($all_diem, function ($v) {
            $diemHP = round(($v['diem_giua_ky'] * 0.3) + ($v['diem_thi_hp'] * 0.7), 1);
            return ($v['diem_thi_hp'] < 2 || $diemHP < 4);
        });

        require_once 'View/Diem/list_thi_lai_sv.php';
        break;

    // --- NHÓM CHỨC NĂNG DÀNH RIÊNG CHO ADMIN (QUYEN = 1) ---
    case 'Add_Diem_HP':
    case 'Edit_Diem_HP':
    case 'Delete_Diem_HP':
    case 'QL_Diem':
    case 'Tonghopdiem':
    case 'Thong_ke':
    case 'GPA_Tung_Ky':
    case 'Thong_ke_hoc_lai':
    case 'Export_Excel_Hoc_Lai':
        if ($_SESSION['quyen'] != 1) {
            header('location:index.php?controllers=diem&action=Dashboard_SV');
            exit();
        }

       if ($action == 'Add_Diem_HP') {
            $list_sv = Sinhvien::List();
            $list_hp = MonHP::List();
            $maSV_ready = isset($_GET['maSV']) ? $_GET['maSV'] : NULL;
            $maMon_ready = isset($_GET['maMon']) ? $_GET['maMon'] : NULL;
            $tenMon_hien_thi = "";

            if ($maMon_ready) {
                foreach ($list_hp as $hp) {
                    if ($hp['ma_mon'] == $maMon_ready) {
                        $tenMon_hien_thi = $hp['ten_mon'];
                        break;
                    }
                }
            }

            if (isset($_POST['themDiem'])) {
                $sv_post = !empty($_POST['sellist1']) ? $_POST['sellist1'] : $maSV_ready;
$mon_post = !empty($_POST['sellist2']) ? $_POST['sellist2'] : $maMon_ready;

                // --- ĐOẠN CẬP NHẬT GỌI API CHO POST_DIEM ---
                $url = "http://localhost/Quan_ly_diem/api/post_diem.php";
                $payload = array(
                    "ma_sv" => $sv_post,
                    "ma_mon" => $mon_post,
                    "diem_giua_ky" => $_POST['txt_diemGK'],
                    "diem_thi_hp" => $_POST['txt_diemTHK']
                );

                $res = callAPI($url, $payload);

                if ($res && $res['status'] == "success") {
                    $maLopBack = isset($_GET['maLop']) ? $_GET['maLop'] : '';
                    $maHKBack = isset($_GET['maHK']) ? $_GET['maHK'] : '';
                    header("location:index.php?controllers=diem&action=QL_Diem&maHK=$maHKBack&maLop=$maLopBack&maMon=$mon_post");
                    exit();
                } else {
                    // Nếu API trả về lỗi hoặc message thất bại
                    $thatbai = isset($res['message']) ? $res['message'] : "Thêm điểm thất bại";
                }
            }
            require_once 'View/Diem/add_diem.php';
       } elseif ($action == 'Edit_Diem_HP') {
    if (isset($_GET['maMon'])) {
        $text_masv = $_GET['maSV'];
        $text_mamon = $_GET['maMon'];
        $list_diem_lop_sinhvien = DiemMHP::D_M_SV($text_masv, $text_mamon);

        if (isset($_POST['suaDiem'])) {
            // --- ĐOẠN GỌI API EDIT ---
            $url = "http://localhost/Quan_ly_diem/api/edit_diem.php";
            $payload = [
                "ma_sv" => $text_masv,
                "ma_mon" => $text_mamon,
                "diem_giua_ky" => $_POST['txt_diemGK'],
                "diem_thi_hp" => $_POST['txt_diemTHK']
            ];

            $res = callAPI($url, $payload);

            if ($res && $res['status'] == "success") {
                $maLop = isset($_GET['maLop']) ? $_GET['maLop'] : '';
                $maHK = isset($_GET['maHK']) ? $_GET['maHK'] : '';
                header("location:index.php?controllers=diem&action=QL_Diem&maHK=$maHK&maLop=$maLop&maMon=$text_mamon");
                exit();
            } else {
                $error_msg = $res['message'] ?? "Sửa điểm thất bại";
            }
            
        }
    }
    require_once 'View/Diem/edit_diem.php';

        } elseif ($action == 'Delete_Diem_HP') {
    if (isset($_GET['maMon'])) {
        $maSV_del = $_GET['maSV'];
        $maMon_del = $_GET['maMon'];

        // --- ĐOẠN GỌI API DELETE ---
        $url = "http://localhost/Quan_ly_diem/api/delete_diem.php";
        $payload = [
            "ma_sv" => $maSV_del,
            "ma_mon" => $maMon_del
        ];

        $res = callAPI($url, $payload);

        if ($res && $res['status'] == "success") {
            $maLop = isset($_GET['maLop']) ? $_GET['maLop'] : '';
            $maHK = isset($_GET['maHK']) ? $_GET['maHK'] : '';
// Sau khi xóa thành công, quay lại trang quản lý điểm
            header("location:index.php?controllers=diem&action=QL_Diem&maHK=$maHK&maLop=$maLop&maMon=$maMon_del");
            exit();
        } else {
            // Có thể dùng thông báo javascript hoặc biến $error để hiển thị lỗi
            $error_del = $res['message'] ?? "Xóa điểm thất bại";
        }
        // --- KẾT THÚC API ---
    }

        } elseif ($action == 'QL_Diem') {
            $list_hk = MonHP::List_HK();
            $list_lop = MonHP::List_Lop();
            $maHK = isset($_REQUEST['maHK']) ? $_REQUEST['maHK'] : NULL;
            $maLop = isset($_REQUEST['maLop']) ? $_REQUEST['maLop'] : NULL;
            $maMon = isset($_REQUEST['maMon']) ? $_REQUEST['maMon'] : NULL;

            $list_mon = ($maHK && $maLop) ? MonHP::List_By_HK_Lop($maHK, $maLop) : [];
            $list_sv_chua_diem = ($maMon && $maLop) ? DiemMHP::SinhVien_ChuaNhapDiem($maLop, $maMon) : [];
            $list_sv_da_diem = ($maMon && $maLop) ? DiemMHP::SinhVien_DaNhapDiem($maLop, $maMon) : [];

            require_once 'View/Diem/xl_diem.php';
        } elseif ($action == 'GPA_Tung_Ky') {
            if (isset($_GET['maSV'])) {
                $maSV = $_GET['maSV'];
                $data = DiemMHP::Diem_GPA_Theo_HocKy($maSV);
                $sv_info = Sinhvien::GetId($maSV);
                $hk_gpa = [];
                if ($data) {
                    foreach ($data as $row) {
                        $maHK = $row['ma_hk'];
                        $diemHP = round(($row['diem_giua_ky'] * 0.3) + ($row['diem_thi_hp'] * 0.7), 1);
                        if (!isset($hk_gpa[$maHK])) {
                            $hk_gpa[$maHK] = [
                                'ten_hk' => $row['ten_hk'],
                                'tong_diem_he_10' => 0,
                                'tong_tin_chi' => 0,
                                'chi_tiet_mon' => []
                            ];
                        }
                        $hk_gpa[$maHK]['tong_diem_he_10'] += ($diemHP * $row['sotinchi']);
                        $hk_gpa[$maHK]['tong_tin_chi'] += $row['sotinchi'];
                        $hk_gpa[$maHK]['chi_tiet_mon'][] = $row;
                    }
                }
            }
            require_once 'View/Diem/v_gpa_hocky.php';
        } elseif ($action == 'Tonghopdiem') {
            $list_lop = Lop::List();
            if (isset($_POST["Hienthi"]))
                $list_lop_sinhvien = Lop::Lop_Sinhvien($_POST['txt_malop']);
            if (isset($_POST["xem"])) {
                if (isset($_POST['txt_masinhvien'])) {
                    $sv = Sinhvien::GetId($_POST['txt_masinhvien']);
                    $ttDiem = TongDiemChitiet::TDiem($_POST['txt_masinhvien']);
                }
            }
            require_once 'View/Tonghopdiemsinhvien.php';
        } elseif ($action == 'Thong_ke') { // Thống kê hệ thống cho Admin
$sv = Sinhvien::List();
            $listhocky = Hocky::List();
            $maHK_filter = isset($_GET['maHK']) ? $_GET['maHK'] : NULL;

            if ($sv) {
                foreach ($sv as $key => $value) {
                    $ma_sv_hien_tai = $value['ma_sv'];
                    $sv_tc_sv = TongDiemChitiet::TDiem($ma_sv_hien_tai);
                    $TongSTC = 0;
                    $TongHDS = 0;
                    if ($sv_tc_sv) {
                        foreach ($sv_tc_sv as $diem) {
                            if ($maHK_filter == NULL || $diem['ma_hk'] == $maHK_filter) {
                                $diemHP = round(($diem['diem_giua_ky'] * 0.3) + ($diem['diem_thi_hp'] * 0.7), 1);

                                // LOGIC CẬP NHẬT: Admin cũng chỉ thấy kết quả tích lũy của các môn đã đạt
                                if ($diem['diem_thi_hp'] >= 2 && $diemHP >= 4) {
                                    $TongSTC += $diem['sotinchi'];
                                    $TongHDS += ($diem['sotinchi'] * TongDiemChitiet::HDS($diemHP));
                                }
                            }
                        }
                    }
                    $tbtk = ($TongSTC > 0) ? round($TongHDS / $TongSTC, 2) : 0;
                    $sv[$key]['STC'] = $TongSTC;
                    $sv[$key]['TB_Toankhoa'] = $tbtk;
                    $sv[$key]['XL_Toankhoa'] = TongDiemChitiet::XL_TK($tbtk);
                }
            }
            require_once 'View/thongke.php';
        } elseif ($action == 'Thong_ke_hoc_lai') {
            $list_hk = MonHP::List_HK();
            $list_lop = MonHP::List_Lop();
            $maHK = isset($_GET['maHK']) ? $_GET['maHK'] : NULL;
            $maLop = isset($_GET['maLop']) ? $_GET['maLop'] : NULL;
            $maMon = isset($_GET['maMon']) ? $_GET['maMon'] : NULL;
            $list_mon = ($maHK && $maLop) ? MonHP::List_By_HK_Lop($maHK, $maLop) : [];
            $list_hoc_lai = ($maMon) ? DiemMHP::List_Hoc_Lai($maMon) : [];
            require_once 'View/Diem/thong_ke_hoc_lai.php';
        } elseif ($action == 'Export_Excel_Hoc_Lai') {
            if (isset($_GET['maMon'])) {
                $maMon = $_GET['maMon'];
                $list_hoc_lai = DiemMHP::List_Hoc_Lai($maMon);
                $filename = "Danh_sach_thi_lai_" . $maMon . "_" . date('Ymd') . ".csv";
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                $output = fopen('php://output', 'w');
                fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
                fputcsv($output, array('STT', 'Mã Sinh Viên', 'Họ và Tên', 'Điểm Thi HP', 'Điểm TBHP', 'Lý do'));
                if (!empty($list_hoc_lai)) {
                    $stt = 1;
                    foreach ($list_hoc_lai as $sv) {
$tbhp = round(($sv['diem_giua_ky'] * 0.3) + ($sv['diem_thi_hp'] * 0.7), 1);
                        $ly_do = "Học lại";
                        fputcsv($output, array($stt++, $sv['ma_sv'], $sv['hoten_sv'], $sv['diem_thi_hp'], $tbhp, $ly_do));
                    }
                }
                fclose($output);
                exit();
            }
        }
        break;

    default:
        echo "Trang không tồn tại";
        break;
}
?>