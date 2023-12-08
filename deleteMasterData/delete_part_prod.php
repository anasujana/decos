<?php
    include '../koneksi/koneksi.php';
    session_start();

    if(isset($_GET['part_no'])){
        $part_num = $_GET['part_no'];
        $delete = mysqli_query($conn,"DELETE from part_prod where part_no='$part_num'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/part_prod.php');  
    }
?>
 