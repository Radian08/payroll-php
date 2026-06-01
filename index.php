<?php
    include 'layouts/header.php';

    $current_date = date('Y-m-d');
    $current_time = date('H:i');

    // get data absensi user hari ini
    $query_get_absen = "select * from attendances where userid = '$userid' and attendance_date = '$current_date'";
    $run_query_get_absen = mysqli_query($conn, $query_get_absen);
    $result = mysqli_fetch_object($run_query_get_absen);

    $check_in = "--:--";
    $check_out = "--:--";

    if($result){
        $check_in = date("H:i", strtotime($result->check_in));

        if($result->check_out != null){
            $check_out = date("H:i", strtotime($result->check_out));
        }
    }


    if(isset($_GET['absen'])){
        $absen = $_GET['absen'];

        if($absen == 'masuk'){
            // gunakan query absen masuk
            if($result){
                echo "<script>
                        alert('Anda sudah melakukan absen masuk');
                        window.location.href='index.php'
                    </script>";
                exit;
            } else {
                $query_absen = "insert into attendances (userid, check_in, notes, attendance_date) values ('$userid', '$current_time', 'Absen Masuk', '$current_date')";
            }

            $run_query_absen = mysqli_query($conn, $query_absen);

            if($run_query_absen){
                echo "<script>
                        alert('Absen masuk berhasil');
                        window.location.href='index.php'
                    </script>";
                exit;
            } else {
                echo "<script>
                        alert('Absen masuk gagal');
                        window.location.href='index.php'
                    </script>";
                exit;
            }


        } else if($absen == 'pulang') {
            // gunakan query absen pulang
            if(!$result){
                echo "<script>
                        alert('Anda belum melakukan absen masuk');
                        window.location.href='index.php'
                    </script>";
                    exit;
            } else {

                if($result->check_out != null){
                    echo "<script>
                        alert('Anda sudah melakukan absen pulang');
                        window.location.href='index.php'
                    </script>";
                    exit;
                } else {
                    $query_absen = "update attendances set check_out = '$current_time', notes = 'Hadir dengan absen online' where userid = '$userid' and attendance_date = '$current_date'";
                }

                $run_query_absen = mysqli_query($conn, $query_absen);
                if($run_query_absen){
                    echo "<script>
                            alert('Absen pulang berhasil');
                            window.location.href='index.php'
                        </script>";
                    exit;
                } else {
                    echo "<script>
                            alert('Absen pulang gagal');
                            window.location.href='index.php'
                        </script>";
                    exit;
                }

            }
        }

    }

?>
<div class="box w-36">
    <div class="box-header">
        <b><?= $_SESSION['uname'] ?></b>
    </div>

    <div class="box-content">
        <p style="margin:0;margin-bottom:10px;font-size: 13px;"><?= $ref_day[date('N')] . ', ' . date('d') . ' ' . $ref_month[date('m')] . ' ' . date('Y') ?> | <span id="clock"></span></p>
        <div class="container-absensi">
            <div>
                <p><?= $check_in ?><p>
                <button type="button" onclick="window.location.href='?absen=masuk'" class="btn btn-dark">Absen Masuk</button>
            </div>

            <div>
                <p><?= $check_out ?></p>
                <button type="button" onclick="window.location.href='?absen=pulang'" class="btn btn-dark">Absen Pulang</button>
            </div>
        </div>

    </div>
</div>  

<script>
    function clock(){
        const now = new Date();
        let h = String(now.getHours()).padStart(2, "0");
        let m = String(now.getMinutes()).padStart(2, "0");
        let s = String(now.getSeconds()).padStart(2, "0");
        document.getElementById("clock").innerText = `${h}:${m}:${s}`;
    }

    setInterval(() => {
        clock()
    }, 1000);

    clock()
</script>
<?php include 'layouts/footer.php' ?>