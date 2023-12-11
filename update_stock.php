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
    $part_no_edit = $_POST['part_no_edit'];
    $stock_edit = $_POST['stock_edit'];
    $deliv_edit = $_POST['deliv_edit'];
    $std_edit = $_POST['std_edit'];

    $update = mysqli_query($conn, "UPDATE list_part SET current_stock='$stock_edit', deliv_day='$deliv_edit', std_stock='$std_edit' WHERE part_no='$part_no_edit'");
    header('location: daily_delivery.php');

    ?>
    <!-- edit area -->

</body>

</html>