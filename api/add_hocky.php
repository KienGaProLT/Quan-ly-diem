<?php
require_once '../Model/hocky.php';

$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

$maHK = $input['mahocky'] ?? '';
$tenHK = $input['tenhocky'] ?? '';

if (!empty($maHK) && !empty($tenHK)) {
    if (Hocky::Exists($maHK)) {
        echo json_encode(["status" => "error", "message" => "Mã học kỳ này đã tồn tại!"]);
    } elseif (Hocky::ADD($maHK, $tenHK)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi hệ thống khi thêm học kỳ!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Vui lòng nhập đủ thông tin!"]);
}
