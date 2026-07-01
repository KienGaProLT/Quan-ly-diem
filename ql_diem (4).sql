-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 04:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_diem`
--

-- --------------------------------------------------------

--
-- Table structure for table `dangnhap`
--

CREATE TABLE `dangnhap` (
  `hoten` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `emai` text NOT NULL,
  `quyen` int(11) DEFAULT 0,
  `ma_sv` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangnhap`
--

INSERT INTO `dangnhap` (`hoten`, `username`, `password`, `emai`, `quyen`, `ma_sv`) VALUES
('Phạm Văn Quang', '74DCTT23467', 'e10adc3949ba59abbe56e057f20f883e', '74DCTT23467@gmail.com', 0, '74DCTT23467'),
('Phạm Văn Dương', '74DCTT29506', 'e10adc3949ba59abbe56e057f20f883e', '74DCTT29506@gmail.com', 0, '74DCTT29506'),
('Nguyễn Dương', 'khacduong284', 'e10adc3949ba59abbe56e057f20f883e', 'khacduong284@gmail.com', 0, '74DCTT23450'),
('Phạm Kiên', 'kienpham9605', '96e79218965eb72c92a549dd5a330112', 'kienpham9605@gmail.com', 1, NULL),
('Trung Nguyên', 'trungnguyen', 'e10adc3949ba59abbe56e057f20f883e', 'trungnguyen@gmail.com', 0, '74DCTT22499');

-- --------------------------------------------------------

--
-- Table structure for table `diemhocphan`
--

