<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/hocky.php'; 

$list_hk = Hocky::List();

// Nếu $list_hk trả về mảng (dù là mảng rỗng) thì báo success
if (is_array($list_hk)) {
    echo json_encode([
        "status" => "success",
        "data" => $list_hk
    ]);
} 
// Nếu gặp sự cố Database trả về false/null thì báo lỗi
else {
    echo json_encode([
        "status" => "error",
        "message" => "Không thể lấy dữ liệu học kỳ từ hệ thống!"
    ]);
}