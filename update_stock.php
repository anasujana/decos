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
    $stock_id = $_POST['stock_id'];
    $remark = $_POST['remark'];

    $update = mysqli_query($conn, "UPDATE stock_all SET remark='$remark' WHERE id='$stock_id'");
    header('location: daily_delivery.php');

    ?>
    <!-- edit area -->

</body>

</html>