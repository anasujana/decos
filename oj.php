<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('koneksi/koneksi.php');
date_default_timezone_set('Asia/Jakarta')
?>

<head>
    <title>Delivery Control System</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/FLN.png" type="image/x-icon">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="assets/pages/widget/excanvas.js "></script>
    <link rel="stylesheet" href="assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.css">
    <script src="assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.js"></script>
    <script src="assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/moris/cdnjs.cloudflare.com_ajax_libs_raphael_2.1.0_raphael-min.js"></script>
    <script src="assets/js/moris/cdnjs.cloudflare.com_ajax_libs_morris.js_0.5.1_morris.min.js"></script>
</head>

<body>
    <?php
    $now_date = date("2023-09-17");
    include('koneksi/koneksi.php');
    ?>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-container navbar-wrapper">
            <?php
            include('element/topbar.php');
            ?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php
                    include('element/navbar.php');
                    ?>

                    <?php
                    // SCAN PART FLN
                    if (isset($_POST['part_scan'])) {
                        // terima part_number
                        $part_scan = $_POST['part_scan'];
                        $qr_part_no = explode("/", $part_scan);
                        $now_date = date("Y-m-d");

                        // Cek part no dari master data
                        $cek_stock_mt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no FROM list_part where part_no='$qr_part_no[0]'"));
                        $part_no_mt = $cek_stock_mt['part_no'];

                        // Cek part  NO & qty stock 
                        $cek_last_stock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no, tgl, stock_awal, stock_in, stock_out, current_stock FROM stock where part_no='$qr_part_no[0]' and kategori='$_GET[kategori]' ORDER BY tgl DESC LIMIT 1"));
                        $tgl_akhir = $cek_last_stock['tgl'] ?? null;
                        $last_stock = $cek_last_stock['current_stock'] ?? 0;
                        $stock_in = $cek_last_stock['stock_in'] ?? 0;
                        $tambah_stock_in = $stock_in + $qr_part_no[1];
                        $current_stock_in = $last_stock + $qr_part_no[1];
                        $current_stock_out = $last_stock - $qr_part_no[1];
                        $stock_out = $cek_last_stock['stock_out'] ?? 0;
                        $tambah_stock_out = $stock_out + $qr_part_no[1];

                        // Cek part  NO & qty wip
                        $cek_last_stock_wip = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no, tgl, stock_awal, stock_in, stock_out, current_stock FROM stock where part_no='$qr_part_no[0]' and kategori=1 ORDER BY tgl DESC LIMIT 1"));
                        $tgl_akhir_wip = $cek_last_stock_wip['tgl'] ?? null;
                        $last_stock_wip = $cek_last_stock_wip['current_stock'] ?? 0;
                        $stock_in_wip = $cek_last_stock_wip['stock_in'] ?? 0;
                        $tambah_stock_in_wip = $stock_in_wip + $qr_part_no[1];
                        $current_stock_in_wip = $last_stock_wip + $qr_part_no[1];

                        // Cek part no & qty stock all
                        $data_stock_all = mysqli_fetch_assoc(mysqli_query($conn, "SELECT part_no, tgl_updated, del_day, std_stock, qty FROM stock_all where part_no='$qr_part_no[0]' ORDER BY tgl_updated DESC LIMIT 1"));
                        $last_stock_all = $data_stock_all['tgl_updated'] ?? null;
                        $stock_all = $data_stock_all['qty'] ?? 0;
                        $del_day = $data_stock_all['del_day'] ?? 0;
                        $std_stock = $data_stock_all['std_stock'] ?? 0;
                        $tambah_stock_all = $stock_all + $qr_part_no[1];
                        $kurangi_stock_all = $stock_all - $qr_part_no[1];

                        if ($part_no_mt == $qr_part_no[0]) {
                            if ($now_date != $tgl_akhir and $_GET['kategori'] == 1) {
                                // tambahkan ke stok area
                                $add_stock_in = mysqli_query($conn, "INSERT INTO stock VALUES (NULL,'$qr_part_no[0]', $_GET[kategori], '$now_date', $last_stock, $qr_part_no[1], 0, $current_stock_in)");
                            } else if ($now_date == $tgl_akhir and $_GET['kategori'] == 1) {
                                // update stock_area pada tgl terakhir
                                $add_stock_in = mysqli_query($conn, "UPDATE stock SET stock_in='$tambah_stock_in', current_stock='$current_stock_in' WHERE part_no='$qr_part_no[0]' and tgl='$tgl_akhir' and kategori='$_GET[kategori]'");
                            } else if ($now_date != $tgl_akhir and $_GET['kategori'] != 1) {
                                // tambahkan ke stok area
                                $add_stock_in = mysqli_query($conn, "INSERT INTO stock VALUES (NULL,'$qr_part_no[0]',$_GET[kategori],'$now_date','$last_stock', 0, $qr_part_no[1], $current_stock_out)");
                                // update stock_area pada tgl terakhir
                                $upd_stock_in = mysqli_query($conn, "UPDATE stock SET stock_in='$tambah_stock_in_wip', current_stock='$current_stock_in_wip' WHERE part_no='$qr_part_no[0]' and tgl='$tgl_akhir_wip' and kategori=1");
                            } else if ($now_date == $tgl_akhir and $_GET['kategori'] != 1) {
                                // update stock_area pada tgl terakhir
                                $add_stock_in = mysqli_query($conn, "UPDATE stock SET stock_out='$tambah_stock_out', current_stock='$current_stock_out' WHERE part_no='$qr_part_no[0]' and tgl='$tgl_akhir' and kategori='$_GET[kategori]'");
                                // update stock_area pada tgl terakhir
                                $upd_stock_in = mysqli_query($conn, "UPDATE stock SET stock_in='$tambah_stock_in_wip', current_stock='$current_stock_in_wip' WHERE part_no='$qr_part_no[0]' and tgl='$tgl_akhir_wip' and kategori=1");
                            }

                            if ($now_date != $last_stock_all and $_GET['kategori'] == 1) {
                                // tambahkan ke stok area
                                $add_stok_all = mysqli_query($conn, "INSERT INTO stock_all VALUES (NULL,'$qr_part_no[0]','$now_date','$tambah_stock_all',' $del_day','$std_stock',NULL)");
                            } else if ($now_date == $last_stock_all and $_GET['kategori'] == 1) {
                                // update stock_area pada tgl terakhir
                                $update_stock_all = mysqli_query($conn, "UPDATE stock_all SET qty='$tambah_stock_all' WHERE part_no='$qr_part_no[0]' and tgl_updated='$last_stock_all'");
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
                    ?>

                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header d-print-none">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Output Jurnal</h5>
                                            <p class="m-b-0">FG 1</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="page-header-title">
                                            <p class="m-b-0 text-right"><?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                                                                        echo strftime("%A, %d %B %Y"); ?>
                                            </p>
                                            <p class="m-b-0 text-right"><?php $now_time = date("H:i:s");
                                                                        echo $now_time; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <!-- Basic table card start -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <h5>Output Jurnal</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-header-right">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <form action="" method="POST">
                                                                        <input type="text" name="part_scan" id="part_scan" class="form-control form-control-round" style="text-align: center;" placeholder="PART NO / QTY" autofocus>
                                                                        <input type="submit" name="submit_scan" style="display:none">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped datas">
                                                                <thead>
                                                                    <th>NO</th>
                                                                    <th>WAREHOUSE</th>
                                                                    <th>PART NO FLN</th>
                                                                    <th>PART NAME</th>
                                                                    <th>STOCK IN</th>
                                                                    <th>ACTION</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $now_date = date("Y-m-d");
                                                                    if ($_GET['kategori'] == 1) {
                                                                        $plan_deliv = mysqli_query($conn, "SELECT pd.part_no, 
                                                                                                                    lp.part_name,
                                                                                                                    COALESCE(s.qty, 0) AS stock_in,
                                                                                                                    s.qty,
                                                                                                                    ar.nama_area,
                                                                                                                    ks.jenis_stock
                                                                                                            FROM part_prod pd
                                                                                                            LEFT JOIN list_part lp ON lp.part_no = pd.part_no
                                                                                                            LEFT JOIN stock_in s ON pd.part_no = s.part_no AND s.tgl = '$now_date' AND s.kategori = 1
                                                                                                            LEFT JOIN kategori_stock ks ON ks.id = s.kategori
                                                                                                            LEFT JOIN area ar ON ar.id = pd.id_area");
                                                                    } else {
                                                                        $plan_deliv = mysqli_query($conn, "SELECT pd.part_no, 
                                                                                                                    lp.part_name,
                                                                                                                    COALESCE(s.qty, 0) AS stock_in,
                                                                                                                    ar.nama_area,
                                                                                                                    ks.jenis_stock
                                                                                                            FROM part_prod pd
                                                                                                            LEFT JOIN list_part lp ON lp.part_no = pd.part_no
                                                                                                            LEFT JOIN wip_out s ON pd.part_no = s.part_no AND s.tgl = '$now_date' AND s.kategori = '$_GET[kategori]'
                                                                                                            LEFT JOIN kategori_stock ks ON ks.id = s.kategori
                                                                                                            LEFT JOIN area ar ON ar.id = pd.id_area
                                                                                                            ");
                                                                    }





                                                                    $no = 1;

                                                                    foreach ($plan_deliv as $data1) {
                                                                        $nama_area = $data1['nama_area'];
                                                                        $part_no = $data1['part_no'];
                                                                        $part_name = $data1['part_name'];
                                                                        $prod = $data1['stock_in'];
                                                                        $part_asal = $data1['jenis_stock'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $no; ?></td>
                                                                            <td><?php echo $nama_area; ?></td>
                                                                            <td><?php echo $part_no; ?></td>
                                                                            <td><?php echo $part_name; ?></td>
                                                                            <td><?php echo $prod; ?></td>
                                                                            <td>
                                                                                <button type='button' class='btn btn-icon btn-danger btn-circle btn-sm edit' data-toggle='modal' data-id='$part_no' data-nama='$part_name' data-qtydeliv='$deliv_day' data-qtystd='$std_stock' data-target='#editStock'><i class="ti-minus"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $no++;
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Basic table card end -->
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal kurangi stock-->
    <div class="modal fade" id="editStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kurangi Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update_stock.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Nama">Part No</label>
                                <input type="text" name="part_no_edit" id="part_no_data" class="form-control form-control-round" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Nama">Part Name</label>
                                <input type="text" name="part_name_edit" id="part_name_data" class="form-control form-control-round" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Nama">Kurangi Stock</label>
                                <input type="text" name="deliv_edit" id="deliv_data" class="form-control form-control-round">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                            <input type="submit" name="save" class="btn btn-primary btn-round" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end-->
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="assets/js/chart.js/Chart.js"></script>
    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/script.js "></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.datas').DataTable();
        });
    </script>
</body>

</html>