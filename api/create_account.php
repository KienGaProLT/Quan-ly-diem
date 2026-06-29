<?php
require_once '../Model/dangnhap.php';
$data = json_decode(file_get_contents("php://input"));

//kiểm tra
if (!empty($data->hoten) && !empty($data->masv)) {

    $hoten = $data->hoten;
    $username = $data->masv;
    $password = md5("123456"); 
    $email = $data->masv . "@gmail.com";
    $quyen = 0; 

    if (Dangnhap::ADD($hoten, $username, $password, $email, $quyen, $username)) {
        
        echo json_encode(["status" => "success", "message" => "Cấp tài khoản thành công"]);
        
    } else {

        echo json_encode(["status" => "error", "message" => "Không thể tạo tài khoản"]);
    }
} else {

    echo json_encode(["status" => "error", "message" => "Thiếu thông tin đầu vào"]);
}

// {
//   "hoten": "Nguyễn Khắc Dương",
//   "masv": "74DCTT22184"
// }