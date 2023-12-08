<?php
    include('../koneksi/koneksi.php');
    $part = $_GET["no_part"];
    $qty = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM list_part where part_no='$part'"));
    $data = array(
        'qty' => $qty['qty_box'],
    );
    echo json_encode($data);
?>