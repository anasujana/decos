<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_GET['id_line'])){
        $id_line = $_GET['id_line'];
        $delete_line = mysqli_query($conn,"DELETE from line where id_line='$id_line'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/line_prod.php');  
    }
?>
 