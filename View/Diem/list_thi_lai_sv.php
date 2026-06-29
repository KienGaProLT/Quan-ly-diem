<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Danh sách môn cần thi lại</title>
  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
  <?php require_once 'View/masster/header.php'; ?>
  <div id="wrapper">
    <?php require_once 'View/masster/footer.php'; ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <h3 class="text-danger"><i class="fas fa-exclamation-triangle"></i> Danh sách môn học chưa đạt</h3>
        <p class="text-muted">Dưới đây là các môn học có điểm thi HP < 2 hoặc điểm TBHP < 4.</p>
        
        <div class="card mb-3 border-danger">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th>STT</th>
                    <th>Tên môn học</th>
                    <th>Số tín chỉ</th>
                    <th>Học kỳ</th>
                    <th>Điểm thi</th>
                    <th>TBHP</th>
                    <th>Ghi chú</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($list_thi_lai)) { 
                      $stt = 1; 
                      foreach ($list_thi_lai as $mon) { 
                        $tb = round(($mon['diem_giua_ky'] * 0.3) + ($mon['diem_thi_hp'] * 0.7), 1);
                  ?>
                    <tr>
                      <td><?php echo $stt++; ?></td>
                      <td class="font-weight-bold"><?php echo $mon['ten_mon']; ?></td>
                      <td><?php echo $mon['sotinchi']; ?></td>
                      <td><?php echo $mon['ten_hk']; ?></td>
                      <td class="text-danger font-weight-bold"><?php echo $mon['diem_thi_hp']; ?></td>
                      <td class="text-danger font-weight-bold"><?php echo $tb; ?></td>
                      <td>
                         <span class="badge badge-danger">
                            Phải học lại
                         </span>
                      </td>
                    </tr>
                  <?php } } else { ?>
                    <tr><td colspan="7" class="text-center">Tuyệt vời! Bạn không có môn nào phải thi lại.</td></tr>
                  <?php } ?>
                </tbody>
              </table>
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