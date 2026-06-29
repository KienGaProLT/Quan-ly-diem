<?php

require_once __DIR__ . '/../Connect/connect.php';
class Sinhvien extends Database_ql_diem
{

    public static function ADD($text_masv, $text_tensv, $text_ngaysinh, $text_gioitinh, $text_dantoc, $text_noisinh, $text_malop)
    {
        $sql = "INSERT INTO sinhvien(ma_sv, hoten_sv, ngay_sinh, gioi_tinh, dan_toc, noi_sinh, ma_lop) VALUES ('$text_masv', '$text_tensv', '$text_ngaysinh', '$text_gioitinh', '$text_dantoc', '$text_noisinh', '$text_malop')";
        return parent::Execute($sql);
    }

    public static function GetId($id)
    {
        $sql = "SELECT * FROM sinhvien WHERE sinhvien.ma_sv = '$id'";
        // Sửa từ Execute sang Getdata để trả về mảng dữ liệu sinh viên
        return parent::Getdata($sql);
    }

    public static function Edit($text_masv, $text_tensv, $text_ngaysinh, $text_gioitinh, $text_dantoc, $text_noisinh, $text_malop, $id)
    {
        $sql = "UPDATE sinhvien SET 
            ma_sv = '$text_masv', 
            hoten_sv = '$text_tensv', 
            ngay_sinh = '$text_ngaysinh', 
            gioi_tinh = '$text_gioitinh', 
            dan_toc = '$text_dantoc', 
            noi_sinh = '$text_noisinh', 
            ma_lop = '$text_malop' 
            WHERE ma_sv = '$id'";

        return parent::Execute($sql);
    }

    public static function Delete($text_masv)
    {
        $sql = "DELETE FROM sinhvien WHERE sinhvien.ma_sv = '$text_masv'";
        return parent::Execute($sql);
    }

    public static function List()
    {
        // Lấy danh sách kèm theo thông tin lớp
        $sql = "SELECT * FROM sinhvien AS s INNER JOIN lop AS l ON s.ma_lop = l.ma_lop";
        return parent::Getdata($sql);
    }

    // HÀM TÌM KIẾM ĐÃ SỬA: Thêm JOIN để lấy tên Lớp và sửa lỗi biến chưa định nghĩa
    public static function Search($key)
    {
        // Cần JOIN với bảng 'lop' để hiển thị được cột 'Lớp' trong bảng kết quả
        $sql = "SELECT * FROM sinhvien AS s 
                INNER JOIN lop AS l ON s.ma_lop = l.ma_lop 
                WHERE s.hoten_sv LIKE '%$key%' OR s.ma_sv LIKE '%$key%'";

        return parent::Getdata($sql);
    }
    // Bổ sung vào class Sinhvien trong file Model/sinhvien.php
    public static function Add_Account($hoten, $maSV)
    {
        // Mật khẩu mặc định là 123455, mã hóa MD5
        $password_default = md5('123456');
        $email_default = $maSV . "@gmail.com";
        $quyen = 0; // 0 là quyền Sinh viên

        $sql = "INSERT INTO dangnhap (hoten, username, password, emai, quyen, ma_sv) 
            VALUES ('$hoten', '$maSV', '$password_default', '$email_default', '$quyen', '$maSV')";

        // Sử dụng hàm thực thi SQL dùng chung của bạn (thường là Execute hoặc Getdata)
        return parent::Execute($sql);
    }
    // Thêm vào class Sinhvien trong file Model/sinhvien.php
    public static function ListByLop($maLop)
    {
        // Truy vấn kết hợp bảng 'sinhvien' và 'lop' theo điều kiện mã lớp
        $sql = "SELECT * FROM sinhvien AS s 
            INNER JOIN lop AS l ON s.ma_lop = l.ma_lop 
            WHERE s.ma_lop = '$maLop'";

        return parent::Getdata($sql);
    }
}
