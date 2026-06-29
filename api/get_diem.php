<?php
// 1. Khai báo JSON và nạp kết nối
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/Diemchitiep.php'; 

$maSV = isset($_GET['ma_sv']) ? $_GET['ma_sv'] : null;
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "status" => "error", 
        "message" => "Lỗi: API này yêu cầu phương thức GET!"
    ]);
    exit;
}

if (!$maSV) {
    $input = json_decode(file_get_contents("php://input"), true);
    $maSV = isset($input['ma_sv']) ? $input['ma_sv'] : null;
}

// 2. Kiểm tra nếu có mã sinh viên thì mới tiến hành lấy điểm
if (!empty($maSV)) {
    // Gọi hàm lấy điểm từ Model (TongDiemChitiet::DiemHP)
    $list_diem = TongDiemChitiet::DiemHP($maSV);
    
    if (!empty($list_diem)) {
        echo json_encode([
            "status" => "success",
            "data" => $list_diem
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Sinh viên mã $maSV hiện chưa có điểm trong hệ thống!"
        ]);
    }
} else {
    // Trả về lỗi nếu cả URL và Body JSON đều không có mã sinh viên
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi: Không nhận được mã sinh viên! Vui lòng kiểm tra lại dữ liệu gửi lên."
    ]);
}