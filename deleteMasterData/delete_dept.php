<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_GET['id_dept'])){
        $id_dept = $_GET['id_dept'];
        $delete_dept = mysqli_query($conn,"DELETE from departemen where id_dept='$id_dept'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/departemen.php');  
    }
?>
 