<?php

require_once __DIR__ . '/../Connect/connect.php';
class DiemMHP extends Database_ql_diem
{
	public static function ADD($text_masv, $text_mamon, $text_diemgk, $text_diemthk)
	{
		$sql = "INSERT INTO diemhocphan(ma_sv, ma_mon, diem_giua_ky, diem_thi_hp) VALUES ('$text_masv','$text_mamon','$text_diemgk','$text_diemthk')";
		return parent::Execute($sql);
	}
	public static function Edit($text_masv, $text_mamon, $text_diemgk, $text_diemthk)
	{
		$sql = "UPDATE diemhocphan SET ma_sv='$text_masv',ma_mon='$text_mamon',diem_giua_ky='$text_diemgk',diem_thi_hp='$text_diemthk' WHERE diemhocphan.ma_sv = '$text_masv' AND diemhocphan.ma_mon='$text_mamon'";
		return parent::Execute($sql);
	}
	public static function Delete($text_masv, $text_mamon)
	{
		$sql = "DELETE FROM diemhocphan WHERE diemhocphan.ma_sv = '$text_masv' AND diemhocphan.ma_mon='$text_mamon'";
		return parent::Execute($sql);
	}
	// lấy tất cả môn cho từng sinh viên 
	public static function List($text_masv)
	{
		$sql = "SELECT * FROM sinhvien s, lop l, monhocphan m, diemhocphan d, hocky h WHERE s.ma_sv = d.ma_sv AND s.ma_lop = l.ma_lop AND m.ma_mon = d.ma_mon AND m.ma_hk = h.ma_hk AND s.ma_sv= '$text_masv'";
		return parent::Getdata($sql);
	}
	// lấy ds sinh viên trong 1 lớp
	public static function Lop_Sinhvien($txt_malop)
	{
		$sql = "SELECT * FROM sinhvien,lop WHERE sinhvien.ma_lop = lop.ma_lop AND sinhvien.ma_lop='$txt_malop'";
		return parent::Getdata($sql);
	}
	// lấy từng môn của từng sinh viên
	public static function D_M_SV($text_masv, $text_mamon)
	{
		$sql = "SELECT * FROM monhocphan m, sinhvien s, diemhocphan d WHERE m.ma_mon = d.ma_mon AND d.ma_sv = s.ma_sv AND d.ma_mon = '$text_mamon' AND d.ma_sv = '$text_masv'";
		return parent::Getdata($sql);
	}
	public static function SinhVien_ChuaNhapDiem($maLop, $maMon)
	{
		// Truy vấn những SV thuộc lớp $maLop nhưng KHÔNG tồn tại trong bảng điểm của môn $maMon
		$sql = "SELECT * FROM sinhvien 
            WHERE ma_lop = '$maLop' 
            AND ma_sv NOT IN (SELECT ma_sv FROM diemhocphan WHERE ma_mon = '$maMon')";
		return Database_ql_diem::Getdata($sql);
	}
	// Thêm vào trong class DiemMHP
	public static function SinhVien_DaNhapDiem($maLop, $maMon)
	{
		// JOIN giữa bảng sinhvien và diemhocphan để lấy thông tin SV kèm điểm số
		$sql = "SELECT s.*, d.diem_giua_ky, d.diem_thi_hp, d.ma_mon 
            FROM sinhvien s 
            JOIN diemhocphan d ON s.ma_sv = d.ma_sv 
            WHERE s.ma_lop = '$maLop' AND d.ma_mon = '$maMon'";
		return parent::Getdata($sql);
	}
	// Thêm vào class DiemMHP hoặc TongDiemChitiet
	public static function Diem_GPA_Theo_HocKy($maSV)
	{
		// JOIN 3 bảng để lấy đầy đủ thông tin: Điểm, Tên môn, Số tín chỉ và Học kỳ
		$sql = "SELECT d.*, m.ten_mon, m.sotinchi, h.ten_hk, h.ma_hk 
            FROM diemhocphan d 
            JOIN monhocphan m ON d.ma_mon = m.ma_mon 
            JOIN hocky h ON m.ma_hk = h.ma_hk 
            WHERE d.ma_sv = '$maSV' 
            ORDER BY h.ma_hk ASC";
		return parent::Getdata($sql);
	}
	// Thêm vào class DiemMHP
	public static function List_Hoc_Lai($maMon)
	{
		// Lọc sinh viên học lại dựa trên môn học cụ thể
		// Điều kiện: Điểm thi < 2 HOẶC Điểm trung bình < 4
		$sql = "SELECT d.*, sv.hoten_sv, m.ten_mon 
            FROM diemhocphan d
            JOIN sinhvien sv ON d.ma_sv = sv.ma_sv
            JOIN monhocphan m ON d.ma_mon = m.ma_mon
            WHERE d.ma_mon = '$maMon' 
            AND (d.diem_thi_hp < 2 OR (d.diem_giua_ky * 0.3 + d.diem_thi_hp * 0.7) < 4)
            ORDER BY sv.ma_sv ASC";
		return parent::Getdata($sql);
	}
}
