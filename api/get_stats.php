<?php
// 1. Khai báo JSON
header("Content-Type: application/json; charset=UTF-8");

/**
 * LỚP BẢO VỆ: CHỈ CHO PHÉP PHƯƠNG THỨC GET
 * Vì đây là API truy vấn dữ liệu, dùng GET là chuẩn nhất.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi: API này yêu cầu phương thức GET. Bạn đang dùng " . $_SERVER['REQUEST_METHOD']
    ]);
    exit();
}

require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/Diemchitiep.php';

// 2. Nhận mã sinh viên từ URL (?ma_sv=...)
$maSV = isset($_GET['ma_sv']) ? $_GET['ma_sv'] : (isset($_GET['masv']) ? $_GET['masv'] : null);

if (!empty($maSV)) {
    
    // 3. Lấy danh sách điểm thô từ Model
    $list_diem = TongDiemChitiet::DiemHP($maSV);

    if (!empty($list_diem)) {
        $TongSTC = 0;
        $TongHDS = 0;

        foreach ($list_diem as $value) {
            // Công thức tính điểm trung bình học phần (TBHP)
            $diemHP = round(($value['diem_giua_ky'] * 0.3) + ($value['diem_thi_hp'] * 0.7), 1);

            // Điều kiện để tính vào tích lũy: Điểm thi >= 2.0 và TBHP >= 4.0
            if ($value['diem_thi_hp'] >= 2 && $diemHP >= 4) {
                $TongSTC += $value['sotinchi'];
                // Quy đổi hệ số 4 và nhân với số tín chỉ
                $TongHDS += ($value['sotinchi'] * TongDiemChitiet::HDS($diemHP));
            }
        }

        // 4. Tính toán các chỉ số cuối cùng
        $gpa = ($TongSTC > 0) ? round($TongHDS / $TongSTC, 2) : 0;
        $xep_loai = TongDiemChitiet::XL_TK($gpa);

        echo json_encode([
            "status" => "success",
            "data" => [
                "ma_sv" => $maSV,
                "gpa" => $gpa,
                "tong_stc" => $TongSTC,
                "xep_loai" => $xep_loai
            ]
        ]);
    } else {
        http_response_code(404); // Not Found
        echo json_encode([
            "status" => "error",
            "message" => "Không tìm thấy dữ liệu điểm của sinh viên mã: $maSV"
        ]);
    }
} else {
    http_response_code(400); // Bad Request
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi: Thiếu mã sinh viên trên URL! (Ví dụ: ?ma_sv=74DCTT...)"
    ]);
}