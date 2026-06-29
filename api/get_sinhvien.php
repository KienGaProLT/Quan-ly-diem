<?php
header("Content-Type: application/json; charset=UTF-8");
require_once '../Connect/connect.php';
require_once __DIR__ . '/../Model/sinhvien.php';
// Sửa tên hàm từ List_all() thành List()
$list_sv = Sinhvien::List(); 

if (!empty($list_sv)) {
    echo json_encode([
        "status" => "success",
        "data" => $list_sv
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Danh sách sinh viên trống!"
    ]);
}