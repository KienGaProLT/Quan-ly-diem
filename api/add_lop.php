<?php
require_once '../Model/lop.php';

// Phần code ở dưới của bạn giữ nguyên
$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

$maLop = $input['malop'] ?? '';
$tenLop = $input['tenlop'] ?? '';

if (!empty($maLop) && !empty($tenLop)) {
    if (Lop::Exists($maLop)) {
        echo json_encode(["status" => "error", "message" => "Mã lớp đã tồn tại!"]);
    } elseif (Lop::ADD($maLop, $tenLop)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi thêm"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu"]);
}
