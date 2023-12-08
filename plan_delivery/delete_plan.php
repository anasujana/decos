<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_GET['id_plan']) AND isset($_GET['part_no']) AND isset($_GET['no_delivery'])){
        $id_plan = $_GET['id_plan'];
        $part_no = $_GET['part_no'];
        $no_delivery = $_GET['no_delivery'];
        $delete_plan = mysqli_query($conn,"DELETE from plan where id='$id_plan'");
        $delete_prep = mysqli_query($conn,"DELETE from prepare where part_no_prep='$part_no' AND no_delivery='$no_delivery'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../chekshet_delivery.php');  
    }
?>
 