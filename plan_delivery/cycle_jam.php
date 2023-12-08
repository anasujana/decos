<?php
    include('../koneksi/koneksi.php');
    $cycle = $_GET["kcycle_deliv"];
    $jam = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM cycle_deliv where id='$cycle'"));
    $data = array(
        'jam' => $jam['waktu'],
    );
    echo json_encode($data);
?>