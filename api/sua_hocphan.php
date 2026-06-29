<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/monhocphan.php';

$data = json_decode(file_get_contents("php://input"), true);

$maCu = $data['maHocphan_old'] ?? ($data['maCu'] ?? '');
$ma = $data['maHocphan_new'] ?? ($data['maHocphan'] ?? '');
$ten = $data['tenHocphan'] ?? '';
$stc = $data['stc'] ?? '';
$mahk = $data['maHocky'] ?? '';
$malop = $data['maLop'] ?? '';

if ($maCu && $ma && $ten && $stc && $mahk && $malop) {
    if (MonHP::Edit($ma, $ten, $stc, $mahk, $malop, $maCu)) {
        echo json_encode([
            "status" => "success",
            "message" => "Sửa học phần thành công"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Cập nhật thất bại (có thể trùng mã)"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Thiếu dữ liệu"
    ]);
}
