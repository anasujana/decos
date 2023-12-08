<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_GET['id_part_deliv'])){
        $id_part = $_GET['id_part_deliv'];
        $delete = mysqli_query($conn,"DELETE from part_deliv where id='$id_part'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/part_deliv.php');  
    }
?>
 