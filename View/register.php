<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Đăng ký tài khoản</title>

  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstraps/css/dangnhap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5" style="width: 550px;">
      <div class="card-header">Tạo tài khoản mới</div>
      <div class="card-body">
        
        <?php if (isset($thatbai)) { echo $thatbai; } ?>

        <form action="index.php?controllers=login&action=damg_ky" method="POST">
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name="txtfirstName" class="form-control" placeholder=" " required autofocus>
                  <label for="firstName">Họ</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" name="txtlastName" class="form-control" placeholder=" " required>
                  <label for="lastName">Tên</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsername" name="txtUsername" class="form-control" placeholder=" " required>
              <label for="inputUsername">Tên đăng nhập</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputMaSV" name="txtMaSV" class="form-control" placeholder=" " required>
              <label for="inputMaSV">Mã sinh viên (Ví dụ: DTC1, DTC11...)</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="txtEmail" class="form-control" placeholder=" " required>
              <label for="inputEmail">Địa chỉ Email</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                   <div class="password-box">
                      <input type="password" id="inputPassword" name="txtPassword" class="form-control" placeholder=" " required>
                      <label for="inputPassword">Mật khẩu</label>
                      <span class="toggle-password" onclick="togglePass('inputPassword', 'eye1')">
                        <i class="fa fa-eye" id="eye1"></i>
                      </span>
                   </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                   <div class="password-box">
                      <input type="password" id="confirmPassword" name="txtCfPassword" class="form-control" placeholder=" " required>
                      <label for="confirmPassword">Xác nhận</label>
                      <span class="toggle-password" onclick="togglePass('confirmPassword', 'eye2')">
                        <i class="fa fa-eye" id="eye2"></i>
                      </span>
                   </div>
                </div>
              </div>
            </div>
          </div>

          <input type="submit" name="Dangky" class="btn btn-primary btn-block" value="Đăng ký tài khoản">
        </form>

        <div class="text-center">
          <a class="d-block small mt-3" href="index.php?controllers=login">Đã có tài khoản? Đăng nhập</a>
          <a class="d-block small" href="index.php?controllers=login&action=quen_mk">Quên mật khẩu?</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePass(inputId, eyeId) {
      const field = document.getElementById(inputId);
      const icon = document.getElementById(eyeId);
      if (field.type === "password") {
        field.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        field.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
      }
    }
  </script>

  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>