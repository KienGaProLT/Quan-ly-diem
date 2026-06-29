<?php

require_once __DIR__ . '/../Connect/connect.php';

class MonHP extends Database_ql_diem
{
    // 1. Lấy danh sách tất cả Học kỳ (Dùng cho ô chọn cấp 1)
    public static function List_HK()
    {
        $sql = "SELECT * FROM hocky ORDER BY ma_hk DESC";
        return parent::Getdata($sql);
    }

    // 2. Lấy danh sách tất cả Lớp (Dùng cho ô chọn cấp 2)
    public static function List_Lop()
    {
        $sql = "SELECT * FROM lop ORDER BY ten_lop ASC";
        return parent::Getdata($sql);
    }

    // 3. Lọc danh sách Môn học theo Học kỳ và Lớp (Dùng cho ô chọn cấp 3 - Quan trọng nhất)
    public static function List_By_HK_Lop($maHK, $maLop)
    {
        $sql = "SELECT * FROM monhocphan 
                WHERE ma_hk = '$maHK' AND ma_lop = '$maLop' 
                ORDER BY ten_mon ASC";
        return parent::Getdata($sql);
    }

    // 4. Hàm thêm mới Học phần
    public static function ADD($txt_maHocphan, $txt_tenHocphan, $txt_stc, $txt_mahocky, $txt_malop)
    {
        $sql = "INSERT INTO monhocphan(ma_mon, ten_mon, sotinchi, ma_hk, ma_lop) 
                VALUES ('$txt_maHocphan','$txt_tenHocphan','$txt_stc','$txt_mahocky', '$txt_malop')";
        return parent::Execute($sql);
    }

    // 5. Lấy thông tin chi tiết một Học phần theo ID
    public static function id_DHP($txt_maHocphan)
    {
        $sql = "SELECT * FROM monhocphan WHERE ma_mon='$txt_maHocphan'";
        return parent::Getdata($sql);
    }

    // 6. Cập nhật thông tin Học phần
    public static function Edit($txt_maHocphan, $txt_tenHocphan, $txt_stc, $txt_mahocky, $txt_malop, $id_ma_monHp)
    {
        $sql = "UPDATE monhocphan SET 
                ma_mon='$txt_maHocphan', 
                ten_mon='$txt_tenHocphan', 
                sotinchi='$txt_stc', 
                ma_hk='$txt_mahocky', 
                ma_lop='$txt_malop' 
                WHERE ma_mon='$id_ma_monHp'";
        return parent::Execute($sql);
    }

    // 7. Xóa Học phần
    public static function Delete($txt_maHocphan)
    {
        $sql = "DELETE FROM monhocphan WHERE ma_mon='$txt_maHocphan'";
        return parent::Execute($sql);
    }

    // 8. Liệt kê tất cả Học phần (kèm tên lớp và tên học kỳ)
    public static function List()
    {
        $sql = "SELECT m.*, l.ten_lop, h.ten_hk 
                FROM monhocphan m 
                LEFT JOIN lop l ON m.ma_lop = l.ma_lop 
                LEFT JOIN hocky h ON m.ma_hk = h.ma_hk";
        return parent::Getdata($sql);
    }

    // 9. Lọc môn học chỉ theo mã lớp (Dùng cho các mục đích khác nếu cần)
    public static function List_By_Lop($maLop)
    {
        $sql = "SELECT m.*, h.ten_hk 
                FROM monhocphan m 
                JOIN hocky h ON m.ma_hk = h.ma_hk 
                WHERE m.ma_lop = '$maLop'";
        return parent::Getdata($sql);
    }
}