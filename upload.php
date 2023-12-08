<?php
    if (isset($_FILES['file'])) {
    session_start();
    function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength= strlen($characters);
        $randomstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randomstring = $characters[rand(0, $charactersLength - 1)];
        }
        return $randomstring;
    }
    require_once (__DIR__ . '/vendor/autoload.php');
    require "session.php"; 
    date_default_timezone_set('Asia/Jakarta');

    include('koneksi/koneksi.php');

    $err = "";
    $ekstensi = "";
    $success = "";

    $file_name = $_FILES['file']['name'];
    $file_data = $_FILES['file']['tmp_name'];

    if (empty($file_name)) {
        $err = "<li>masukan file</li>";
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls", "xlsx", "csv");
    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $err = "<script>
                    Swal.fire({            
                        icon: 'error',                   
                        title: 'Error',    
                        text: 'you must upload file xls or xlsx',
                    })
                </script>";
    }

    if (empty($err)) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data);
        $sheet_data = $spreadsheet->getActiveSheet()->toArray();

        $jumlah_data = 0;
        for ($i = 1; $i < count($sheet_data); $i++) {
            // Your data processing logic here
            $part_no= $sheet_data [$i]['0'];
            $tgl= $sheet_data [$i]['1'];
            $id_customer= $sheet_data [$i]['2'];
            $id_cycle= $sheet_data [$i]['3'];
            $plan= $sheet_data [$i]['4'];
            $no= $sheet_data [$i]['5'];
            $tgl = $sheet_data[$i]['1'];
            $timestamp = strtotime($tgl);
            if ($timestamp === false) {
                // Tanggal tidak dapat diuraikan, munculkan pesan kesalahan
                $err = "<li>Tanggal tidak valid: $tgl</li>";
            } else {
                $tgl = date("Y-m-d", $timestamp);
                $date_deliv = date("Ymd", $timestamp);
            }

            if($no == ''){
                $no_deliv = $date_deliv."-".$id_customer."-".$id_cycle."-"."0";
            }else{
                $no_deliv = $no."-".$date_deliv."-".$id_customer."-".$id_cycle."-"."0";
            }

            // ambil id cycle
            $cek_cycle = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM cycle_deliv where no_ct='$id_cycle' AND customer_id='$id_customer'"));
            $cycle_db = $cek_cycle['id'];
             // ambil id cycle

            $upload_plan= "insert into plan(part_no,tgl,id_customer,id_cycle,plan,no_delivery)
            VALUES('$part_no','$tgl','$id_customer','$cycle_db','$plan','$no_deliv')";

            mysqli_query($conn, $upload_plan);
            $jumlah_data++;
        }

        if ($jumlah_data > 0) {
            $success = '<script languange="javascript">
                            swal.fire({
                                title: "Success",
                                text: "Scan QR label Complete",
                                icon: "success",
                                timer: 1500
                            });
                            </script>';
        }
    }

    if ($err) {
        echo $err;
    }
    if ($success) {
        echo $success;
    }
}
?>
