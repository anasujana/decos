<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_GET['id_cycle'])){
        $id_cycle = $_GET['id_cycle'];
        $delete_cycle = mysqli_query($conn,"DELETE from cycle_deliv where id='$id_cycle'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/deliv_cycle.php');  
    }
?>
 