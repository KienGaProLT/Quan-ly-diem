<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../Model/sinhvien.php';




// --- BƯỚC 1: Thêm hàm hỗ trợ gọi API ---
function callAPI($url, $data) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['ma_sv'], $data['hoten_sv'])) {
    $result = Sinhvien::ADD(
        $data['ma_sv'], 
        $data['hoten_sv'], 
        $data['ngay_sinh'], 
        $data['gioi_tinh'], 
        $data['dan_toc'], 
        $data['noi_sinh'], 
        $data['ma_lop']
    );

    if ($result) {
 
        $apiUrl = "http://localhost/Quan_ly_diem/api/create_account.php"; 
        $apiData = [
            'hoten' => $data['hoten_sv'],
            'masv'  => $data['ma_sv']
        ];
        
        callAPI($apiUrl, $apiData); 
        // ---------------------------

        echo json_encode(["status" => "success", "message" => "Thêm sinh viên và cấp tài khoản thành công"]); 
    } else {
        echo json_encode(["status" => "error", "message" => "Không thể thêm sinh viên"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Thiếu dữ liệu đầu vào"]);
}