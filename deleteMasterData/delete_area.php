<?php
    include '../koneksi/koneksi.php';
    session_start();
    if(isset($_POST['id_ar'])){
        $id_ar = $_POST['id_ar'];
        $delete_ar = mysqli_query($conn,"DELETE from area where id='$id_ar'");
    }
?>
 