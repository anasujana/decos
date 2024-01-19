<?php
include 'koneksi/koneksi.php';

if (isset($_POST['no_part']) and isset($_POST['kategori'])) {
    // terima part_number
    $part_scan = $_POST['no_part'];
    $kategori = $_POST['kategori'];
    $qr_part_no = explode("/", $part_scan);
    $now_date = date("Y-m-d");

    // Cek part no dari master data
    $cek_stock_mt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no FROM list_part where part_no='$qr_part_no[0]'"));
    $part_no_mt = $cek_stock_mt['part_no'];

    // Cek part  NO & qty stock 
    $cek_last_stock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no, tgl, stock_awal, stock_in, stock_out, current_stock FROM stock where part_no='$qr_part_no[0]' and kategori='$kategori' ORDER BY tgl DESC LIMIT 1"));
    $tgl_akhir = $cek_last_stock['tgl'] ?? null;
    $last_stock = $cek_last_stock['current_stock'] ?? 0;
    $stock_in = $cek_last_stock['stock_in'] ?? 0;
    $tambah_stock_in = $stock_in + $qr_part_no[1];
    $current_stock_in = $last_stock + $qr_part_no[1];
    $stock_out = $cek_last_stock['stock_out'] ?? 0;
    $tambah_stock_out = $stock_out + $qr_part_no[1];

    // Cek part no & qty stock all
    $data_stock_all = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no, tgl_updated, del_day, std_stock, qty FROM stock_all where part_no='$qr_part_no[0]' ORDER BY tgl_updated DESC LIMIT 1"));
    $last_stock_all = $data_stock_all['tgl_updated'] ?? null;
    $stock_all = $data_stock_all['qty'] ?? 0;
    $del_day = $data_stock_all['del_day'] ?? 0;
    $std_stock = $data_stock_all['std_stock'] ?? 0;
    $tambah_stock_all = $stock_all + $qr_part_no[1];

    if (($part_no_mt == $qr_part_no[0])) {
        if ($now_date != $last_stock_all) {
            // tambahkan ke stok area
            $add_stok_all = mysqli_query($conn, "INSERT INTO stock_all VALUES (NULL,'$qr_part_no[0]','$now_date','$tambah_stock_all',' $del_day','$std_stock',NULL)");
        } else if ($now_date == $last_stock_all) {
            // update stock_area pada tgl terakhir
            $add_stok_all = mysqli_query($conn, "UPDATE stock_all SET qty='$tambah_stock_all' WHERE part_no='$qr_part_no[0]' and tgl_updated='$last_stock_all'");
        }

        if ($now_date != $tgl_akhir) {
            // tambahkan ke stok area
            $add_stock_in = mysqli_query($conn, "INSERT INTO stock VALUES (NULL,'$qr_part_no[0]',$kategori,'$now_date',$last_stock,$qr_part_no[1],0,$current_stock_in)");
        } else if ($now_date == $tgl_akhir) {
            // update stock_area pada tgl terakhir
            $add_stock_in = mysqli_query($conn, "UPDATE stock SET stock_in='$tambah_stock_in', current_stock='$current_stock_in' WHERE part_no='$qr_part_no[0]' and tgl='$tgl_akhir' and kategori='$kategori'");
        }
        echo '<script>
                swal.fire({
                    title: "Success",
                    text: "Scan QR label Complete",
                    icon: "success",
                    timer: 1500
                }).then(function(){
                    document.getElementById("part_scan").focus();
                    });
            </script>';
    } else {
        echo '<script>
                    swal.fire({
                        title: "Error!",
                        text: "Part Number Customer Tidak Cocok",
                        icon:"error",
                    }).then(function(){
                        document.getElementById("part_scan").focus();
                        });
                </script>';
    };
};
