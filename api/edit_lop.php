<?php
require_once '../Model/lop.php';
$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

$maOld = $input['malop_old'] ?? '';
$maNew = $input['malop_new'] ?? '';
$tenLop = $input['tenlop'] ?? '';

if (!empty($maOld) && !empty($maNew) && !empty($tenLop)) {
    if (!Lop::Exists($maOld)) {
        echo json_encode(["status" => "error", "message" => "Lớp không tồn tại"]);
    } elseif ($maOld != $maNew && Lop::Exists($maNew)) {
        echo json_encode(["status" => "error", "message" => "Mã lớp mới đã bị trùng"]);
    } elseif (Lop::Edit($maNew, $tenLop, $maOld)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi sửa"]);
    }
}
