<?php
    include 'layouts/header.php';

    if(isset($_GET['cancel'])){
        $id = $_GET['cancel'];

        $query_update = "update leave_requests set status = 'cancelled' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Pengajuan cuti berhasil dibatalkan');
                    window.location.href='riwayat-cuti.php'
                </script>";
        } else {
            // echo mysqli_error($conn);
            echo "<script>
                    alert('Pengajuan cuti gagal dibatalkan');
                </script>";
        }
    }

?>
<div class="box">
    <div class="box-header">
        <b>Riwayat Cuti</b>
    </div>

    <div class="box-content">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal Pengajuan</td>
                    <td>Jenis Cuti</td>
                    <td>Tanggal Mulai</td>
                    <td>Tanggal Selesai</td>
                    <td>Total Hari</td>
                    <td>Alasan</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select * from leave_requests where userid = '$userid'";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                    <td><?= $row['leave_type'] ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td><?= $row['total_days'] ?></td>
                    <td><?= $row['reason'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <?php if($row['status'] == 'pending'): ?>
                        <a href="edit-cuti.php?id=<?= $row['id'] ?>">Edit</a> || <a href="?cancel=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin batalkan ?')">Batalkan</a>
                        <?php else: ?>
                            -
                        <?php endif ?>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>