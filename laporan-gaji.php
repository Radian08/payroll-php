<?php
    include 'layouts/header.php';

    $filter_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
    $filter_tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
?>
<div class="box">
    <div class="box-header">
        <b>Laporan Gaji</b>
    </div>

    <div class="box-content">
        <form action="" style="margin-bottom:10px;">
            <select name="bulan" required>
                <option value="">Pilih Bulan</option>
                <?php foreach($ref_month as $i => $v): ?>
                    <option value="<?= $i ?>" <?= $filter_bulan == $i ? 'selected': '' ?>><?= $v ?></option>
                <?php endforeach ?>
            </select>
            <select name="tahun" required>
                <option value="">Pilih Tahun</option>
                <?php for($tahun=date('Y') - 1; $tahun <= date('Y'); $tahun++): ?>
                    <option value="<?= $tahun ?>" <?= $filter_tahun == $tahun ? 'selected': '' ?>><?= $tahun ?></option>
                <?php endfor ?>
            </select>
            <button type="submit" name="filter">Filter</button>
        </form>

        <?php if(isset($_GET['filter']) && $_GET['bulan'] != '' && $_GET['tahun'] != ''): ?>
        <div class="box-table">
            <table>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Tanggal Generate</td>
                        <td>Periode</td>
                        <td>Karyawan</td>
                        <td>Jabatan</td>
                        <td>Gaji Pokok</td>
                        <td>Total Lembur</td>
                        <td>Total Tunjangan</td>
                        <td>Total Potongan</td>
                        <td>Total Gaji</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $payrolls = mysqli_query($conn, "select p.*, u.name, p2.name position_name from payrolls p left join users u on p.userid = u.id left join positions p2 on u.position_id = p2.id where payroll_month = '$filter_bulan' and payroll_year = '$filter_tahun'");
                        $no=1;
                        $total=0;
                        while($v = mysqli_fetch_array($payrolls)):
                            $total += $v['net_salary'];
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('Y-m-d', strtotime($v['generated_at'])) ?></td>
                        <td><?= $ref_month[$filter_bulan] . ' ' . $filter_tahun ?></td>
                        <td><?= $v['name'] ?></td>
                        <td><?= $v['position_name'] ?></td>
                        <td align="right">Rp<?= number_format($v['base_salary'],0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($v['total_overtime'],0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($v['total_allowance'],0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($v['total_deduction'],0, ",", ".") ?></td>
                        <td align="right">Rp<?= number_format($v['net_salary'],0, ",", ".") ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">Total</td>
                        <td align="right">Rp<?= number_format($total, 0, ",", ".") ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endif ?>
    </div>
</div>  
<?php include 'layouts/footer.php' ?>