<?php

require_once __DIR__ . '/../Connect/connect.php';
class TongDiemChitiet extends Database_ql_diem
{
	public static function HDS($text_diem)
	{
		return parent::H_Diem($text_diem);
	}
	public static function DC($text_diem)
	{
		return parent::Diem_C($text_diem);
	}
	public static function XL_TK($text_diem)
	{
		return parent::XL($text_diem);
	}

	// 1. Lấy điểm cho từng sinh viên (Dùng trong Dashboard/Xem điểm cá nhân)
	public static function DiemHP($txt_sinhvien)
	{
		// THÊM: m.ma_hk vào SELECT và GROUP BY
		$sql = "SELECT s.ma_sv, s.hoten_sv, m.ma_mon, m.ten_mon, m.sotinchi, m.ma_hk, d.diem_giua_ky, d.diem_thi_hp, h.ten_hk 
                FROM monhocphan m, sinhvien s, diemhocphan d, hocky h 
                WHERE m.ma_mon = d.ma_mon AND s.ma_sv = d.ma_sv AND s.ma_sv = '$txt_sinhvien' AND m.ma_hk = h.ma_hk 
                GROUP BY s.ma_sv, s.hoten_sv, m.ma_mon, m.ten_mon, m.sotinchi, m.ma_hk, d.diem_giua_ky, d.diem_thi_hp, h.ten_hk";
		return parent::Getdata($sql);
	}

	// 2. Lấy điểm phục vụ tính GPA (Dùng trong Thống kê hệ thống)
	public static function TDiem($txt_sinhvien)
	{
		// QUAN TRỌNG: Phải thêm m.ma_hk để Controller thực hiện lọc theo kỳ
		$sql = "SELECT m.ma_mon, m.ten_mon, m.sotinchi, m.ma_hk, d.diem_giua_ky, d.diem_thi_hp, s.ma_sv, s.hoten_sv, s.ngay_sinh, s.gioi_tinh, s.dan_toc, s.noi_sinh 
                FROM monhocphan m, diemhocphan d, sinhvien s 
                WHERE m.ma_mon = d.ma_mon AND d.ma_sv = s.ma_sv AND s.ma_sv = '$txt_sinhvien' 
                GROUP BY m.ma_mon, m.ten_mon, m.sotinchi, m.ma_hk, d.diem_giua_ky, d.diem_thi_hp, s.ma_sv, s.hoten_sv, s.ngay_sinh, s.gioi_tinh, s.dan_toc, s.noi_sinh";
		return parent::Getdata($sql);
	}

	public static function Thong_ke()
	{
		$sql = "SELECT * FROM sinhvien s, lop l, monhocphan m, diemhocphan d, hocky h 
                WHERE s.ma_sv = d.ma_sv AND s.ma_lop = l.ma_lop AND m.ma_mon = d.ma_mon AND m.ma_hk = h.ma_hk 
                ORDER BY s.ma_sv ASC";
		return parent::Getdata($sql);
	}

	public static function Search_Diem_HP($maSV, $key)
	{
		$sql = "SELECT d.*, m.*, h.ten_hk 
            FROM diemhocphan d
            JOIN monhocphan m ON d.ma_mon = m.ma_mon 
            JOIN hocky h ON m.ma_hk = h.ma_hk
            WHERE d.ma_sv = '$maSV' 
            AND (m.ten_mon LIKE '%$key%' OR m.ma_mon LIKE '%$key%')";

		return Database_ql_diem::Getdata($sql);
	}
	public static function List_Thi_Lai_SV($maSV)
	{
		// Điều kiện: Điểm thi < 2 HOẶC Điểm trung bình học phần < 4
		$sql = "SELECT d.*, m.ten_mon, m.sotinchi, h.ten_hk 
            FROM diemhocphan d
            JOIN monhocphan m ON d.ma_mon = m.ma_mon
            JOIN hocky h ON m.ma_hk = h.ma_hk
            WHERE d.ma_sv = '$maSV' 
            AND (d.diem_thi_hp < 2 OR (d.diem_giua_ky * 0.3 + d.diem_thi_hp * 0.7) < 4)";
		return parent::Getdata($sql);
	}
}
