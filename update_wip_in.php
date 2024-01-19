<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- edit area -->
    <?php
    include('koneksi/koneksi.php');
    $oj_in_id = $_POST['oj_in_id'];
    $kategori = $_POST['kategori_edit'];
    $kurangi_stock = $_POST['kurangi_stock'];
    $part_no_edit = $_POST['part_no_edit'];
    $tgl_edit = $_POST['tgl_edit'];

<<<<<<< HEAD
    $stock_in_cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT stock_in, stock_out FROM stock where id_stock='$oj_in_id'"));
    $stock_in_upd = $stock_in_cek['stock_in'];
    $stock_out = $stock_in_cek['stock_out'];
    $upd_stock_in = $stock_in_upd - $kurangi_stock;
    $upd_current = $upd_stock_in - $stock_out;

    $update_stock_in = mysqli_query($conn, "UPDATE stock SET stock_in='$upd_stock_in', current_stock= '$upd_current' WHERE id_stock='$oj_in_id'");
=======
    // Cek part  NO & qty stock in
    $stock_in_cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT qty FROM stock_in where stock_id='$oj_in_id'"));
    $stock_in_upd = $stock_in_cek['qty'];
    $upd_stock = $stock_in_upd - $kurangi_stock;

    $update_stock_in = mysqli_query($conn, "UPDATE stock_in SET qty='$upd_stock' WHERE stock_id='$oj_in_id'");

    // Cek part  NO & qty stock area
    $stock_in_area = mysqli_fetch_assoc(mysqli_query($conn, "SELECT current_stock FROM stock_area where part_no='$part_no_edit' AND tgl_updated='$tgl_edit' AND kategori='$kategori'"));
    $current_stock = $stock_in_area['current_stock'];
    $upd_stock_area = $current_stock - $kurangi_stock;

    $update_stock_area = mysqli_query($conn, "UPDATE stock_area SET current_stock='$upd_stock_area' WHERE part_no='$part_no_edit' AND tgl_updated='$tgl_edit'  AND kategori='$kategori'");
>>>>>>> 8ad8defbc58cdf6adb6b93ca500740f41b7cabf5

    // Cek part  NO & qty stock all
    $stock_in_all = mysqli_fetch_assoc(mysqli_query($conn, "SELECT qty FROM stock_all where part_no='$part_no_edit' AND tgl_updated='$tgl_edit'"));
    $stock_in_all = $stock_in_all['qty'];
    $upd_stock_all = $stock_in_all - $kurangi_stock;

<<<<<<< HEAD
=======
    $update_stock_all = mysqli_query($conn, "UPDATE stock_all SET qty='$upd_stock_all' WHERE part_no='$part_no_edit' AND tgl_updated='$tgl_edit'");

>>>>>>> 8ad8defbc58cdf6adb6b93ca500740f41b7cabf5
    header("Location: wip.php?kategori=$kategori");
    exit();

    ?>
    <!-- edit area -->

</body>

</html>