CREATE TABLE `diemhocphan` (
  `ma_sv` varchar(50) NOT NULL,
  `ma_mon` varchar(50) NOT NULL,
  `diem_giua_ky` float NOT NULL,
  `diem_thi_hp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diemhocphan`
--

INSERT INTO `diemhocphan` (`ma_sv`, `ma_mon`, `diem_giua_ky`, `diem_thi_hp`) VALUES
('74DCTT20000', 'KTPM_K1_M1', 6, 7),
('74DCTT20000', 'KTPM_K1_M2', 7, 8),
('74DCTT20000', 'KTPM_K1_M3', 6, 6),
('74DCTT20000', 'KTPM_K1_M4', 9, 9),
('74DCTT20000', 'KTPM_K2_M1', 5, 5),
('74DCTT20000', 'KTPM_K2_M2', 6, 6),
('74DCTT20000', 'KTPM_K2_M3', 8, 9),
('74DCTT20000', 'KTPM_K2_M4', 7, 9),
('74DCTT20000', 'KTPM_K3_M1', 5, 6),
('74DCTT20000', 'KTPM_K3_M2', 5, 6),
('74DCTT20000', 'KTPM_K3_M3', 7, 7),
('74DCTT20000', 'KTPM_K3_M4', 8, 9),
('74DCTT20000', 'KTPM_K4_M1', 10, 10),
('74DCTT20000', 'KTPM_K4_M2', 7, 8),
('74DCTT20000', 'KTPM_K4_M3', 6, 6),
('74DCTT20000', 'KTPM_K4_M4', 8, 8),
('74DCTT21232', 'KTPM_K1_M1', 7, 8),
('74DCTT21232', 'KTPM_K1_M2', 7, 9),
('74DCTT21232', 'KTPM_K1_M3', 7, 7),
('74DCTT21232', 'KTPM_K1_M4', 5, 5),
('74DCTT21232', 'KTPM_K2_M1', 6, 6),
('74DCTT21232', 'KTPM_K2_M2', 6, 8),
('74DCTT21232', 'KTPM_K2_M3', 9, 8),
('74DCTT21232', 'KTPM_K2_M4', 8, 8),
('74DCTT21232', 'KTPM_K3_M1', 6, 7),
('74DCTT21232', 'KTPM_K3_M2', 7, 6),
('74DCTT21232', 'KTPM_K3_M3', 8, 8),
('74DCTT21232', 'KTPM_K3_M4', 4, 5),
('74DCTT21232', 'KTPM_K4_M1', 10, 9),
('74DCTT21232', 'KTPM_K4_M2', 8, 7),
('74DCTT21232', 'KTPM_K4_M3', 7, 7),
('74DCTT21232', 'KTPM_K4_M4', 9, 9),
('74DCTT22433', 'QTVP_K1_M1', 7, 6),
('74DCTT22433', 'QTVP_K1_M2', 8, 8),
('74DCTT22433', 'QTVP_K1_M3', 9, 8),
('74DCTT22433', 'QTVP_K1_M4', 7, 7),
('74DCTT22433', 'QTVP_K2_M1', 4, 5),
('74DCTT22433', 'QTVP_K2_M2', 8, 9),
('74DCTT22433', 'QTVP_K2_M3', 7, 8),
('74DCTT22433', 'QTVP_K2_M4', 7, 8),
('74DCTT22433', 'QTVP_K3_M1', 9, 8),
('74DCTT22433', 'QTVP_K3_M2', 7, 8),
('74DCTT22433', 'QTVP_K3_M3', 7, 8),
('74DCTT22433', 'QTVP_K3_M4', 6, 7),
('74DCTT22433', 'QTVP_K4_M1', 7, 8),
('74DCTT22433', 'QTVP_K4_M2', 6, 4),
('74DCTT22433', 'QTVP_K4_M3', 7, 8),
('74DCTT22433', 'QTVP_K4_M4', 6, 7),
('74DCTT22499', 'CNTT_K1_M1', 7, 8),
('74DCTT22499', 'CNTT_K1_M2', 7, 8),
('74DCTT22499', 'CNTT_K1_M3', 8, 9),
('74DCTT22499', 'CNTT_K1_M4', 9, 1),
('74DCTT22499', 'CNTT_K2_M1', 9, 8),
('74DCTT22499', 'CNTT_K2_M2', 7, 8),
('74DCTT22499', 'CNTT_K2_M3', 6, 7),
('74DCTT22499', 'CNTT_K2_M4', 8, 8),
('74DCTT22499', 'CNTT_K3_M1', 5, 6),
('74DCTT22499', 'CNTT_K3_M2', 7, 6),
('74DCTT22499', 'CNTT_K3_M3', 8, 9),
('74DCTT22499', 'CNTT_K3_M4', 7, 8),
('74DCTT22499', 'CNTT_K4_M1', 7, 8),
('74DCTT22499', 'CNTT_K4_M2', 8, 8),
('74DCTT22499', 'CNTT_K4_M3', 4, 5),
('74DCTT22499', 'CNTT_K4_M4', 8, 10),
('74DCTT23450', 'QTVP_K1_M1', 6, 7),
('74DCTT23450', 'QTVP_K1_M2', 9, 9),
('74DCTT23450', 'QTVP_K1_M3', 8, 9),
('74DCTT23450', 'QTVP_K1_M4', 7, 8),
('74DCTT23450', 'QTVP_K2_M1', 5, 7),
('74DCTT23450', 'QTVP_K2_M2', 9, 9),
('74DCTT23450', 'QTVP_K2_M3', 8, 8),
('74DCTT23450', 'QTVP_K2_M4', 8, 9),
('74DCTT23450', 'QTVP_K3_M1', 9, 10),
('74DCTT23450', 'QTVP_K3_M2', 7, 8),
('74DCTT23450', 'QTVP_K3_M3', 7, 8),
('74DCTT23450', 'QTVP_K3_M4', 7, 8),
('74DCTT23450', 'QTVP_K4_M1', 9, 9),
('74DCTT23450', 'QTVP_K4_M2', 6, 4),
('74DCTT23450', 'QTVP_K4_M3', 8, 8),
('74DCTT23450', 'QTVP_K4_M4', 7, 8),
('74DCTT29343', 'CNTT_K1_M1', 9, 10),
('74DCTT29343', 'CNTT_K1_M2', 6, 6),
('74DCTT29343', 'CNTT_K1_M3', 5, 6),
('74DCTT29343', 'CNTT_K1_M4', 9, 9),
('74DCTT29343', 'CNTT_K2_M1', 9, 7),
('74DCTT29343', 'CNTT_K2_M2', 8, 7),
('74DCTT29343', 'CNTT_K2_M3', 8, 10),
('74DCTT29343', 'CNTT_K2_M4', 9, 9),
('74DCTT29343', 'CNTT_K3_M1', 6, 7),
('74DCTT29343', 'CNTT_K3_M2', 7, 5),
('74DCTT29343', 'CNTT_K3_M3', 9, 9),
('74DCTT29343', 'CNTT_K3_M4', 8, 9),
('74DCTT29343', 'CNTT_K4_M1', 7, 7),
('74DCTT29343', 'CNTT_K4_M2', 7, 5),
('74DCTT29343', 'CNTT_K4_M3', 5, 6),
('74DCTT29343', 'CNTT_K4_M4', 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `ma_hk` varchar(10) NOT NULL,
  `ten_hk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocky`
--

INSERT INTO `hocky` (`ma_hk`, `ten_hk`) VALUES
('HK1', 'Học kỳ I'),
('HK2', 'Học kỳ II'),
('HK3', 'Học kỳ III'),
('HK4', 'Học kỳ IV');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `ma_lop` varchar(50) NOT NULL,
  `ten_lop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`ma_lop`, `ten_lop`) VALUES
('CNTT', 'Công nghệ thông tin'),
('KTPM', 'Kỹ thuật phầm mềm'),
('QTVP', 'Quản trị văn phòng');

-- --------------------------------------------------------

--
-- Table structure for table `monhocphan`
--

CREATE TABLE `monhocphan` (
  `ma_mon` varchar(50) NOT NULL,
  `ten_mon` varchar(255) NOT NULL,
  `sotinchi` int(11) NOT NULL,
  `ma_hk` varchar(10) NOT NULL,
  `ma_lop` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monhocphan`
--

INSERT INTO `monhocphan` (`ma_mon`, `ten_mon`, `sotinchi`, `ma_hk`, `ma_lop`) VALUES
('CNTT_K1_M1', 'Nhập môn lập trình', 3, 'HK1', 'CNTT'),
('CNTT_K1_M2', 'Tin học đại cương', 2, 'HK1', 'CNTT'),
('CNTT_K1_M3', 'Toán rời rạc', 3, 'HK1', 'CNTT'),
('CNTT_K1_M4', 'Anh văn cơ bản 1', 2, 'HK1', 'CNTT'),
('CNTT_K2_M1', 'Cấu trúc dữ liệu & Giải thuật', 3, 'HK2', 'CNTT'),
('CNTT_K2_M2', 'Mạng máy tính', 3, 'HK2', 'CNTT'),
('CNTT_K2_M3', 'Hệ điều hành', 3, 'HK2', 'CNTT'),
('CNTT_K2_M4', 'Anh văn cơ bản 2', 2, 'HK2', 'CNTT'),
('CNTT_K3_M1', 'Cơ sở dữ liệu', 3, 'HK3', 'CNTT'),
('CNTT_K3_M2', 'Lập trình Web', 3, 'HK3', 'CNTT'),
('CNTT_K3_M3', 'Lập trình Java', 3, 'HK3', 'CNTT'),
('CNTT_K3_M4', 'Công nghệ mạng', 3, 'HK3', 'CNTT'),
('CNTT_K4_M1', 'Trí tuệ nhân tạo', 2, 'HK4', 'CNTT'),
('CNTT_K4_M2', 'An toàn bảo mật thông tin', 2, 'HK4', 'CNTT'),
('CNTT_K4_M3', 'Kiểm thử phần mềm', 3, 'HK4', 'CNTT'),
('CNTT_K4_M4', 'Lập trình di động', 3, 'HK4', 'CNTT'),
('KTPM_K1_M1', 'Lập trình C++', 3, 'HK1', 'KTPM'),
('KTPM_K1_M2', 'Nhập môn kỹ thuật phần mềm', 2, 'HK1', 'KTPM'),
('KTPM_K1_M3', 'Đại số tuyến tính', 3, 'HK1', 'KTPM'),
('KTPM_K1_M4', 'Pháp luật đại cương', 2, 'HK1', 'KTPM'),
('KTPM_K2_M1', 'Phân tích thiết kế hệ thống', 3, 'HK2', 'KTPM'),
('KTPM_K2_M2', 'Cơ sở dữ liệu nâng cao', 3, 'HK2', 'KTPM'),
('KTPM_K2_M3', 'Lập trình hướng đối tượng', 3, 'HK2', 'KTPM'),
('KTPM_K2_M4', 'Kỹ năng mềm', 2, 'HK2', 'KTPM'),
('KTPM_K3_M1', 'Thiết kế giao diện (UI/UX)', 2, 'HK3', 'KTPM'),
('KTPM_K3_M2', 'Kiến trúc phần mềm', 3, 'HK3', 'KTPM'),
('KTPM_K3_M3', 'Lập trình .NET', 3, 'HK3', 'KTPM'),
('KTPM_K3_M4', 'Quản lý dự án phần mềm', 3, 'HK3', 'KTPM'),
('KTPM_K4_M1', 'Công nghệ Web nâng cao', 3, 'HK4', 'KTPM'),
('KTPM_K4_M2', 'Xây dựng phần mềm hướng dịch vụ', 3, 'HK4', 'KTPM'),
('KTPM_K4_M3', 'Đồ án chuyên ngành 1', 2, 'HK4', 'KTPM'),
('KTPM_K4_M4', 'Đảm bảo chất lượng phần mềm', 2, 'HK4', 'KTPM'),
('QTVP_K1_M1', 'Quản trị học đại cương', 3, 'HK1', 'QTVP'),
('QTVP_K1_M2', 'Kinh tế vi mô', 3, 'HK1', 'QTVP'),
('QTVP_K1_M3', 'Soạn thảo văn bản', 2, 'HK1', 'QTVP'),
('QTVP_K1_M4', 'Tin học văn phòng 1', 2, 'HK1', 'QTVP'),
('QTVP_K2_M1', 'Quản trị nhân sự', 3, 'HK2', 'QTVP'),
('QTVP_K2_M2', 'Kinh tế vĩ mô', 3, 'HK2', 'QTVP'),
('QTVP_K2_M3', 'Giao tiếp kinh doanh', 2, 'HK2', 'QTVP'),
('QTVP_K2_M4', 'Tin học văn phòng 2', 2, 'HK2', 'QTVP'),
('QTVP_K3_M1', 'Lưu trữ học', 2, 'HK3', 'QTVP'),
('QTVP_K3_M2', 'Tâm lý học quản lý', 2, 'HK3', 'QTVP'),
('QTVP_K3_M3', 'Luật hành chính', 3, 'HK3', 'QTVP'),
('QTVP_K3_M4', 'Quản trị sự kiện', 3, 'HK3', 'QTVP'),
('QTVP_K4_M1', 'Văn hóa tổ chức', 2, 'HK4', 'QTVP'),
('QTVP_K4_M2', 'Thư ký văn phòng', 3, 'HK4', 'QTVP'),
('QTVP_K4_M3', 'Quản trị văn phòng điện tử', 3, 'HK4', 'QTVP'),
('QTVP_K4_M4', 'Thực tập cơ sở', 2, 'HK4', 'QTVP');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `ma_sv` varchar(50) NOT NULL,
  `hoten_sv` varchar(255) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` varchar(5) NOT NULL,
  `dan_toc` varchar(30) NOT NULL,
  `noi_sinh` varchar(255) NOT NULL,
  `ma_lop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`ma_sv`, `hoten_sv`, `ngay_sinh`, `gioi_tinh`, `dan_toc`, `noi_sinh`, `ma_lop`) VALUES
('74DCTT20000', 'Trần Đức Nam', '2005-05-17', 'Nam', 'kinh', 'hà nội', 'CNTT'),
('74DCTT21232', 'Nguyễn Tuấn Hưng', '2005-01-23', 'Nam', 'kinh', 'hà nội', 'KTPM'),
('74DCTT22433', 'Nguyễn Quốc Bảo', '2005-03-16', 'Nam', 'thái', 'hà tĩnh', 'QTVP'),
('74DCTT22499', 'Phạm Trung Nguyên', '2005-06-09', 'Nam', 'kinh', 'nam định', 'CNTT'),
('74DCTT23450', 'Nguyễn Khắc Dương', '2005-04-28', 'Nam', 'kinh', 'phú lương', 'QTVP'),
('74DCTT23467', 'Phạm Văn Quang', '2000-06-05', 'Nam', 'kinh', 'việt nam', 'CNTT'),
('74DCTT29343', 'Nguyễn Bá Duy Phương', '2005-04-27', 'Nam', 'kinh', 'thạch thất', 'CNTT'),
('74DCTT29506', 'Phạm Văn Dương', '2000-03-06', 'Nam', 'kinh', 'việt nam', 'KTPM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD PRIMARY KEY (`username`),
  ADD KEY `ma_sv` (`ma_sv`);

--
-- Indexes for table `diemhocphan`
--
ALTER TABLE `diemhocphan`
  ADD UNIQUE KEY `ma_sv` (`ma_sv`,`ma_mon`),
  ADD KEY `ma_mon` (`ma_mon`);

--
-- Indexes for table `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`ma_hk`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`ma_lop`);

--
-- Indexes for table `monhocphan`
--
ALTER TABLE `monhocphan`
  ADD PRIMARY KEY (`ma_mon`),
  ADD KEY `ma_hk` (`ma_hk`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`ma_sv`),
  ADD KEY `ma_lop` (`ma_lop`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD CONSTRAINT `dangnhap_ibfk_1` FOREIGN KEY (`ma_sv`) REFERENCES `sinhvien` (`ma_sv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
