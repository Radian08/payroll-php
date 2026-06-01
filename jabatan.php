<?php
    include 'layouts/header.php';

    if(isset($_GET['hapus-jabatan'])){
        $id = $_GET['hapus-jabatan'];

        //sql transaksi
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //start transaction
        mysqli_begin_transaction($conn);
        try {
            //proses hapus jabatan
            $query_delete1 = "delete from positions where id = '$id'";
            $run_query_delete1 = mysqli_query($conn, $query_delete1);

            //proses hapus tunjangan
            $query_delete2 = "delete from position_allowances where position_id = '$id'";
            $run_query_delete2 = mysqli_query($conn, $query_delete2);

            //commit
            mysqli_commit($conn);
            echo "<script>
                alert('Hapus berhasil');
                window.location.href='jabatan.php'
            </script>";
        } catch (\Throwable $th) {
            //rollback
            mysqli_rollback($conn);
            echo "Error : " . $th->getMessage();
            echo "<script>
                    alert('Hapus gagal');
                    window.location.href='jabatan.php'
                </script>";
        }

    }
?>
<div class="box">
    <div class="box-header">
        <b>Data Jabatan</b>
    </div>

    <div class="box-content">
        <a href="tambah-jabatan.php">Tambah Data</a>
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Gaji Pokok</td>
                    <td>Tarif Lembur</td>
                    <td>Tunjangan</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select * from positions order by id desc";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td align="right">Rp<?= number_format($row['base_salary'], 0, ",", ".") ?></td>
                    <td align="right">Rp<?= number_format($row['overtime_rate'], 0, ",", ".") ?></td>
                    <td>
                        <?php
                            $tunjangan = mysqli_fetch_all(mysqli_query($conn, "select * from position_allowances where position_id = '$row[id]'"), MYSQLI_ASSOC);

                            foreach($tunjangan as $v):
                                $nilai = $v['allowance_type'] == 'percentage' ? $row['base_salary'] * ($v['amount']/100) : $v['amount'];
                        ?>
                        <ul style="padding:0;list-style:none;">
                            <li><?= $v['name'] ?> : Rp<?= number_format($nilai, 0, ",", ".") ?></li>
                        </ul>
                        <?php endforeach ?>
                    </td>
                    <td>
                        <a href="edit-jabatan.php?id=<?= $row['id'] ?>">Edit</a> | <a href="?hapus-jabatan=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus ?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</div>  
<?php include 'layouts/footer.php' ?>