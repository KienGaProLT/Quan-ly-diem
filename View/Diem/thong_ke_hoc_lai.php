<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Thống kê học lại & Xuất Excel</title>
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
          <li class="breadcrumb-item"><a href="index.php?controllers=quanly&action=Admin">Bảng điều khiển</a></li>
          <li class="breadcrumb-item active">Thống kê học lại</li>
        </ol>

        <div class="card mb-3">
          <div class="card-header"><i class="fas fa-filter"></i> Bộ lọc danh sách thi lại</div>
          <div class="card-body">
            <form action="index.php" method="GET">
              <input type="hidden" name="controllers" value="diem">
              <input type="hidden" name="action" value="Thong_ke_hoc_lai">
              
              <div class="row">
                <div class="col-md-3">
                  <label><b>1. Học kỳ:</b></label>
                  <select name="maHK" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Chọn học kỳ --</option>
                    <?php foreach ($list_hk as $hk) { ?>
                      <option value="<?php echo $hk['ma_hk']; ?>" <?php echo (isset($maHK) && $maHK == $hk['ma_hk']) ? 'selected' : ''; ?>><?php echo $hk['ten_hk']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label><b>2. Lớp học:</b></label>
                  <select name="maLop" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Chọn lớp --</option>
                    <?php foreach ($list_lop as $l) { ?>
                      <option value="<?php echo $l['ma_lop']; ?>" <?php echo (isset($maLop) && $maLop == $l['ma_lop']) ? 'selected' : ''; ?>><?php echo $l['ten_lop']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label><b>3. Môn học:</b></label>
                  <select name="maMon" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Chọn môn --</option>
                    <?php if(!empty($list_mon)) { foreach ($list_mon as $m) { ?>
                      <option value="<?php echo $m['ma_mon']; ?>" <?php echo (isset($maMon) && $maMon == $m['ma_mon']) ? 'selected' : ''; ?>><?php echo $m['ten_mon']; ?></option>
                    <?php } } ?>
                  </select>
                </div>

                <div class="col-md-3 text-right">
                  <label>&nbsp;</label>
                  <div class="btn-group w-100">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Lọc</button>
                    <?php if (isset($maMon) && $maMon != ""): ?>
                      <a href="index.php?controllers=diem&action=Export_Excel_Hoc_Lai&maMon=<?php echo $maMon; ?>" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Xuất Excel
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <?php if (isset($maMon) && $maMon != ""): ?>
        <div class="card mb-3 border-danger">
          <div class="card-header bg-danger text-white">
            <i class="fas fa-exclamation-triangle"></i> <strong>Danh sách học lại môn: <?php echo $maMon; ?></strong>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light text-center">
                  <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Điểm Thi</th>
                    <th>TBHP</th>
                    <th>Lý do</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($list_hoc_lai)) { 
                      $stt = 1; 
                      foreach ($list_hoc_lai as $sv) { 
                        $tb = ($sv['diem_giua_ky'] * 0.3) + ($sv['diem_thi_hp'] * 0.7);
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $stt++; ?></td>
                      <td class="text-center"><?php echo $sv['ma_sv']; ?></td>
                      <td><?php echo $sv['hoten_sv']; ?></td>
                      <td class="text-center text-danger font-weight-bold"><?php echo $sv['diem_thi_hp']; ?></td>
                      <td class="text-center text-danger font-weight-bold"><?php echo round($tb, 1); ?></td>
                      <td class="text-center"><span class="badge badge-danger">Học lại</span></td>
                    </tr>
                  <?php } } else { ?>
                    <tr><td colspan="6" class="text-center">Không có sinh viên nào phải học lại môn này.</td></tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php else: ?>
        <div class="alert alert-warning text-center">Vui lòng chọn đủ <b>Học kỳ</b>, <b>Lớp</b> và <b>Môn học</b> để xem danh sách.</div>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="bootstraps/js/sb-admin.min.js"></script>
</body>
</html>