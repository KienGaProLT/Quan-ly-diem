<?php
// Bắt buộc phải có dòng này để API nhận diện được Class Lop
require_once '../Model/lop.php';

$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

// Lấy mã lớp từ JSON
$maLop = isset($input['maLop']) ? $input['maLop'] : '';

if (!empty($maLop)) {
    // 1. Kiểm tra mã ảo
    if (!Lop::Exists($maLop)) {
        echo json_encode(["status" => "error", "message" => "Mã lớp không tồn tại!"]);
    } 
    // 2. Chạy lệnh xóa
    elseif (Lop::Delete($maLop)) {
        echo json_encode(["status" => "success"]);
    } 
    // 3. Nếu xóa thất bại (Thường là do lỗi MySQL khóa ngoại - Lớp đang có sinh viên)
    else {
        echo json_encode(["status" => "error", "message" => "Không thể xóa vì lớp này đang có sinh viên hoặc dữ liệu phụ thuộc!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu mã lớp cần xóa!"]);
}
