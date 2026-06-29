<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Quên mật khẩu</title>

  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstraps/css/dangnhap.css">
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đặt lại mật khẩu</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Quên mật khẩu?</h4>
          <p>Vui lòng nhập chính xác thông tin để thiết lập lại mật khẩu mới.</p>
        </div>

        <?php 
            if (isset($thatbai)) echo $thatbai; 
            if (isset($thanhcong)) echo $thanhcong;
        ?>

        <form action="index.php?controllers=login&action=quen_mk" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="txtUsername" id="inputUser" class="form-control" placeholder="Tên đăng nhập" required autofocus>
              <label for="inputUser">Tên đăng nhập</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="txtEmail" id="inputEmail" class="form-control" placeholder="Email đăng ký" required>
              <label for="inputEmail">Email đăng ký</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="txtNewPass" id="inputNewPass" class="form-control" placeholder="Mật khẩu mới" required>
              <label for="inputNewPass">Mật khẩu mới</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="txtCfPass" id="inputCfPass" class="form-control" placeholder="Xác nhận mật khẩu" required>
              <label for="inputCfPass">Xác nhận mật khẩu mới</label>
            </div>
          </div>

          <button type="submit" name="btnQuenMK" class="btn btn-primary btn-block">Đổi mật khẩu</button>
        </form>

        <div class="text-center">
          <a class="d-block small" href="index.php?controllers=login">Quay lại Đăng nhập</a>
        </div>
      </div>
    </div>
  </div>

  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>