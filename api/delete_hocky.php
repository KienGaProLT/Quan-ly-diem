<?php
require_once '../Model/hocky.php';

$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

$maHK = $input['maHocky'] ?? '';

if (!empty($maHK)) {
    if (!Hocky::Exists($maHK)) {
        echo json_encode(["status" => "error", "message" => "Mã học kỳ không tồn tại!"]);
    } elseif (Hocky::Delete($maHK)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Không thể xóa vì học kỳ này đang có môn học phụ thuộc!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu mã học kỳ cần xóa!"]);
}