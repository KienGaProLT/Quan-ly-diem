<?php 
// 1. Lấy thông tin session
if (isset($_SESSION['username'])) {
  $username_session = $_SESSION['username'];
} else {
  $username_session = "";
}
?>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php?controllers=quanly&action=Admin">Quản lý Điểm</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>

    <form action="index.php" method="GET" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        
        <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1): ?>
            <input type="hidden" name="controllers" value="quanly">
            <input type="hidden" name="action" value="Seach">
        <?php else: ?>
            <input type="hidden" name="controllers" value="diem">
            <input type="hidden" name="action" value="List_Diem">
            <input type="hidden" name="maSV" value="<?php echo isset($_SESSION['ma_sv']) ? $_SESSION['ma_sv'] : ''; ?>">
        <?php endif; ?>

        <div class="input-group">
            <input type="text" class="form-control" name="gtTimkiem" placeholder="Tìm kiếm..." value="<?php echo isset($_GET['gtTimkiem']) ? htmlspecialchars($_GET['gtTimkiem']) : ''; ?>">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Tìm kiếm</button>  
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
          <span style="color:white; font-size: 14px; margin-left: 5px;"><?php echo $username_session; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="index.php?controllers=login&action=cai_dat&username=<?php echo $username_session; ?>">Cài đặt</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?controllers=login&action=logout">Đăng xuất</a>
        </div>
      </li>
    </ul>

</nav>