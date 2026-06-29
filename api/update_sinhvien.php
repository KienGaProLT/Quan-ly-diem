<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../Model/sinhvien.php';


// ---------------------------------

// Nhận dữ liệu từ body của Request (dạng JSON)
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_cu'], $data['ma_sv'])) {
    $result = Sinhvien::Edit(
        $data['ma_sv'], 
        $data['hoten_sv'], 
        $data['ngay_sinh'], 
        $data['gioi_tinh'], 
        $data['dan_toc'], 
        $data['noi_sinh'], 
        $data['ma_lop'],
        $data['id_cu'] // Mã SV cũ để tìm và cập nhật đúng bản ghi
    );

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Cập nhật sinh viên thành công bằng PUT"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Cập nhật thất bại, vui lòng kiểm tra lại dữ liệu"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu mã sinh viên cũ (id_cu) hoặc mã mới (ma_sv)"]);
}