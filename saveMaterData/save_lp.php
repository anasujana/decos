<?php
 include('../koneksi/koneksi.php');
    if(isset($_POST['save'])){
        // terima data                                 
        $Part_number = $_POST ['part_number'];
        $Part_name = $_POST ['part_name'];
        $Part_number_cst = $_POST ['part_number_cst'];
        $parent = $_POST ['code_4'];
        $child = $_POST ['code_5'];
        $code_2 = $_POST ['code_2'];
        $code_3 = $_POST ['code_3'];
        $qty= $_POST ['qty'];

        // tambahkan ke database    
        $addd = mysqli_query($conn,"INSERT INTO list_part VALUES ('$Part_number','$Part_name','$Part_number_cst','$parent','$child','$code_2','$code_3','$qty')"); 
    }
?>