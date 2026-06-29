<?php
require_once '../Model/monhocphan.php';

$jsonData = file_get_contents('php://input');
$input = json_decode($jsonData, true);

$maHocphan = $input['maHocphan'] ?? '';

if (!empty($maHocphan)) {

    // Kiểm tra học phần có tồn tại không
    if (!MonHP::id_DHP($maHocphan)) {

        echo json_encode([
            "status" => "error",
            "message" => "Mã học phần không tồn tại!"
        ]);

    } elseif (MonHP::Delete($maHocphan)) {

        echo json_encode([
            "status" => "success"
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Không thể xóa học phần!"
        ]);
    }

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Thiếu mã học phần cần xóa!"
    ]);
}