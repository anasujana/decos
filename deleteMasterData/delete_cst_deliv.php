<?php
    include '../koneksi/koneksi.php';
    session_start();
    
    if(isset($_GET['id_cs_deliv'])){
        $id_cs_deliv = $_GET['id_cs_deliv'];
        $delete_cs_del = mysqli_query($conn,"DELETE from customer_deliv where id='$id_cs_deliv'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/customer_deliv.php');  
    }
?>
 