<?php
require_once '../Model/hocky.php';

$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

$maOld = $input['mahocky_old'] ?? '';
$maNew = $input['mahocky_new'] ?? '';
$tenHK = $input['tenhocky'] ?? '';

if (!empty($maOld) && !empty($maNew) && !empty($tenHK)) {
    if (!Hocky::Exists($maOld)) {
        echo json_encode(["status" => "error", "message" => "Học kỳ cần sửa không tồn tại!"]);
    } elseif ($maOld != $maNew && Hocky::Exists($maNew)) {
        echo json_encode(["status" => "error", "message" => "Mã học kỳ mới đã bị trùng với học kỳ khác!"]);
    } elseif (Hocky::Edit($maNew, $tenHK, $maOld)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi hệ thống khi sửa!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu gửi lên!"]);
}