<?php
session_start();

// Hàm gọi API bằng cURL
function callAPI($url, $data) 
{
    $ch = curl_init($url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// Chỉnh lại tên folder cho đúng máy bạn
$api_url = "http://web/api/login.php";
$action = isset($_GET['action']) ? $_GET['action'] : NULL;

switch ($action) {
    case 'Admin': // XỬ LÝ ĐĂNG NHẬP QUA API
        if (isset($_POST['login'])) { 
            // lấy dữ liệu từ form
            $postData = [
                "username" => $_POST['username'],
                "password" => $_POST['password']
            ];

            // Gửi dữ liệu sang API
            $result = callAPI($api_url, $postData);

            // Kiểm tra xem API có báo thành công không:
            if (isset($result['status']) && $result['status'] == "success") {
                // Lưu thông tin vào Session (Cấp "thẻ thông hành")
                $u = $result['data'];
                $_SESSION["username"] = $u['username'];
                $_SESSION["quyen"] = $u['quyen'];
                $_SESSION["ma_sv"] = $u['ma_sv'];
                // Phân quyền điều hướng (Ai đi đường nấy)
                if ($_SESSION["quyen"] == 1) {
                    header('location:index.php?controllers=quanly&action=Admin');
                } else {
                    header('location:index.php?controllers=diem&action=Dashboard_SV');
                }
                exit();
            }
            // Nếu API có trả về nhưng status là error (ví dụ: sai mật khẩu)
            else if (isset($result['status']) && $result['status'] == "error") {
                $thatbai = "<p style='color:red'>* " . $result['message'] . "</p>";
                require_once 'View/login.php';
            }
            // Trường hợp không kết nối được API hoặc API trắng trơn
            else {
                $thatbai = "<p style='color:red'>* Không thể kết nối đến máy chủ API hoặc API lỗi!</p>";
                require_once 'View/login.php';
            }
        } else {
            require_once 'View/login.php';
        }
        break;

    case 'quen_mk': 
        // 1. Sửa từ 'change_password' thành 'btnQuenMK' cho khớp đúng nút bấm trong Form của bạn
        if (isset($_POST['btnQuenMK'])) { 
            
            $txtUser = $_POST['txtUsername'];
            $txtEmail = $_POST['txtEmail'];
            $txtPassNew = $_POST['txtNewPass'];    
            $txtPassConfirm = $_POST['txtCfPass']; 

            // 3. Kiểm tra xem mật khẩu nhập lại có khớp nhau không
            if ($txtPassNew !== $txtPassConfirm) {
                $thatbai = "<p style='color:red'>* Mật khẩu xác nhận không trùng khớp!</p>";
            } else {
                // Đóng gói dữ liệu để truyền qua API
                $forgotData = [
                    "username" => $txtUser,
                    "email" => $txtEmail,
                    "new_password" => $txtPassNew
                ];

                // Địa chỉ URL đến file API quên mật khẩu
                $forgot_api_url = "http://web/api/forgot_password.php";
                
                // Gọi API bằng hàm callAPI có sẵn đầu file của bạn
                $result = callAPI($forgot_api_url, $forgotData);

                // Đọc phản hồi JSON từ API trả về
                if (isset($result['status']) && $result['status'] == "success") {
                    $thanhcong = "<p style='color:green; font-weight:bold;'>* " . $result['message'] . "</p>";
                } else if (isset($result['status']) && $result['status'] == "error") {
                    $thatbai = "<p style='color:red'>* " . $result['message'] . "</p>";
                } else {
                    $thatbai = "<p style='color:red'>* Không thể kết nối với máy chủ xử lý API!</p>";
                }
            }
        }
        // Hiển thị giao diện form đặt lại mật khẩu
        require_once 'View/forgot-password.php';
        break;

    case 'logout': // Đăng xuất giữ nguyên
        session_destroy();
        header('location:index.php');
        exit();
        break;

    default: // Kiểm tra trạng thái đăng nhập
        if (isset($_SESSION["username"])) {
            if ($_SESSION["quyen"] == 1) {
                header('location:index.php?controllers=quanly&action=Admin');
            } else {
                header('location:index.php?controllers=diem&action=Dashboard_SV');
            }
        } else {
            require_once 'View/login.php';
        }
        break;
}