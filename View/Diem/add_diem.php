<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Thêm Điểm học phần</title>

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
            <a href="index.php?controllers=quanly&action=Admin">Bảng điểu kiểm</a>
          </li>
          <li class="breadcrumb-item active">Thêm điểm</li>
        </ol>

        <div class="container">
          <div class="card card-login mx-auto mt-5">
            <div class="card-header">Thêm điểm học phần</div>
            <div class="card-body">
              <form action="#" method="POST">
                <?php if (isset($thatbai)) {
                  echo "<span style='color:red'>".($thatbai)."</span>";
                }
                elseif (isset($thanhcong)) {
                  echo "<span style='color:green'>".($thanhcong)."</span>";
                }
                ?>

                <div class="form-group">
                  <label for="sel1">Họ và tên</label>
                  <?php if (isset($maSV_ready)): ?>
                    <input type="text" class="form-control" value="<?php 
                        foreach($list_sv as $s){ if($s['ma_sv']==$maSV_ready) echo $s['hoten_sv']; } 
                    ?>" readonly style="background: #e9ecef;">
                    <input type="hidden" name="sellist1" value="<?php echo $maSV_ready; ?>">
                  <?php else: ?>
                    <select class="form-control" id="sel1" name="sellist1">
                      <?php foreach ($list_sv as $value) { ?>
                        <option value="<?php echo $value['ma_sv']; ?>"><?php echo $value['hoten_sv']; ?></option>
                      <?php } ?>
                    </select>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label for="sel2">Tên học phần</label>
                  <?php if (isset($maMon_ready)): ?>
                    <input type="text" class="form-control" value="<?php echo $tenMon_hien_thi; ?>" readonly style="background: #e9ecef;">
                    <input type="hidden" name="sellist2" value="<?php echo $maMon_ready; ?>">
                  <?php else: ?>
                    <select class="form-control" id="sel2" name="sellist2" size="3">
                      <?php foreach ($list_hp as $value) { ?>
                        <option value="<?php echo $value['ma_mon']; ?>"><?php echo $value['ten_mon']; ?></option>
                      <?php } ?>
                    </select>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="txt_diemGK" id="inputdiemGK" class="form-control" placeholder="Điểm giữa kỳ" required="required">
                    <label for="inputdiemGK">Điểm giữa kỳ</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="txt_diemTHK" id="inputdiemTHK" class="form-control" placeholder="Điểm thi học kỳ" required="required">
                    <label for="inputdiemTHK">Điểm thi học kỳ</label>
                  </div>
                </div>
                
                <input type="submit" name="themDiem" class="btn btn-primary btn-block" value="Thêm điểm">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</body>
<script src="bootstraps/vendor/jquery/jquery.min.js"></script>
<script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="bootstraps/js/sb-admin.min.js"></script>
</html>