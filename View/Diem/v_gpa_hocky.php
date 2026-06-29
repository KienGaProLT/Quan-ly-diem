<div class="container-fluid">
    <h3>Bảng điểm GPA theo từng học kỳ: <?php echo $sv_info[0]['hoten_sv']; ?></h3>
    <hr>

    <?php if (!empty($hk_gpa)): ?>
        <?php foreach ($hk_gpa as $maHK => $info): 
            // Tính GPA của kỳ hiện tại
            $gpa_hk = round($info['tong_diem_he_10'] / $info['tong_tin_chi'], 2);
        ?>
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <strong><?php echo $info['ten_hk']; ?></strong> | 
                GPA Học kỳ: <span class="badge badge-success"><?php echo $gpa_hk; ?></span>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Môn học</th>
                            <th>Số tín chỉ</th>
                            <th>Điểm HP (10)</th>
                            <th>Hệ số</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($info['chi_tiet_mon'] as $mon): ?>
                        <tr>
                            <td><?php echo $mon['ten_mon']; ?></td>
                            <td><?php echo $mon['sotinchi']; ?></td>
                            <td><?php echo round(($mon['diem_giua_ky']*0.3)+($mon['diem_thi_hp']*0.7), 1); ?></td>
                            <td><?php echo $mon['sotinchi']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-right"><em>Tổng tín chỉ đăng ký kỳ này: <?php echo $info['tong_tin_chi']; ?></em></p>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">Sinh viên này chưa có dữ liệu điểm.</p>
    <?php endif; ?>
</div>