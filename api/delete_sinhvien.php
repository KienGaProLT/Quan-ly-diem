<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../Model/sinhvien.php';


// ------------------------------------

// Nhận dữ liệu từ body của Request (dạng JSON)
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['ma_sv'])) {
    $result = Sinhvien::Delete($data['ma_sv']);
    if ($result) {
        echo json_encode(["status" => "success", "message" => "Đã xóa sinh viên thành công bằng phương thức DELETE"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa thất bại hoặc sinh viên không tồn tại"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu mã sinh viên để xóa"]);
}