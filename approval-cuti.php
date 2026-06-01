<?php
    include 'layouts/header.php';

    if(isset($_GET['confirm'])){
        $confirm = $_GET['confirm'];
        $id      = $_GET['id'];

        if($confirm == 'approve'){
            $status = 'approved';
        } elseif($confirm == 'reject'){
            $status = 'rejected';
        }

        $query_update = "update leave_requests set status = '$status' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Approval cuti berhasil');
                    window.location.href='approval-cuti.php'
                </script>";
        } else {
            echo "<script>
                    alert('Approval cuti gagal');
                    window.location.href='approval-cuti.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Approval Cuti</b>
    </div>

    <div class="box-content">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
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
                    $query_get_data = "select lr.*, u.name from leave_requests lr left join users u on lr.userid = u.id where status = 'pending'";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['leave_type'] ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td><?= $row['total_days'] ?></td>
                    <td><?= $row['reason'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a href="?confirm=approve&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin approve ?')">Approve</a> || <a href="?confirm=reject&id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin reject ?')">Reject</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>