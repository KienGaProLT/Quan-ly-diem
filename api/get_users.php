<?php
// 1. Cấu hình Header cho phép phản hồi dữ liệu dạng JSON dữ liệu Tiếng Việt
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); // Hàm lấy dữ liệu dùng phương thức GET

// 2. Nạp file kết nối cơ sở dữ liệu và file Model của bạn
require_once '../Connect/connect.php';
require_once '../Model/dangnhap.php';

try {
    // 3. Kích hoạt kết nối Database
    Database_ql_diem::Connect();

    // 4. Gọi hàm List() đã viết sẵn trong Model Dangnhap để lấy toàn bộ dữ liệu
    // Dòng 15 mới
    $result = Dangnhap::GetAllUsers();
    // 5. Sử dụng foreach vì $result bản chất đã là một mảng PHP dữ liệu thô
    $users_list = [];
    if (!empty($result) && is_array($result)) { // nếu biến resurt không bị rỗng và biến result chắc chắn là một cấu trúc dạng mảng thì mới xử lý sâu vào trong
        foreach ($result as $row) { // cứ mỗi tài khoản nó sẽ gán tạm vào biến row
            // Loại bỏ trường password khi trả về qua API để đảm bảo an toàn bảo mật
            unset($row['password']); 
            $users_list[] = $row;
        }
    }

    // 6. Trả về phản hồi JSON thành công kèm mảng danh sách tài khoản
    echo json_encode([
        "status" => "success",
        "total" => count($users_list),
        "data" => $users_list
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    // Trả về thông báo lỗi nếu hệ thống trục trặc
    echo json_encode([
        "status" => "error",
        "message" => "Lỗi hệ thống: " . $e->getMessage()
    ]);
}
