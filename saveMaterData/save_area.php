<?php
    include('../koneksi/koneksi.php');
    if(isset($_POST['sarea']) and isset($_POST['sdept'])){
        // terima data                                 
        $area = $_POST['sarea'];
        $dept = $_POST['sdept'];
        $add_area = mysqli_query($conn,"INSERT INTO area VALUES (NULL,'$area','$dept')"); 
    }
?>