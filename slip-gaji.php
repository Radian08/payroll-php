<?php
    include 'layouts/header.php';

    $filter_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
    $filter_tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
?>
<div class="box">
    <div class="box-header">
        <b>Slip Gaji</b>
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
            <button type="submit" name="preview">Preview</button>
        </form>

        <?php if(isset($_GET['preview']) && $_GET['bulan'] != '' && $_GET['tahun'] != ''): ?>

            <?php

                $payroll = mysqli_fetch_object(mysqli_query($conn, "select p.*, u.name, p2.name position_name from payrolls p left join users u on p.userid = u.id left join positions p2 on u.position_id = p2.id where p.userid = $userid and p.payroll_month = '$filter_bulan' and p.payroll_year = '$filter_tahun' "));
        
                if(!$payroll){
                    echo mysqli_error($conn);
                    return false;
                }
        
                // print_r($payroll);
        
                $list_tunjangan = mysqli_fetch_all(mysqli_query($conn, "select * from payroll_details where payroll_id = $payroll->id and payroll_type = 'allowance'"), MYSQLI_ASSOC);
        
                $list_potongan = mysqli_fetch_all(mysqli_query($conn, "select * from payroll_details where payroll_id = $payroll->id and payroll_type = 'deduction'"), MYSQLI_ASSOC);
        
                // print_r($list_tunjangan);
                // echo '<hr />';
                // print_r($list_potongan);
            ?>
        
                <div id="content-to-print">

                    <h1>Slip Gaji Bulan <?= $ref_month[$payroll->payroll_month] . ' ' . $payroll->payroll_year ?></h1>

                    <table style="margin-bottom:20px">
                        <tr>
                            <td width="200">Nama</td>
                            <td>:</td>
                            <td width="180"><?= $payroll->name ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td><?= $payroll->position_name ?></td>
                        </tr>
                    </table>

                    <strong>Tunjangan</strong>
                    <table style="margin-bottom:20px">
                        <tr>
                            <td width="200">Gaji Pokok</td>
                            <td>:</td>
                            <td  width="180" align="right">Rp<?= number_format($payroll->base_salary, 0, ",", ".") ?></td>
                        </tr>
                        <tr>
                            <td>Total Lembur</td>
                            <td>:</td>
                            <td align="right">Rp<?= number_format($payroll->total_overtime, 0, ",", ".") ?></td>
                        </tr>
                        <?php foreach($list_tunjangan as $v): ?>
                            <tr>
                                <td><?= $v['name'] ?></td>
                                <td>:</td>
                                <td align="right">Rp<?= number_format($v['amount'], 0, ",", ".") ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr style="font-weight:bold">
                            <td>Total</td>
                            <td>:</td>
                            <td align="right">Rp<?= number_format($payroll->base_salary + $payroll->total_overtime + $payroll->total_allowance, 0, ",", ".") ?></td>
                        </tr>
                    </table>

                    <strong>Potongan</strong>
                    <table style="margin-bottom:20px">
                        <?php foreach($list_potongan as $v): ?>
                            <tr>
                                <td width="200"><?= $v['name'] ?></td>
                                <td>:</td>
                                <td  width="180" align="right">Rp<?= number_format($v['amount'], 0, ",", ".") ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr style="font-weight:bold">
                            <td width="200">Total</td>
                            <td>:</td>
                            <td  width="180" align="right">Rp<?= number_format($payroll->total_deduction, 0, ",", ".") ?></td>
                        </tr>
                    </table>

                    <strong>THP</strong>
                    <table>
                        <tr style="font-weight:bold">
                            <td width="200">Total Gaji Bersih</td>
                            <td>:</td>
                            <td  width="180" align="right">Rp<?= number_format($payroll->net_salary, 0, ",", ".") ?></td>
                        </tr>
                    </table>

                </div>


                <button type="button" onclick="cetakSlip()" style="margin-top:25px;">Print</button>
        <?php endif ?>
    </div>
</div>  
<script>
    function cetakSlip(){
        window.print()
    }
</script>
<?php include 'layouts/footer.php' ?>