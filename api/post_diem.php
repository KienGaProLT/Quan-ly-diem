<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/diemhocpham.php'; // Nạp Model quản lý điểm học phần
require_once 'header_api.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error", 
        "message" => "Lỗi: API này yêu cầu phương thức POST!"
    ]);
    exit;
}
// Nhận dữ liệu JSON từ phía Client (Controller)
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->ma_sv) && !empty($data->ma_mon)) {
    $maSV = $data->ma_sv;
    $maMon = $data->ma_mon;
    $diemGK = $data->diem_giua_ky;
    $diemThi = $data->diem_thi_hp;

    if ($diemGK < 0 || $diemGK > 10 || $diemThi < 0 || $diemThi > 10) {
    echo json_encode(["status" => "error", "message" => "Điểm phải từ 0 đến 10!"]);
    exit();
}
    // Gọi hàm ADD từ Model DiemMHP để thực hiện INSERT vào database
    if (DiemMHP::ADD($maSV, $maMon, $diemGK, $diemThi)) {
        echo json_encode([
            "status" => "success",
            "message" => "Nhập điểm thành công cho sinh viên $maSV!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Lỗi: Không thể lưu điểm (Có thể sinh viên đã có điểm môn này)."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Thiếu dữ liệu đầu vào (Mã SV, Mã Môn hoặc Điểm)!"
    ]);
}