<?php
    include '../koneksi/koneksi.php';
    session_start();
    
    if(isset($_GET['id_user'])){
        $id_user = $_GET['id_user'];
        $delete_user = mysqli_query($conn,"DELETE from user where id='$id_user'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/user.php');  
    }
?>
 