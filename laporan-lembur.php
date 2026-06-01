<?php
    include 'layouts/header.php';
?>
<div class="box">
    <div class="box-header">
        <b>Laporan Lembur</b>
    </div>

    <div class="box-content">
    <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Jabatan</td>
                    <td>Tanggal Lembur</td>
                    <td>Jam Mulai</td>
                    <td>Jam Selesai</td>
                    <td>Total Jam</td>
                    <td>Alasan</td>
                    <td>Status</td>
                    <td>Tarif per jam</td>
                    <td>Total Upah</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query_get_data = "select a.*, u.name, p.name position_name, p.overtime_rate from overtime_requests a left join users u on a.userid = u.id left join positions p on u.position_id = p.id";
                    $run_query_get_data = mysqli_query($conn, $query_get_data);
                    $no = 1;
                    while($row = mysqli_fetch_array($run_query_get_data)):
                        $tarif_per_jam = $row['overtime_rate'];
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['position_name'] ?></td>
                    <td><?= $row['overtime_date'] ?></td>
                    <td><?= $row['start_time'] ?></td>
                    <td><?= $row['end_time'] ?></td>
                    <td><?= $row['total_time'] ?></td>
                    <td><?= $row['reason'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td align="right">Rp<?= number_format($tarif_per_jam, 0, ",", ".") ?></td>
                    <td align="right">Rp<?= $row['status'] == 'approved' ? number_format($tarif_per_jam * $row['total_time'], 0, ",", ".") : 0 ?></td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>