<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Trang chủ Sinh viên</title>
  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
  <?php require_once 'View/masster/header.php'; ?>
  <div id="wrapper">
    <?php require_once 'View/masster/footer.php'; ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Bảng điều khiển sinh viên</li>
        </ol>

        <div class="alert alert-primary">
           <h4>Xin chào, <strong><?php echo $_SESSION['username']; ?></strong>!</h4>
           <p class="mb-0">Chào mừng bạn quay trở lại hệ thống quản lý điểm.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon"><i class="fas fa-id-card"></i></div>
                <div class="mr-5">Mã SV: <strong><?php echo $_SESSION['ma_sv']; ?></strong></div>
              </div>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon"><i class="fas fa-book-reader"></i></div>
                <div class="mr-5">Tín chỉ tích lũy: <strong><?php echo $TongSTC; ?></strong></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon"><i class="fas fa-chart-line"></i></div>
                <div class="mr-5">Điểm GPA tích lũy: <strong><?php echo $gpa; ?></strong></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="mr-5">Trạng thái: <strong>Đang học</strong></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow">
                    <div class="card-header font-weight-bold text-primary">Hành động nhanh</div>
                    <div class="card-body">
                        <a href="index.php?controllers=diem&action=List_Diem&maSV=<?php echo $_SESSION['ma_sv']; ?>" class="btn btn-outline-primary btn-block mb-2">Xem bảng điểm chi tiết</a>
                        <a href="index.php?controllers=login&action=cai_dat&username=<?php echo $_SESSION['username']; ?>" class="btn btn-outline-secondary btn-block">Chỉnh sửa thông tin cá nhân</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow">
                    <div class="card-header font-weight-bold text-success">Thông báo</div>
                    <div class="card-body">
                        <p class="text-muted small italic">Hệ thống đang hoạt động bình thường. Điểm học phần của bạn luôn được cập nhật chính xác nhất.</p>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>