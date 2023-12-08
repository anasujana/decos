<?php
    include '../koneksi/koneksi.php';
    session_start();

    if(isset($_GET['id_user'])){
        $id_user = $_GET['id_user'];
        $delete_role = mysqli_query($conn,"DELETE from role_user where id='$id_user'");

        //set session sukses
        $_SESSION["sukses"] = 'Data Berhasil Dihapus';

        header('location: ../master_data/role_user.php');  
    }
?>
 