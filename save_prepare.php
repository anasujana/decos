<?php
include 'koneksi/koneksi.php';

if (isset($_POST['no_deliv']) && isset($_POST['part_fln_scan'])) {
    $part_fln_scan = $_POST['part_fln_scan'];
    $no_delivery = $_POST['no_deliv'];

    // Pecah part no dan qty
    $qr_part_no = explode("/", $part_fln_scan);

    // Bandingkan aktual vs. rencana
    $query = "SELECT part_no, plan, (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery) AS act, id_customer
              FROM plan p
              WHERE no_delivery='$no_delivery' AND part_no='$qr_part_no[0]'";
    $qty = mysqli_fetch_assoc(mysqli_query($conn, $query));

    $part_fln_db = $qty['part_no'];
    $id_customer = $qty['id_customer'];
    $plan = $qty['plan'];
    $act = $qty['act'] + $qr_part_no[1];

    // Periksa scan label customer
    $query = "SELECT scan, customer FROM customer_deliv WHERE id=$id_customer";
    $cst_deliv = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $cus = $cst_deliv['scan'];
    $cust = $cst_deliv['customer'];

    // Buat id primary key
    $date_now = date("Y-m-d H:i:s");
    $id_primary = strtotime($date_now) . "$cust";

    if ($part_fln_db != $qr_part_no[0]) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Part Number Tidak Cocok'
            });
        </script>
        <?php
    } elseif ($part_fln_db == $qr_part_no[0] && $cus == 'no' && $act <= $plan) {
        // Tambahkan ke database
        $add = mysqli_query($conn, "INSERT INTO prepare (id_prep, part_no_prep, qty, no_delivery) VALUES ('$id_primary', '$qr_part_no[0]', '$qr_part_no[1]', '$no_delivery')");
        ?>
        <script>
            swal.fire({
                title: "Success",
                text: "Scan QR Berhasil",
                icon: "success",
                timer: 1500
            });
        </script>
        <?php
    } else if ($part_fln_db == $qr_part_no[0] && $act > $plan) {
        ?>
        <script>
            swal.fire({
                icon: "error",
                title: "Error!",
                text: "Prepare Close / Qty Over"
            });
        </script>
        <?php
    }
}

$response = array(
    'part_scan' => $part_fln_scan
);
echo json_encode($response);
?>
