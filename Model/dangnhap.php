<?php

require_once __DIR__ . '/../Connect/connect.php';
class Dangnhap extends Database_ql_diem
{
    // Hàm Login giữ nguyên vì SELECT * sẽ tự lấy thêm cột quyen và ma_sv
    public static function Login($text_username, $text_password)
    {
        $sql = "SELECT * FROM dangnhap WHERE dangnhap.username = '$text_username' AND dangnhap.password = '$text_password'";
        return parent::Getdata($sql);
    }

    // Sửa hàm ADD: Thêm tham số $text_quyen và $text_masv
    public static function ADD($text_hoten, $text_username, $text_password, $text_email, $text_quyen, $text_masv)
    {
        // Thêm quyen và ma_sv vào câu lệnh INSERT
        $sql = "INSERT INTO dangnhap(hoten, username, password, emai, quyen, ma_sv) 
                VALUES ('$text_hoten','$text_username','$text_password','$text_email', '$text_quyen', '$text_masv')";
        return parent::Execute($sql);
    }

    // Sửa hàm Edit: Cập nhật thêm cột quyen và ma_sv
    public static function Edit($text_hoten, $text_username, $text_password, $text_email, $text_quyen, $text_masv, $id)
    {
        // Cập nhật quyen và ma_sv khi sửa tài khoản
        $sql = "UPDATE dangnhap SET 
                hoten='$text_hoten',
                username='$text_username',
                password='$text_password',
                emai='$text_email',
                quyen='$text_quyen',
                ma_sv='$text_masv' 
                WHERE dangnhap.username = '$id'";
        return parent::Execute($sql);
    }

    public static function Delete($text_username)
    {
        $sql = "DELETE FROM dangnhap WHERE dangnhap.username = '$text_username'";
        return parent::Execute($sql);
    }

    public static function QuenMK($username, $email, $newpassword)
    {
        $sql = "UPDATE dangnhap SET password = '$newpassword' 
                WHERE username = '$username' AND emai = '$email'";
        return parent::Execute($sql);
    }
    // Bổ sung vào Model/dangnhap.php
    public static function Check_Reset($user, $email)
    {
        $sql = "SELECT * FROM dangnhap WHERE username = '$user' AND emai = '$email'";
        return parent::Getdata($sql);
    }

    public static function Update_Password($user, $pass)
    {
        $sql = "UPDATE dangnhap SET password = '$pass' WHERE username = '$user'";
        return parent::Execute($sql);
    }

    public static function List_id($text_username)
    {
        $sql = "SELECT * FROM dangnhap WHERE dangnhap.username = '$text_username'";
        return parent::Getdata($sql);
    }

    // Đổi từ List thành GetAllUsers
public static function GetAllUsers()
{
    $sql = "SELECT * FROM dangnhap";
    return parent::Getdata($sql);
}
}
