<?php 

class Database_ql_diem
{
    private static $hostname = "db";
    private static $username = "root";
    private static $password = "root";
    private static $database = "ql_diem"; // Tên database của bạn
    protected static $conn = NULL;
    
    // Hàm kết nối Database
    public static function Connect()
    {
        // Sử dụng mysqli theo hướng đối tượng để đồng bộ với các hàm bên dưới
        self::$conn = new mysqli(self::$hostname, self::$username, self::$password, self::$database);

        if (self::$conn->connect_error) {
            die("Kết nối database thất bại: " . self::$conn->connect_error);
        } else {
            // Đảm bảo dữ liệu tiếng Việt hiển thị đúng
            self::$conn->set_charset('utf8');
        }
    }

    // Hàm thực thi câu lệnh SQL (INSERT, UPDATE, DELETE)
    public static function Execute($sql)
    {
        // Tự động kết nối nếu chưa có kết nối
        if (self::$conn == NULL) {
            self::Connect();
        }
        return self::$conn->query($sql);
    }   

    // Hàm lấy dữ liệu (SELECT) trả về mảng
    public static function Getdata($sql)
    {
        $result = self::Execute($sql);
        $arr = array(); // Luôn khởi tạo là mảng rỗng để tránh lỗi foreach

        // Kiểm tra nếu truy vấn thành công và có dữ liệu (Hướng đối tượng)
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
        }
        // Trả về mảng (dù có dữ liệu hay rỗng), giúp trang Cài đặt không bị sập
        return $arr; 
    }

    // --- Các hàm hỗ trợ tính toán và hiển thị điểm ---

    // Chuyển điểm số sang thang điểm 4
    public static function H_Diem($diem)
    {
        if ($diem >= 8.5) return 4;
        if ($diem >= 7) return 3;
        if ($diem >= 5.5) return 2;
        if ($diem >= 4) return 1;
        return 0;
    }

    // Chuyển điểm số sang điểm chữ
    public static function Diem_C($diem)
    {
        if ($diem >= 8.5) return "A";
        if ($diem >= 7) return "B";
        if ($diem >= 5.5) return "C";
        if ($diem >= 4) return "D";
        return "F";
    }

    // Xếp loại học lực dựa trên điểm tích lũy thang 4
    public static function XL($diem)
    {
        if ($diem >= 3.6) return "Xuất sắc";
        if ($diem >= 3.2) return "Giỏi";
        if ($diem >= 2.5) return "Khá";
        if ($diem >= 2) return "Trung bình";
        return "Yếu";
    }
}
?>