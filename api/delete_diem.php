<?php
// 1. Khai báo JSON
header("Content-Type: application/json; charset=UTF-8");
require_once 'header_api.php';
/**
 * LỚP BẢO VỆ: CHỈ CHO PHÉP PHƯƠNG THỨC DELETE
 * Nếu người dùng dùng POST, PUT, hay GET để gọi file này, hệ thống sẽ từ chối.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    // Trả về mã lỗi 405 (Phương thức không được phép)
    http_response_code(405); 
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi: Hành động này yêu cầu phương thức DELETE. Bạn đang sử dụng " . $_SERVER['REQUEST_METHOD']
    ]);
    exit(); // Dừng chương trình ngay lập tức
}

require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/diemhocpham.php';

// 2. Nhận dữ liệu từ Body JSON
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->ma_sv) && !empty($data->ma_mon)) {
    $maSV = $data->ma_sv;
    $maMon = $data->ma_mon;

    // 3. Gọi hàm Delete từ Model DiemMHP
    if (DiemMHP::Delete($maSV, $maMon)) {
        echo json_encode([
            "status" => "success",
            "message" => "Đã xóa điểm của sinh viên $maSV môn $maMon thành công!"
        ]);
    } else {
        // Trả về mã lỗi 500 (Lỗi Server/Database) nếu xóa thất bại
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Lỗi: Không thể xóa điểm. Có thể do dữ liệu không tồn tại hoặc lỗi kết nối!"
        ]);
    }
} else {
    // Trả về mã lỗi 400 (Dữ liệu gửi lên thiếu/sai)
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Thiếu thông tin Mã SV hoặc Mã Môn để thực hiện xóa!"
    ]);
}