<?php
// 1. Khai báo đây là phản hồi dạng JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// 2. Nạp kết nối và Model (lùi 1 thư mục để ra ngoài folder api)
require_once '../Connect/connect.php';
require_once '../Model/dangnhap.php';

// 3. Nhận và giải mã dữ liệu JSON: (dạng JSON body)
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->username) && !empty($data->password)) {
    $u = $data->username;
    $p = md5($data->password); // Mã hóa mật khẩu để đối chiếu:

    // Truy vấn vào Cơ sở dữ liệu thông qua Model:
    $user = Dangnhap::Login($u, $p);

    if (!empty($user)) {
        // Trả về kết quả cho Controller:
        echo json_encode([
            "status" => "success",
            "message" => "Đăng nhập thành công",
            "data" => $user[0]
        ]);
    } else {
        // Trả về lỗi nếu sai tài khoản/mật khẩu
        echo json_encode([
            "status" => "error",
            "message" => "Tên đăng nhập hoặc mật khẩu không đúng api chay roi nhe!"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Vui lòng nhập đầy đủ thông tin!"
    ]);
}
?>