<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cài đặt tài khoản</title>

  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>

<body id="page-top">
  <?php require_once 'View/masster/header.php'; ?>
  
  <div id="wrapper">
    <?php require_once 'View/masster/footer.php'; ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php?controllers=quanly&action=Admin">Bảng điều khiển</a>
          </li>
          <li class="breadcrumb-item active">Cài đặt tài khoản</li>
        </ol>

        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header">Cài đặt thông tin cá nhân</div>
            
            <div class="card-body">
              <?php 
              // Hiển thị thông báo thất bại nếu có
              if (isset($thatbai)) {
                echo "<div class='alert alert-danger'>".$thatbai."</div>";
              } 

              // Đổi tên thành $data_user_account để tránh trùng lặp biến hệ thống
              if (isset($data_user_account) && is_array($data_user_account)) {
                  foreach ($data_user_account as $value): 
              ?>
                <form action="#" method="POST">
                  
                  <input type="hidden" name="txt_quyen" value="<?php echo $value['quyen']; ?>">
                  <input type="hidden" name="txt_masv" value="<?php echo $value['ma_sv']; ?>">

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="firstName" name="txtfirstName" class="form-control" placeholder="Họ và tên" value="<?php echo $value['hoten']?>" required="required" autofocus="autofocus">
                      <label for="firstName">Họ và tên</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="inputUsername" name="txtUsername" class="form-control" placeholder="Tên đăng nhập" value="<?php echo $value['username']?>" required="required">
                      <label for="inputUsername">Tên đăng nhập</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="email" id="inputEmail" name="txtEmail" class="form-control" placeholder="Địa chỉ Email" value="<?php echo $value['emai']?>" required="required">
                      <label for="inputEmail">Địa chỉ Email</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" id="inputPassword" name="txtPassword" class="form-control" placeholder="Mật khẩu" value="<?php echo $value['password']?>" required="required">
                      <label for="inputPassword">Mật khẩu (Đã mã hóa)</label>
                    </div>
                  </div>

                  <input type="submit" name="Luu" class="btn btn-primary btn-block" value="Lưu thay đổi">
                  
                  <div class="text-center mt-3">
                    <a class="text-danger small" href="index.php?controllers=login&action=Xoa_tk" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn tài khoản này không?')">Xóa tài khoản này</a>
                  </div>
                </form>
              <?php 
                  endforeach; 
              } else {
                  // Hiển thị lỗi SQL thực tế để debug nếu biến không phải mảng
                  echo "<div class='alert alert-warning'>";
                  echo "<strong>Lỗi hệ thống:</strong> Không thể lấy dữ liệu tài khoản.<br>";
                  echo "Chi tiết lỗi: <pre>" . (isset($data_user_account) ? (is_string($data_user_account) ? $data_user_account : "Dữ liệu không hợp lệ") : "Biến chưa được khởi tạo") . "</pre>";
                  echo "<em>Gợi ý: Hãy kiểm tra lại file Controller xem đã gán dữ liệu vào biến \$data_user_account chưa.</em>";
                  echo "</div>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="bootstraps/js/sb-admin.min.js"></script>
</body>

</html>