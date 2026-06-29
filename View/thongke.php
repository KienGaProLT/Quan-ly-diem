<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Thống kê hệ thống</title>

  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bootstraps/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
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
            <a href="#">Bảng điều khiển</a>
          </li>
          <li class="breadcrumb-item active">Thống kê kết quả học tập</li>
        </ol>

        <div class="card mb-3">
          <div class="card-body">
            <form action="index.php" method="GET" class="form-inline">
                <input type="hidden" name="controllers" value="diem">
                <input type="hidden" name="action" value="Thong_ke">
                
                <label class="mr-sm-2 font-weight-bold">Chế độ xem:</label>
                <select name="maHK" class="form-control mb-2 mr-sm-2 mb-sm-0" onchange="this.form.submit()">
                    <option value="">-- Tổng hợp toàn khóa --</option>
                    <?php if(isset($listhocky)) { 
                        foreach ($listhocky as $hk) { ?>
                        <option value="<?php echo $hk['ma_hk']; ?>" <?php echo (isset($_GET['maHK']) && $_GET['maHK'] == $hk['ma_hk']) ? 'selected' : ''; ?>>
                            <?php echo $hk['ten_hk']; ?>
                        </option>
                    <?php } } ?>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Lọc dữ liệu</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Bảng thống kê sinh viên - 
            <strong><?php echo (isset($_GET['maHK']) && $_GET['maHK'] != '') ? "Học kỳ ".$_GET['maHK'] : "Tất cả học kỳ"; ?></strong>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Dân tộc</th>
                    <th>Nơi sinh</th>
                    <th>Lớp</th>
                    <th>Tổng STC</th>
                    <th>TB học kỳ/khóa</th>
                    <th>XL học kỳ/khóa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $STT = 0;
                    if(isset($sv)) {
                      foreach ($sv as $value) {
                        $STT++;
                   ?>
                  <tr>
                    <td><?php echo $STT; ?></td>
                    <td><?php echo $value['ma_sv']; ?></td>
                    <td><?php echo $value['hoten_sv']; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($value['ngay_sinh'])); ?></td>
                    <td><?php echo $value['gioi_tinh']; ?></td>
                    <td><?php echo $value['dan_toc']; ?></td>
                    <td><?php echo $value['noi_sinh']; ?></td>
                    <td><?php echo $value['ten_lop']; ?></td>
                    <td><?php echo $value['STC']; ?></td>
                    <td><strong><?php echo $value['TB_Toankhoa']; ?></strong></td>
                    <td>
                        <?php 
                        // Hiển thị xếp loại với màu sắc để dễ quan sát
                        $xl = $value['XL_Toankhoa'];
                        if($xl == "Xuất sắc") echo "<span class='badge badge-primary'>$xl</span>";
                        elseif($xl == "Giỏi") echo "<span class='badge badge-success'>$xl</span>";
                        elseif($xl == "Khá") echo "<span class='badge badge-info'>$xl</span>";
                        elseif($xl == "Yếu") echo "<span class='badge badge-danger'>$xl</span>";
                        else echo "<span class='badge badge-secondary'>$xl</span>";
                        ?>
                    </td>
                  </tr>
                  <?php 
                      }
                    }
                   ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Hệ thống tự động tính toán dựa trên dữ liệu học kỳ đã chọn.</div>
        </div>

      </div>
      </div>
    </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Bạn có chắc chắn muốn đăng xuất tài khoản không?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
          <a class="btn btn-primary" href="index.php">Đăng xuất</a>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="bootstraps/vendor/jquery/jquery.min.js"></script>
<script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="bootstraps/vendor/chart.js/Chart.min.js"></script>
<script src="bootstraps/vendor/datatables/jquery.dataTables.js"></script>
<script src="bootstraps/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="bootstraps/js/sb-admin.min.js"></script>
<script src="bootstraps/js/demo/datatables-demo.js"></script>
<script src="bootstraps/js/demo/chart-area-demo.js"></script>
</html>