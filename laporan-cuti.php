<?php
    include 'layouts/header.php';
?>
<div class="box">
    <div class="box-header">
        <b>Laporan Cuti</b>
    </div>

    <div class="box-content">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Tanggal Pengajuan</td>
                    <td>Jenis Cuti</td>
                    <td>Tanggal Mulai</td>
                    <td>Tanggal Selesai</td>
                    <td>Total Hari</td>
                    <td>Alasan</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select lr.*, u.name from leave_requests lr left join users u on lr.userid = u.id";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                    <td><?= $row['leave_type'] ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td><?= $row['total_days'] ?></td>
                    <td><?= $row['reason'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>