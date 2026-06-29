<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin - Thêm học phần</title>

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
            <a href="#">Bảng học phần</a>
          </li>
          <li class="breadcrumb-item active">Thêm mới</li>
        </ol>

        <div class="container">
          <div class="card card-login mx-auto mt-5">
            <div class="card-header">Thêm học phần mới</div>
            <div class="card-body">
              <form action="#" method="POST">
                <?php if (isset($thatbai)) {
                  echo "<span style='color:red'>".($thatbai)."</span>";
                }
                ?>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="txt_maHocphan" id="inputmaHocphan" class="form-control" placeholder="Mã học phần" required="required">
                    <label for="inputmaHocphan">Mã học phần</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="txt_tenHocphan" id="inputtenHocphan" class="form-control" placeholder="Tên học phần" required="required">
                    <label for="inputtenHocphan">Tên học phần</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" name="txt_stc" id="inputSotinchi" class="form-control" placeholder="Số tín chỉ" min="1" max="5" required="required">
                    <label for="inputSotinchi">Số tín chỉ</label>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="sel1">Mã học kỳ:</label>
                  <select class="form-control" id="sel1" name="sellist1">
                    <?php foreach ($listhocky as $value) { ?>
                    <option value="<?php echo $value['ma_hk']; ?>"><?php echo $value['ten_hk']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="sellist_lop">Chọn Lớp học:</label>
                  <select class="form-control" id="sellist_lop" name="sellist_lop" required="required">
                    <option value="">-- Chọn lớp học --</option>
                    <?php foreach ($list_lop as $lop) { ?>
                      <option value="<?php echo $lop['ma_lop']; ?>"><?php echo $lop['ten_lop']; ?></option>
                    <?php } ?>
                  </select>
                  <small class="form-text text-muted">Môn học sẽ chỉ hiển thị cho sinh viên thuộc lớp này.</small>
                </div>

                <input type="submit" name="themHocphan" class="btn btn-primary btn-block" value="Thêm môn Học">
              </form>
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