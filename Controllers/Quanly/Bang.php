<?php
session_start();
function callAPI($url, $data)
{
    $ch = curl_init($url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}
require_once 'Model/dangnhap.php';
require_once 'Model/lop.php';
require_once 'Model/sinhvien.php';
require_once 'Model/Diemchitiep.php';
require_once 'Model/hocky.php';
require_once 'Model/monhocphan.php';

// 1. Kiểm tra đăng nhập và phân quyền Admin
if (!isset($_SESSION['username'])) {
    header('location:index.php?controllers=login');
    exit();
}

// Chỉ Admin mới được vào Controller này
if ($_SESSION['quyen'] != 1) {
    header('location:index.php?controllers=diem&action=Dashboard_SV');
    exit();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = NULL;
}

switch ($action) {
    // TÌM KIẾM SINH VIÊN (Dành cho Admin)
    case 'Seach':
        $gtTimkiem = isset($_GET['gtTimkiem']) ? $_GET['gtTimkiem'] : '';

        if (!empty($gtTimkiem)) {
            // Sau này Người số 2 viết thêm api/search_sinhvien.php thì thay vào đây
            // Còn hiện tại có thể gọi API tổng rồi lọc, hoặc vẫn để tạm Model nếu chưa kịp viết API Search
            $list_sv = Sinhvien::Search($gtTimkiem);
        } else {
            // Gọi lại API tổng đã chạy ngon
            $url = "http://web/api/get_sinhvien.php";
            $res = callAPI($url, null);
            $list_sv = ($res['status'] == "success") ? $res['data'] : [];
        }
        require_once 'View/masster/admin.php';
        break;

    // xử lý lớp
    case 'List_lop':
        $url = "http://web/api/get_lop.php";
        $res = callAPI($url, null);
        $listlop = ($res && isset($res['status']) && $res['status'] == "success") ? $res['data'] : [];

        $time = Lop::getTime(); // Giữ lại hàm lấy thời gian gốc của nhóm
        require_once 'View/Bang/tbl_lop_list.php';
        break;

    case 'Add_lop':
        if (isset($_POST['themLop'])) {
            $data = [
                'malop' => $_POST['txt_malop'],
                'tenlop' => $_POST['txt_tenlop']
            ];
            $url = "http://web/api/add_lop.php";

            // Gọi hàm callAPI gốc (tự động dùng POST)
            $res = callAPI($url, $data);

            if ($res && isset($res['status']) && $res['status'] == "success") {
                header("location:index.php?controllers=quanly&action=List_lop");
            } else {
                // Hứng thông báo lỗi từ API (VD: "Mã lớp đã tồn tại!")
                $thatbai = $res['message'] ?? "Thêm thất bại!";
            }
        }
        require_once 'View/Bang/tbl_lop_add.php';
        break;

    case 'Edit_lop':
        if (isset($_GET['maLop'])) {
            $maLop = $_GET['maLop'];
            $list_id_lop = Lop::List_id($maLop); // Lấy data cũ hiển thị lên form

            if (isset($_POST['suaLop'])) {
                $data = [
                    'malop_new' => $_POST['txt_malop'],
                    'tenlop' => $_POST['txt_tenlop'],
                    'malop_old' => $maLop
                ];
                $url = "http://web/api/edit_lop.php";

                // Gọi hàm callAPI gốc
                $res = callAPI($url, $data);

                if ($res && isset($res['status']) && $res['status'] == "success") {
                    header("location:index.php?controllers=quanly&action=List_lop");
                } else {
                    $thatbai = $res['message'] ?? "Sửa thất bại!";
                }
            }
        }
        require_once 'View/Bang/tbl_lop_edit.php';
        break;

    case 'Delete_lop':
        if (isset($_GET['maLop'])) {
            $data = ['maLop' => $_GET['maLop']];
            $url = "http://web/api/delete_lop.php";

            // Gọi hàm callAPI gốc
            $res = callAPI($url, $data);

            if ($res && isset($res['status']) && $res['status'] == "success") {
                header("location:index.php?controllers=quanly&action=List_lop");
            } else {
                // Hiển thị lỗi nếu có (VD: "Mã lớp không tồn tại")
                echo "Lỗi: " . ($res['message'] ?? "Không thể xóa");
            }
        }
        break;

    // xử lý học kỳ
    case 'list_hocky':
        $url = "http://web/api/get_hocky.php";
        $res = callAPI($url, null);
        $listhocky = ($res && isset($res['status']) && $res['status'] == "success") ? $res['data'] : [];

        require_once 'View/Bang/tbl_hocky_list.php';
        break;

    case 'Add_hocky':
        if (isset($_POST['themHocky'])) {
            $data = [
                'mahocky' => $_POST['txt_mahocky'],
                'tenhocky' => $_POST['txt_tenhocky']
            ];
            $url = "http://web/api/add_hocky.php";
            $res = callAPI($url, $data);

            if ($res && isset($res['status']) && $res['status'] == "success") {
                header("location:index.php?controllers=quanly&action=list_hocky");
            } else {
                $thatbai = $res['message'] ?? "Thêm thất bại!";
            }
        }
        require_once 'View/Bang/tbl_hocky_add.php';
        break;

    case 'Edit_hocky':
        if (isset($_GET['maHocky'])) {
            $maHocky = $_GET['maHocky'];
            $list_id_hocky = Hocky::List_id($maHocky);

            if (isset($_POST['suaHocky'])) {
                $data = [
                    'mahocky_new' => $_POST['txt_mahocky'],
                    'tenhocky' => $_POST['txt_tenhocky'],
                    'mahocky_old' => $maHocky
                ];
                $url = "http://web/api/edit_hocky.php";
                $res = callAPI($url, $data);

                if ($res && isset($res['status']) && $res['status'] == "success") {
                    header("location:index.php?controllers=quanly&action=list_hocky");
                } else {
                    $thatbai = $res['message'] ?? "Sửa thất bại!";
                }
            }
        }
        require_once 'View/Bang/tbl_hocky_edit.php';
        break;

    case 'Delete_hocky':
        if (isset($_GET['maHocky'])) {
            $data = ['maHocky' => $_GET['maHocky']];
            $url = "http://web/api/delete_hocky.php";
            $res = callAPI($url, $data);

            if ($res && isset($res['status']) && $res['status'] == "success") {
                header("location:index.php?controllers=quanly&action=list_hocky");
            } else {
                echo "Lỗi: " . ($res['message'] ?? "Không thể xóa");
            }
        }
        break;
    // XỬ LÝ HỌC PHẦN (ĐÃ CẬP NHẬT THEO LỚP)
    case 'list_hocphan':
        $url = "http://web/api/get_hocphan.php";
        $res = callAPI($url, null);

        $listhocphan = ($res && isset($res['status']) && $res['status'] == "success")
            ? $res['data']
            : [];

        require_once 'View/Bang/tbl_hocphan_list.php';
        break;


    case 'Add_hocphan':
        $listhocky = Hocky::List();
        $list_lop = Lop::List();

        if (isset($_POST['themHocphan'])) {

            $data = [
                'maHocphan' => $_POST['txt_maHocphan'],
                'tenHocphan' => $_POST['txt_tenHocphan'],
                'stc' => $_POST['txt_stc'],
                'maHocky' => $_POST['sellist1'],
                'maLop' => $_POST['sellist_lop']
            ];

            $url = "http://web/api/add_hocphan.php";

            // Gọi API
            $res = callAPI($url, $data);

            if ($res && isset($res['status']) && $res['status'] == "success") {

                header("location:index.php?controllers=quanly&action=list_hocphan");
                exit();

            } else {

                $thatbai = $res['message'] ?? "Thêm học phần thất bại!";
            }
        }

        require_once 'View/Bang/tbl_hocphan_add.php';
        break;


    case 'Edit_hocphan':

        if (isset($_GET['maMon'])) {

            $maMon = $_GET['maMon'];

            $listhocky = Hocky::List();
            $list_lop = Lop::List();

            // Lấy dữ liệu cũ
            $list_id_hocphan = MonHP::id_DHP($maMon);

            if (isset($_POST['suaHocphan'])) {

                $data = [

                    'maHocphan_new' => $_POST['txt_maHocphan'],
                    'tenHocphan' => $_POST['txt_tenHocphan'],
                    'stc' => $_POST['txt_stc'],
                    'maHocky' => $_POST['sellist1'],
                    'maLop' => $_POST['sellist_lop'],
                    'maHocphan_old' => $maMon
                ];

                $url = "http://web/api/sua_hocphan.php";

                // Gọi API
                $res = callAPI($url, $data);

                if ($res && isset($res['status']) && $res['status'] == "success") {

                    header("location:index.php?controllers=quanly&action=list_hocphan");
                    exit();

                } else {

                    $thatbai = $res['message'] ?? "Sửa học phần thất bại!";
                }
            }
        }

        require_once 'View/Bang/tbl_hocphan_edit.php';
        break;


    case 'Delete_hocphan':

        if (isset($_GET['maMon'])) {

            $data = [
                'maHocphan' => $_GET['maMon']
            ];

            $url = "http://web/api/xoa_hocphan.php";

            // Gọi API
            $res = callAPI($url, $data);

            if ($res && isset($res['status']) && $res['status'] == "success") {

                header("location:index.php?controllers=quanly&action=list_hocphan");
                exit();

            } else {

                echo "Lỗi: " . ($res['message'] ?? "Không thể xóa học phần");
            }
        }

        break;

    // xử lý sinh viên
    // xử lý sinh viên
    case 'Add':
        $list_lop = Lop::List();
        if (isset($_POST['Add'])) {
            $maSV = $_POST['txt_masv'];
            $ngaysinh = date('Y-m-d', strtotime($_POST['txt_ngaysinh']));

            // Chuẩn bị dữ liệu gửi lên API
            $data = [
                "ma_sv" => $maSV,
                "hoten_sv" => $_POST['txt_hoten'],
                "ngay_sinh" => $ngaysinh,
                "gioi_tinh" => $_POST['txt_gioitinh'],
                "dan_toc" => $_POST['txt_dantoc'],
                "noi_sinh" => $_POST['txt_noisinh'],
                "ma_lop" => $_POST['txt_malop']
            ];

            // Gọi API Thêm sinh viên (POST)
            $url = "http://localhost/Quan_ly_diem/api/add_sinhvien.php";
            $res = callAPI($url, $data);

            if ($res && $res['status'] == "success") {
                header("location:index.php?controllers=quanly&action=Admin");
                exit();
            } else {
                $thatbai = $res['message'] ?? "Thêm thất bại!";
            }
        }
        require_once 'View/sinhvien/Add.php';
        break;

    case 'Edit':
        $list_lop = Lop::List();
        if (isset($_GET['maSV'])) {
            $maSV_cu = $_GET['maSV'];
            $list_sv = Sinhvien::GetId($maSV_cu); // Vẫn lấy dữ liệu cũ để hiện lên Form

            if (isset($_POST['Edit'])) {
                $ngaysinh = date('Y-m-d', strtotime($_POST['txt_ngaysinh']));

                $data = [
                    "id_cu" => $maSV_cu,
                    "ma_sv" => $_POST['txt_masv'],
                    "hoten_sv" => $_POST['txt_hoten'],
                    "ngay_sinh" => $ngaysinh,
                    "gioi_tinh" => $_POST['txt_gioitinh'],
                    "dan_toc" => $_POST['txt_dantoc'],
                    "noi_sinh" => $_POST['txt_noisinh'],
                    "ma_lop" => $_POST['txt_malop']
                ];

                // Gọi API Sửa sinh viên (PUT)
                $url = "http://localhost/Quan_ly_diem/api/update_sinhvien.php";
                $res = callAPI($url, $data);

                if ($res && $res['status'] == "success") {
                    header("location:index.php?controllers=quanly&action=Admin");
                    exit();
                } else {
                    $thatbai = $res['message'] ?? "Sửa thất bại!";
                }
            }
        }
        require_once 'View/sinhvien/Edit.php';
        break;

    case 'Delete':
        if (isset($_GET['maSV'])) {
            $data = ["ma_sv" => $_GET['maSV']];

            // Gọi API Xóa sinh viên (DELETE)
            $url = "http://localhost/Quan_ly_diem/api/delete_sinhvien.php";
            $res = callAPI($url, $data);

            if ($res && $res['status'] == "success") {
                header("location:index.php?controllers=quanly&action=Admin");
                exit();
            } else {
                echo $res['message'] ?? "Xóa thất bại..!";
            }
        }
        break;

    case 'Admin':
        // Kiểm tra xem có yêu cầu lọc theo lớp không
        $maLop = isset($_GET['maLop']) ? $_GET['maLop'] : 'all';

        // Gọi API thay vì gọi Model trực tiếp
        // Nếu chọn lớp cụ thể, truyền thêm param maLop vào API (nếu bạn đã viết API lọc)
        // Ở đây mình gọi API lấy danh sách tổng trước:
        $url = "http://web/api/get_sinhvien.php";
        $res = callAPI($url, null);

        if ($res && $res['status'] == "success") {
            $list_sv = $res['data'];

            // Logic lọc tạm thời trên Controller nếu API chưa hỗ trợ lọc theo lớp
            if ($maLop != 'all') {
                $list_sv = array_filter($list_sv, function ($item) use ($maLop) {
                    return $item['ma_lop'] == $maLop;
                });
            }
        } else {
            $list_sv = [];
        }

        require_once 'View/masster/admin.php';
        break;

    default:
        echo "Trang không tồn tại";
        break;

    case 'ExportExcel':
        // Lấy mã lớp từ URL nếu có
        $maLop = isset($_GET['maLop']) ? $_GET['maLop'] : null;

        // Nếu có mã lớp thì lọc, không thì xuất tất cả
        if ($maLop && $maLop != 'all') {
            $list_sv = Sinhvien::ListByLop($maLop);
            $prefix = "Lop_" . $maLop . "_";
        } else {
            $list_sv = Sinhvien::List();
            $prefix = "Tat_ca_";
        }

        $filename = $prefix . "Danh_sach_SV_" . date('dmY') . ".csv";

        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        $output = fopen('php://output', 'w');

        // Chèn BOM để không lỗi font tiếng Việt
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Tiêu đề cột
        fputcsv($output, array('STT', 'Mã sinh viên', 'Họ và tên', 'Ngày sinh', 'Giới tính', 'Lớp'));

        $stt = 1;
        foreach ($list_sv as $row) {
            // ĐỊNH DẠNG LẠI NGÀY SINH TẠI ĐÂY
            // Thêm "\t" để ép Excel hiểu là chuỗi văn bản, giúp không bị hiện #######
            $ngay_sinh_fixed = "\t" . date('d/m/Y', strtotime($row['ngay_sinh']));

            fputcsv($output, array(
                $stt++,
                $row['ma_sv'],
                $row['hoten_sv'],
                $ngay_sinh_fixed, // Sử dụng biến đã fix
                $row['gioi_tinh'],
                $row['ten_lop']
            ));
        }
        fclose($output);
        exit();
        break;
}
