<?php
    include '../koneksi/koneksi.php';
    if(isset($_POST['sedit_id']) AND isset($_POST['sarea_edit']) AND isset($_POST['sdept_edit'])){
        $sedit_id = $_POST['sedit_id'];
        $sarea_edit = $_POST['sarea_edit'];
        $sdept_edit = $_POST['sdept_edit'];
        
        $update = mysqli_query($conn, "UPDATE area SET nama_area='$sarea_edit', id_dept='$sdept_edit' where id='$sedit_id'");
    }
?>
 