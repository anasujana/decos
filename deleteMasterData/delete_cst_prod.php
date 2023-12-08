<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_GET['id_cs'])){
        $id_cs = $_GET['id_cs'];
        $delete_cs = mysqli_query($conn,"DELETE from customer_prod where id='$id_cs'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/customer_prod.php');  
    }
?>
 