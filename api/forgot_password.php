<?php
// 1. Khai báo định dạng phản hồi JSON
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// 2. Nạp file kết nối cơ sở dữ liệu
require_once '../Connect/connect.php';

// 3. Nhận dữ liệu JSON body gửi từ Controller sang
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra xem dữ liệu gửi sang có đầy đủ không
if (!empty($data->username) && !empty($data->email) && !empty($data->new_password)) {
    $u = $data->username;
    $e = $data->email;
    $p_new = md5($data->new_password); // Mã hóa MD5 để đối chiếu với DB

    try {
        // 1. Kích hoạt kết nối database
        Database_ql_diem::Connect();
        
        // 2. Chạy câu lệnh SELECT mượn qua hàm Getdata() có sẵn trong connect.php của bạn
        // Hàm Getdata() của bạn sẽ tự thực thi query và trả về mảng dữ liệu
        $sql_check = "SELECT * FROM dangnhap WHERE username = '$u' AND emai = '$e'";
        $user_data = Database_ql_diem::Getdata($sql_check);

        if (!empty($user_data)) {
            // 3. Nếu tìm thấy tài khoản, mượn hàm Execute() có sẵn để chạy lệnh UPDATE mật khẩu mới
            $sql_update = "UPDATE dangnhap SET password = '$p_new' WHERE username = '$u'";
            $result = Database_ql_diem::Execute($sql_update);

            if ($result) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Đặt lại mật khẩu thành công!"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Có lỗi xảy ra trong quá trình cập nhật mật khẩu."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Tên đăng nhập hoặc Email không chính xác!"
            ]);
        }

    } catch (Exception $ex) {
        echo json_encode([
            "status" => "error",
            "message" => "Lỗi hệ thống: " . $ex->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Vui lòng nhập đầy đủ tất cả các trường dữ liệu!"
    ]);
}
?>