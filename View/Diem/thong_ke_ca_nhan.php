<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Thống kê kết quả học tập</title>

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
            <a href="index.php?controllers=login&action=cai_dat&username=<?php echo $_SESSION['username']; ?>">Bảng điều khiển</a>
          </li>
          <li class="breadcrumb-item active">Thống kê kết quả</li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-pie"></i>
            Tóm tắt kết quả học tập tích lũy
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <table class="table table-borderless">
                  <tr>
                    <th width="40%">Họ và tên:</th>
                    <td><strong><?php echo $_SESSION['username']; ?></strong></td>
                  </tr>
                  <tr>
                    <th>Mã sinh viên:</th>
                    <td><strong><?php echo $_SESSION['ma_sv']; ?></strong></td>
                  </tr>
                </table>
              </div>

              <div class="col-md-6">
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                      <tr>
                        <th>Tổng tín chỉ đạt</th>
                        <th>Điểm trung bình (GPA)</th>
                        <th>Xếp loại học lực</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr align="center">
                        <td style="font-size: 24px; color: #007bff;"><strong><?php echo $TongSTC; ?></strong></td>
                        <td style="font-size: 24px; color: #28a745;"><strong><?php echo $gpa; ?></strong></td>
                        <td style="font-size: 24px; color: #dc3545;"><strong><?php echo $xep_loai; ?></strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <hr>
            <div class="alert alert-info">
              <i class="fas fa-info-circle"></i> 
              <strong>Ghi chú:</strong> Điểm trung bình tích lũy được tính trên thang điểm 4.0 theo quy định hiện hành. 
              Bạn có thể vào mục <strong>"Xem điểm học phần"</strong> để xem chi tiết từng môn.
            </div>
          </div>
          <div class="card-footer small text-muted">Cập nhật vào lúc <?php echo date("H:i"); ?> ngày <?php echo date("d/m/Y"); ?></div>
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