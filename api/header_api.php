<?php
// Cho phép truy cập từ mọi nguồn (View, Thunder Client, Postman...)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Cho phép các phương thức HTTP RESTful
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Cho phép các Header gửi kèm (đặc biệt là Content-Type JSON)
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Xử lý yêu cầu OPTIONS (Preflight) từ trình duyệt
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}