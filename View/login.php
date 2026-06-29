<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Đăng nhập</title>
  
  <link rel="stylesheet" href="bootstraps/css/dangnhap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đăng nhập</div>
      <div class="card-body">
        
        <form action="index.php?controllers=login&action=Admin" method="POST">
          
          <?php if (isset($thatbai)) { echo $thatbai; } ?>

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="username" id="inputUsername" class="form-control" placeholder=" " required autofocus>
              <label for="inputUsername">Username</label>
            </div>
          </div>

          <div class="form-group">
            <div class="password-box">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder=" " required>
              <label for="inputPassword">Password</label>
              <span class="toggle-password" onclick="togglePassword()">
                <i class="fa fa-eye" id="eyeIcon"></i>
              </span>
            </div>
          </div>

          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Ghi nhớ mật khẩu
              </label>
            </div>
          </div>
          
          <input type="submit" name="login" class="btn btn-primary btn-block" value="Đăng nhập">
        </form>

        <div class="text-center">
          
          <a class="d-block small" href="index.php?controllers=login&action=quen_mk">Quên mật khẩu?</a>
        </div>
        
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById("inputPassword");
      const eyeIcon = document.getElementById("eyeIcon");
      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        passwordField.type = "password";
        eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
      }
    }
  </script>
</body>
</html>