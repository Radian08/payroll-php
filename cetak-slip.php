<?php
    include 'config/db.php';
    $ref_month = [
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember"
    ];

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $payroll = mysqli_fetch_object(mysqli_query($conn, "select p.*, u.name, p2.name position_name from payrolls p left join users u on p.userid = u.id left join positions p2 on u.position_id = p2.id where p.id = $id"));

        if(!$payroll){
            echo mysqli_error($conn);
            return false;
        }

        // print_r($payroll);

        $list_tunjangan = mysqli_fetch_all(mysqli_query($conn, "select * from payroll_details where payroll_id = $id and payroll_type = 'allowance'"), MYSQLI_ASSOC);

        $list_potongan = mysqli_fetch_all(mysqli_query($conn, "select * from payroll_details where payroll_id = $id and payroll_type = 'deduction'"), MYSQLI_ASSOC);

        // print_r($list_potongan);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <script>
        window.print()
    </script>
</head>
<body>
    <h1>Slip Gaji Bulan <?= $ref_month[$payroll->payroll_month] . ' ' . $payroll->payroll_year ?></h1>

    <table style="margin-bottom:20px">
        <tr>
            <td width="200">Nama</td>
            <td>:</td>
            <td><?= $payroll->name ?></td>
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
            <td align="right">Rp<?= number_format($payroll->base_salary, 0, ",", ".") ?></td>
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
                <td align="right">Rp<?= number_format($v['amount'], 0, ",", ".") ?></td>
            </tr>
        <?php endforeach ?>
        <tr style="font-weight:bold">
            <td width="200">Total</td>
            <td>:</td>
            <td align="right">Rp<?= number_format($payroll->total_deduction, 0, ",", ".") ?></td>
        </tr>
    </table>

    <strong>THP</strong>
    <table>
        <tr style="font-weight:bold">
            <td width="200">Total Gaji Bersih</td>
            <td>:</td>
            <td align="right">Rp<?= number_format($payroll->net_salary, 0, ",", ".") ?></td>
        </tr>
    </table>
</body>
</html>