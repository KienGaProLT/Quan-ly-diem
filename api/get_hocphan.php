<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/monhocphan.php'; // Check lại tên file Model của bạn

// Gọi hàm lấy danh sách môn học từ Model
$list_hp = MonHP::List(); 

echo json_encode([
    "status" => "success",
    "data" => $list_hp
]);