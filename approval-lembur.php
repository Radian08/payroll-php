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

        $query_update = "update overtime_requests set status = '$status' where id = '$id'";
        $run_query_update = mysqli_query($conn, $query_update);

        if($run_query_update){
            echo "<script>
                    alert('Approval lembur berhasil');
                    window.location.href='approval-lembur.php'
                </script>";
        } else {
            echo "<script>
                    alert('Approval lembur gagal');
                    window.location.href='approval-lembur.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Approval Lembur</b>
    </div>

    <div class="box-content">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Tanggal Lembur</td>
                    <td>Jam Mulai</td>
                    <td>Jam Selesai</td>
                    <td>Total Jam</td>
                    <td>Alasan</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select a.*, u.name from overtime_requests a left join users u on a.userid = u.id where status = 'pending'";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['overtime_date'] ?></td>
                    <td><?= $row['start_time'] ?></td>
                    <td><?= $row['end_time'] ?></td>
                    <td><?= $row['total_time'] ?></td>
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