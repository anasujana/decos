<?php
session_start();
include('../koneksi/koneksi.php');
date_default_timezone_set('Asia/Jakarta')
?>
<!DOCTYPE html>
<html lang="en">

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
    <link rel="icon" href="../assets/images/FLN.png" type="image/x-icon">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="../assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script src="../assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
</head>

<body>
    <?php
    include('../koneksi/koneksi.php');
    ?>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?php
            include('../element/topbar.php');
            ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?php
                    include('../element/navbar_admin.php');
                    ?>

                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Preparation</h5>
                                            <p class="m-b-0">Planing Delivery</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class=""><a href="../chekshet_delivery.php"><i class="ti-angle-double-left"></i> BACK</a>
                                            </li>
                                        </ul>
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
                                            <div class="col-md-12 d-print-none">
                                                <div class="card shadow mb-12">
                                                    <div class="card-header">
                                                        <h5>Add Plan Delivery</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="cust_deliv" class="form-control" value="<?php if (isset($_POST["customer"])) {
                                                                                                                                    echo $_POST["customer"];
                                                                                                                                };
                                                                                                                                ?>">
                                                            <input type="hidden" name="tgl_kirim" class="form-control" value="<?php if (isset($_POST["tgl_deliv"])) {
                                                                                                                                    echo $_POST["tgl_deliv"];
                                                                                                                                };
                                                                                                                                ?>">
                                                            <input type="hidden" name="cycle_kirim" class="form-control" value="<?php if (isset($_POST["cycle_deliv"])) {
                                                                                                                                    echo $_POST["cycle_deliv"];
                                                                                                                                };
                                                                                                                                ?>">

                                                            <?php
                                                            if (isset($_POST['customer'])) {
                                                                $customer = $_POST['customer'];

                                                                $tabel = mysqli_query($conn, "SELECT pd.part_no, lp.part_name FROM part_deliv pd 
                                                                                                                            inner join list_part lp on pd.part_no=lp.part_no
                                                                                                                            WHERE pd.customer_id='$customer' and status = 'aktif' order by lp.part_no asc");

                                                                foreach ($tabel as $data) {
                                                                    $part_no = $data['part_no'];
                                                                    $part_name = $data['part_name'];
                                                            ?>

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="Nama">Part Number</label>
                                                                            <input type="text" value="<?php echo $part_no; ?>" class="form-control form-control-round font-weight-bold" disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="inputpictagane">Part Name</label>
                                                                            <input type="text" name="" class="form-control form-control-round font-weight-bold" value="<?php echo $part_name; ?>" disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="">Qty</label>
                                                                            <input type="number" name="<?php echo $part_no; ?>" class="form-control form-control-round" value="" autofocus>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="float-right">
                                                                    <button type="reset" class="btn btn-secondary btn-round">Reset</button>&nbsp;
                                                                    <input type="submit" class="btn btn-primary btn-round" value="Save">
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <br>
                                                        </form>

                                                        <?php
                                                        // cek ada/tidak nya data
                                                        if (isset($_POST['cust_deliv']) and isset($_POST['tgl_kirim']) and isset($_POST['cycle_kirim'])) {
                                                            // terima data   

                                                            $cust_deliv = $_POST['cust_deliv'];
                                                            $tgl_kirim = $_POST['tgl_kirim'];
                                                            $tgl_deliv = date('Ymd', strtotime($tgl_kirim));
                                                            $jam = date("His");
                                                            $cycle_kirim = $_POST['cycle_kirim'];

                                                            $cycle = mysqli_fetch_assoc(mysqli_query($conn, "SELECT no_ct FROM cycle_deliv where id='$cycle_kirim'"));
                                                            $custom = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, customer FROM customer_deliv where id='$cust_deliv'"));

                                                            $date_now = date("Y-m-d H:i:s");
                                                            $no_deliv = strtotime($date_now) . "0";

                                                            // loop
                                                            $plan_delivery = mysqli_query($conn, "SELECT * FROM part_deliv WHERE customer_id='$cust_deliv'");

                                                            foreach ($plan_delivery as $data) {
                                                                $part_no = $data['part_no'];
                                                                $qty_plan = $_POST[$part_no];

                                                                if ($qty_plan != NULL) {
                                                                    // tambahkan ke databasea
                                                                    $tambah = mysqli_query($conn, "INSERT INTO plan VALUES (NULL,'$part_no','$tgl_kirim','$cust_deliv','$cycle_kirim','$qty_plan','$no_deliv',NULL)");
                                                                }
                                                            }
                                                            echo '<script languange="javascript">
                                                                        swal.fire({
                                                                            title: "Success",
                                                                            text: "Planing Delivery Created",
                                                                            icon:"success",
                                                                            timer: 1500
                                                                        }).then(function(){
                                                                            window.location.href="../chekshet_delivery.php";
                                                                            });
                                                                    </script>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
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

    <!-- Required Jquery -->
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="../assets/pages/widget/excanvas.js "></script>
    <!-- waves js -->
    <script src="../assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../assets/js/modernizr/modernizr.js "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="../assets/js/SmoothScroll.js"></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- Chart js -->
    <script type=".text/javascript" src="../assets/js/chart.js/Chart.js"></script>
    <!-- amchart js -->
    <!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script> -->
    <script src="../assets/pages/widget/amchart/gauge.js"></script>
    <script src="../assets/pages/widget/amchart/serial.js"></script>
    <script src="../assets/pages/widget/amchart/light.js"></script>
    <script src="../assets/pages/widget/amchart/pie.min.js"></script>
    <!-- <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script> -->
    <!-- menu js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="../assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="../assets/js/script.js "></script>
</body>

</html>