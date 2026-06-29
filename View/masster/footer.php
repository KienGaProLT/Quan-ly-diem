<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1): ?>
            <a class="nav-link" href="index.php?controllers=quanly&action=Admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Bảng điều khiển Admin</span>
            </a>
        <?php else: ?>
            <a class="nav-link" href="index.php?controllers=diem&action=Dashboard_SV">
                <i class="fas fa-fw fa-home"></i>
                <span>Trang chủ</span>
            </a>
        <?php endif; ?>
    </li>

    <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1): ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Chức năng:</h6>
            <a class="dropdown-item" href="index.php?controllers=quanly&action=Add">Thêm sinh viên</a>
            <a class="dropdown-item" href="index.php?controllers=diem&action=QL_Diem">Quản lý điểm</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Bảng:</h6>
            <a class="dropdown-item" href="index.php?controllers=quanly&action=List_lop">Lớp</a>
            <a class="dropdown-item" href="index.php?controllers=quanly&action=list_hocky">Học kỳ</a>
            <a class="dropdown-item" href="index.php?controllers=quanly&action=list_hocphan">Học phần</a>
        </div>
    </li>
    <?php endif; ?>

    <li class="nav-item">
        <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1): ?>
            <a class="nav-link" href="index.php?controllers=diem&action=Tonghopdiem">
                <i class="fas fa-fw fa-list-ul"></i>
                <span>Tổng hợp Điểm chi tiết</span>
            </a>
        <?php else: ?>
            <a class="nav-link" href="index.php?controllers=diem&action=List_Diem&maSV=<?php echo $_SESSION['ma_sv']; ?>">
                <i class="fas fa-fw fa-list-ol"></i>
                <span>Xem điểm học phần</span>
            </a>
        <?php endif; ?>
    </li>

    <li class="nav-item">
        <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1): ?>
            <a class="nav-link" href="index.php?controllers=diem&action=Thong_ke">
                <i class="fas fa-fw fa-table"></i>
                <span>Thống kê hệ thống</span>
            </a>
        <?php else: ?>
            <a class="nav-link" href="index.php?controllers=diem&action=Thong_ke_ca_nhan">
                <i class="fas fa-fw fa-chart-pie"></i>
                <span>Thống kê kết quả</span>
            </a>
        <?php endif; ?>
    </li>

    <li class="nav-item">
        <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1): ?>
            <a class="nav-link" href="index.php?controllers=diem&action=Thong_ke_hoc_lai">
                <i class="fas fa-fw fa-user-times"></i>
                <span>Danh sách học lại</span>
            </a>
        <?php else: ?>
            <a class="nav-link" href="index.php?controllers=diem&action=List_Thi_Lai_SV">
                <i class="fas fa-fw fa-exclamation-triangle text-warning"></i>
                <span>Môn cần học lại</span>
            </a>
        <?php endif; ?>
    </li>
</ul>