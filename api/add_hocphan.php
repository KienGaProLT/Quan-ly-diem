<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/monhocphan.php';

// Lấy dữ liệu từ POST
$data = json_decode(file_get_contents("php://input"), true);

$ma = $data['maHocphan'] ?? '';
$ten = $data['tenHocphan'] ?? '';
$stc = $data['stc'] ?? '';
$mahk = $data['maHocky'] ?? '';
$malop = $data['maLop'] ?? '';

if ($ma && $ten && $stc && $mahk && $malop) {
    if (MonHP::ADD($ma, $ten, $stc, $mahk, $malop)) {
        echo json_encode([
            "status" => "success",
            "message" => "Thêm học phần thành công"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Mã học phần đã tồn tại"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Thiếu dữ liệu"
    ]);
}