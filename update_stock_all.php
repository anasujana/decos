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
    $id_stock_all = $_POST['id_stock_all'];
    $del_day_all = $_POST['del_day_all'];
    $std_stock_all = $_POST['std_stock_all'];

    $update = mysqli_query($conn, "UPDATE stock_all SET del_day='$del_day_all', std_stock='$std_stock_all' WHERE id='$id_stock_all'");
    header('location: daily_delivery.php');1
    ?>
    <!-- edit area -->

</body>

</html>