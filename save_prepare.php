<?php
include 'koneksi/koneksi.php';

if (isset($_POST['no_deliv']) && isset($_POST['part_fln_scan'])) {
    $part_fln_scan = $_POST['part_fln_scan'];
    $no_delivery = $_POST['no_deliv'];

    // Pecah part no dan qty
    $qr_part_no = explode("/", $part_fln_scan);

    // Cek part  NO & qty stock area
    $part_no_all = mysqli_fetch_assoc(mysqli_query($conn, "SELECT current_stock FROM stock_area where part_no='$qr_part_no[0]' and kategori='1' ORDER BY tgl_updated DESC LIMIT 1"));
    $stock_area = $part_no_all['current_stock'] ?? 0;
    $kurangi_stock_area = $stock_area - $qr_part_no[1];

    // Cek part no & qty stock all
    $data_stock_all = mysqli_fetch_assoc(mysqli_query($conn, "SELECT qty FROM stock_all where part_no='$qr_part_no[0]' ORDER BY tgl_updated DESC LIMIT 1"));
    $stock_all = $data_stock_all['qty'] ?? 0;
    $tambah_stock_all = $stock_all - $qr_part_no[1];

    // update stock_area pada tgl terakhir
    $update_stock_area = mysqli_query($conn, "UPDATE stock_area SET current_stock='$kurangi_stock_area' WHERE part_no='$qr_part_no[0]' and kategori=1 ORDER BY tgl_updated DESC LIMIT 1");
    // update stock_area pada tgl terakhir
    $add_stok_all = mysqli_query($conn, "UPDATE stock_all SET qty='$tambah_stock_all' WHERE part_no='$qr_part_no[0]'  ORDER BY tgl_updated DESC LIMIT 1");


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