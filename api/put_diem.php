<?php
require_once 'header_api.php';
// 1. Khai báo JSON
header("Content-Type: application/json; charset=UTF-8");

/**
 * LỚP BẢO VỆ: CHỈ CHO PHÉP PHƯƠNG THỨC PUT
 * Chặn tất cả các nhãn khác như POST, GET, DELETE để đảm bảo tính nhất quán.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi: API này yêu cầu phương thức PUT. Bạn đang dùng " . $_SERVER['REQUEST_METHOD']
    ]);
    exit();
}

require_once __DIR__ . '/../Connect/connect.php';
require_once __DIR__ . '/../Model/diemhocpham.php';

// 2. Nhận dữ liệu POST (dạng JSON body)
$data = json_decode(file_get_contents("php://input"));

// 3. Kiểm tra xem Object $data có tồn tại và có đủ các thuộc tính cần thiết không
if (
    isset($data->ma_sv) && 
    isset($data->ma_mon) && 
    isset($data->diem_giua_ky) && 
    isset($data->diem_thi_hp)
) {
    $maSV = $data->ma_sv;
    $maMon = $data->ma_mon;
    $diemGK = $data->diem_giua_ky;
    $diemThi = $data->diem_thi_hp;

    // Kiểm tra logic điểm số
    if ($diemGK < 0 || $diemGK > 10 || $diemThi < 0 || $diemThi > 10) {
        http_response_code(400); // Bad Request
        echo json_encode(["status" => "error", "message" => "Điểm phải từ 0 đến 10!"]);
        exit();
    }

    // 4. Gọi hàm Edit từ Model DiemMHP
    if (DiemMHP::Edit($maSV, $maMon, $diemGK, $diemThi)) {
        echo json_encode([
            "status" => "success",
            "message" => "Cập nhật điểm thành công cho SV $maSV môn $maMon!"
        ]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode([
            "status" => "error",
            "message" => "Lỗi: Không thể cập nhật điểm. Vui lòng kiểm tra lại database!"
        ]);
    }
     
} else {
    // 5. Báo lỗi cụ thể nếu thiếu trường dữ liệu gửi lên
    http_response_code(400); // Bad Request
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi: Thiếu trường dữ liệu. Vui lòng kiểm tra lại tên biến (diem_giua_ky, diem_thi_hp)!"
    ]);
}