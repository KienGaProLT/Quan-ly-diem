<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Quản lý điểm học phần</title>
  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
  <?php require_once 'View/masster/header.php'; ?>

  <div id="wrapper">
    <?php require_once 'View/masster/footer.php'; ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        
        <div class="card mb-3">
          <div class="card-header"><i class="fas fa-filter"></i> Bộ lọc danh sách (Học kỳ > Lớp > Môn)</div>
          <div class="card-body">
            <form action="index.php" method="GET">
              <input type="hidden" name="controllers" value="diem">
              <input type="hidden" name="action" value="QL_Diem">

              <div class="row">
                <div class="col-md-3">
                  <label><b>1. Học kỳ:</b></label>
                  <select name="maHK" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Chọn học kỳ --</option>
                    <?php foreach ($list_hk as $hk) { ?>
                      <option value="<?php echo $hk['ma_hk']; ?>" <?php echo (isset($_REQUEST['maHK']) && $_REQUEST['maHK'] == $hk['ma_hk']) ? 'selected' : ''; ?>>
                        <?php echo $hk['ten_hk']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label><b>2. Lớp học:</b></label>
                  <select name="maLop" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Chọn lớp học --</option>
                    <?php foreach ($list_lop as $l) { ?>
                      <option value="<?php echo $l['ma_lop']; ?>" <?php echo (isset($_REQUEST['maLop']) && $_REQUEST['maLop'] == $l['ma_lop']) ? 'selected' : ''; ?>>
                        <?php echo $l['ten_lop']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label><b>3. Môn học:</b></label>
                  <select name="maMon" class="form-control">
                    <option value="">-- Chọn môn học --</option>
                    <?php if(!empty($list_mon)) { foreach ($list_mon as $m) { ?>
                      <option value="<?php echo $m['ma_mon']; ?>" <?php echo (isset($_REQUEST['maMon']) && $_REQUEST['maMon'] == $m['ma_mon']) ? 'selected' : ''; ?>>
                        <?php echo $m['ten_mon']; ?>
                      </option>
                    <?php } } ?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>&nbsp;</label>
<button type="submit" name="btnHienThi" class="btn btn-primary btn-block">
                    <i class="fas fa-search"></i> Hiện danh sách
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <?php 
          $current_maHK = isset($_REQUEST['maHK']) ? $_REQUEST['maHK'] : '';
          $current_maLop = isset($_REQUEST['maLop']) ? $_REQUEST['maLop'] : '';
          $current_maMon = isset($_REQUEST['maMon']) ? $_REQUEST['maMon'] : '';
        ?>

        <?php if (!empty($current_maMon)): ?>
            <div class="card mb-3 border-warning">
              <div class="card-header bg-warning"><strong>1. Danh sách SV chờ nhập điểm</strong></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr><th>STT</th><th>Mã SV</th><th>Họ tên</th><th>Hành động</th></tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($list_sv_chua_diem)) { $stt = 1; foreach ($list_sv_chua_diem as $sv) { ?>
                        <tr>
                          <td><?php echo $stt++; ?></td>
                          <td><?php echo $sv['ma_sv']; ?></td>
                          <td><?php echo $sv['hoten_sv']; ?></td>
                          <td>
                            <a href="index.php?controllers=diem&action=Add_Diem_HP&maSV=<?php echo $sv['ma_sv']; ?>&maMon=<?php echo $current_maMon; ?>&maLop=<?php echo $current_maLop; ?>&maHK=<?php echo $current_maHK; ?>" class="btn btn-sm btn-info">
                              Nhập điểm ngay
                            </a>
                          </td>
                        </tr>
                      <?php } } else { echo "<tr><td colspan='4' class='text-center'>Không có sinh viên nào cần nhập điểm</td></tr>"; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="card mb-3 border-success">
              <div class="card-header bg-success text-white"><strong>2. Danh sách SV đã hoàn thành điểm </strong></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr><th>STT</th><th>Mã SV</th><th>Họ tên</th><th>Giữa kỳ</th><th>Thi HP</th><th>TBHP</th><th>Hành động</th></tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($list_sv_da_diem)) { $stt = 1; foreach ($list_sv_da_diem as $sv) { 
                          $tb = ($sv['diem_giua_ky']*0.3) + ($sv['diem_thi_hp']*0.7); ?>
                        <tr>
<td><?php echo $stt++; ?></td>
                          <td><?php echo $sv['ma_sv']; ?></td>
                          <td><?php echo $sv['hoten_sv']; ?></td>
                          <td class="text-center"><?php echo $sv['diem_giua_ky']; ?></td>
                          <td class="text-center"><?php echo $sv['diem_thi_hp']; ?></td>
                          <td class="text-center font-weight-bold"><?php echo round($tb, 1); ?></td>
                          <td>
                            <a href="index.php?controllers=diem&action=Edit_Diem_HP&maSV=<?php echo $sv['ma_sv']; ?>&maMon=<?php echo $sv['ma_mon']; ?>&maLop=<?php echo $current_maLop; ?>&maHK=<?php echo $current_maHK; ?>" class="btn btn-sm btn-warning">
                              <i class="fas fa-edit"></i> Sửa
                            </a>
                            
                            <button onclick="xoaDiem('<?php echo $sv['ma_sv']; ?>', '<?php echo $sv['ma_mon']; ?>')" class="btn btn-sm btn-danger">
                              <i class="fas fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                      <?php } } else { echo "<tr><td colspan='7' class='text-center'>Chưa có dữ liệu sinh viên đã nhập điểm</td></tr>"; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
              <i class="fas fa-info-circle"></i> Vui lòng chọn <b>Học kỳ</b>, <b>Lớp</b> và <b>Môn học</b> để quản lý điểm.
            </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function xoaDiem(maSV, maMon) {
      if (confirm('Bạn có chắc chắn muốn xóa điểm của sinh viên này không?')) {
        // Gọi đến file API delete_diem.php bạn đã tạo
        fetch('api/delete_diem.php', {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            ma_sv: maSV,
            ma_mon: maMon
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            alert("Xóa thành công!");
            // Load lại trang để cập nhật danh sách tại chỗ
            location.reload(); 
          } else {
            alert("Lỗi: " + data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert("Không thể kết nối đến máy chủ xóa!");
        });
      }
    }
  </script>
</body>
</html>