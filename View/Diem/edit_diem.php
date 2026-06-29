<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sửa Điểm học phần</title>

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
          <li class="breadcrumb-item active">Sửa điểm</li>
        </ol>

        <div class="container">
          <div class="card card-login mx-auto mt-5">
            <div class="card-header">Sửa điểm học phần</div>
            <div class="card-body">
              <form id="formSuaDiem">
                <?php 
                foreach ($list_diem_lop_sinhvien as $value) { 
                ?>
                <div class="form-group">
                  <label for="sel1">Họ và tên</label>
                  <input type="text" class="form-control" value="<?php echo $value['hoten_sv']; ?>" disabled>
                  <input type="hidden" id="ma_sv" value="<?php echo $value['ma_sv']; ?>">
                  
                  <br>
                  <label for="sel2">Tên học phần</label>
                  <input type="text" class="form-control" value="<?php echo $value['ten_mon']; ?>" disabled>
                  <input type="hidden" id="ma_mon" value="<?php echo $value['ma_mon']; ?>">
                </div>

                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" step="0.1" id="inputdiemGK" class="form-control" value="<?php echo $value['diem_giua_ky']; ?>" placeholder="Điểm giữa kỳ" required="required">
                    <label for="inputdiemGK">Điểm giữa kỳ</label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" step="0.1" id="inputdiemTHK" class="form-control" value="<?php echo $value['diem_thi_hp']; ?>" placeholder="Điểm thi học kỳ" required="required">
                    <label for="inputdiemTHK">Điểm thi học kỳ</label>
                  </div>
                </div>
                <?php } ?>

                <button type="submit" class="btn btn-primary btn-block">Cập nhật </button>
              </form>
              <div id="msg" class="mt-3 text-center"></div>
            </div>
</div>
        </div>
      </div>
    </div>
  </div>

  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById('formSuaDiem').addEventListener('submit', function(e) {
      e.preventDefault(); // Chặn load lại trang

      // 1. Lấy dữ liệu từ Form
      const data = {
        ma_sv: document.getElementById('ma_sv').value,
        ma_mon: document.getElementById('ma_mon').value,
        diem_giua_ky: parseFloat(document.getElementById('inputdiemGK').value),
        diem_thi_hp: parseFloat(document.getElementById('inputdiemTHK').value)
      };

      const msgDiv = document.getElementById('msg');
      msgDiv.innerHTML = "Đang xử lý...";

    fetch('api/put_diem.php', {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
})
.then(response => response.json())
.then(res => {
    if (res.status === 'success') {
        alert("Cập nhật thành công!");

        // 1. Lấy tham số từ URL hiện tại của trang Sửa (Dùng để quay lại trang cũ)
        const urlParams = new URLSearchParams(window.location.search);
        const maHK = urlParams.get('maHK');
        const maLop = urlParams.get('maLop');
        const maMon = urlParams.get('maMon');

        var redirectUrl = "index.php?controllers=diem&action=QL_Diem" 
                        + "&maHK=" + maHK 
                        + "&maLop=" + maLop 
                        + "&maMon=" + maMon 
                        + "&btnHienThi=";

        window.location.href = redirectUrl;
    } else {
        alert("Lỗi: " + res.message);
    }
})
.catch(error => {
    console.error('Lỗi:', error);
    alert("Không thể kết nối API!");
});
    });
  </script>
</body>
</html>