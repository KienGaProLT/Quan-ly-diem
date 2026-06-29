<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/lop.php'; 

$list_lop = Lop::List(); 

// Kiểm tra nếu lấy dữ liệu thành công (trả về mảng)
if (is_array($list_lop)) {
    echo json_encode([
        "status" => "success",
        "data" => $list_lop
    ]);
} 
// Nếu gặp sự cố Database
else {
    echo json_encode([
        "status" => "error",
        "message" => "Không thể lấy dữ liệu danh sách lớp từ hệ thống!"
    ]);
}