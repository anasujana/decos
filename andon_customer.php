<!DOCTYPE html>
<html lang="en">
<?php
session_start();
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
</head>

<body>
    <?php
    include('koneksi/koneksi.php');
    ?>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header d-print-none">
                <div class="navbar-wrapper">
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="delivery_status.php">
                                    <i style="font-size: 17px;" class="ti-truck"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- <div class="pcoded-content"> 
                        <div class="pcoded-inner-content"> -->
                    <!-- Main-body start -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- Page-body start -->
                            <div class="page-body">
                                <!-- header start-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="assets/images/logo fln.png" width="155px" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        if (isset($_GET['area'])) {
                                            $area = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id,nama_area FROM area WHERE id='$_GET[area]'"));
                                        } else if (!isset($_GET['area'])) {
                                            $area = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id,nama_area FROM area WHERE id='$_SESSION[id_area]'"));
                                        } ?>
                                        <h1 style="font-size:27px;" class="m-b-10 text-center font-weight-bold">Monitoring Delivery <br><?php echo $area['nama_area']; ?></h1>
                                    </div>
                                    <div class="col-md-4 font-weight-bold">
                                        <p style="font-size:13px;" class="m-b-10 text-right"><?php
                                                                                                setlocale(LC_ALL, 'id-ID', 'id_ID');
                                                                                                echo strftime("%A, %d %B %Y");
                                                                                                ?>
                                        </p>
                                        <p style="font-size:13px;" class="text-right"><?php $now_time = date("H:i:s");
                                                                                        echo $now_time; ?></p>
                                    </div>
                                </div><br>
                                <!-- header end-->

                                <!-- content start-->
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="row">
                                            <?php
                                            $now_date = date("Y-m-d");
                                            mysqli_query($conn, "CREATE TEMPORARY TABLE acm_deliv SELECT cd.id,
                                                                                                                    cd.customer,
                                                                                                                    SUM(plan) AS planing,
                                                                                                                    SUM((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                                                                            AND pr.no_delivery=p.no_delivery)) 
                                                                                                                    AS actual
                                                                                                                    FROM plan p 
                                                                                                                    left join customer_deliv cd on cd.id = p.id_customer 
                                                                                                                    LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
                                                                                                                    WHERE ((p.tgl='$now_date' OR sj.no_sj IS NULL) and p.tgl<='$now_date') AND cd.id_area=$area[id]
                                                                                                                    GROUP BY p.id_customer ORDER BY customer ASC");
                                            $card_cst = mysqli_query($conn, "SELECT * FROM acm_deliv");

                                            foreach ($card_cst as $data_cst) {
                                                $cst = $data_cst['customer'];
                                                $cst_id = $data_cst['id'];
                                                $planing = $data_cst['planing'];
                                                $actual = $data_cst['actual'];
                                                $bal = $planing - $actual;
                                                if ($actual == null) {
                                                    $ach = "0";
                                                } else {
                                                    $ach = ($actual / $planing) * 100;
                                                    $ach = round($ach, 1) . '%';
                                                }
                                            ?>
                                                <div class="col-xl-3">
                                                    <div class="card">
                                                        <div class="card-block">
                                                            <div class="row align-items-center text-center">
                                                                <div class="col-12 text-center">
                                                                    <H5 class="text-muted m-b-0">ACHIVEMENT</H5>
                                                                    <div id="customer<?php echo $cst_id; ?>"></div>
                                                                </div>
                                                                <div class="col-4 text-center">
                                                                    <H4 <?php if ($bal > $planing) {
                                                                            echo 'class="text-warning"';
                                                                        } else if ($actual < $planing and $planing != NULL) {
                                                                            echo 'class="text-danger"';
                                                                        } else {
                                                                            echo 'class="text-dark"';
                                                                        } ?>>
                                                                        <?php
                                                                        if ($planing == null) {
                                                                            echo '0';
                                                                        } else {
                                                                            echo $planing;
                                                                        }
                                                                        ?>
                                                                    </H4>
                                                                    <H5 class="text-muted m-b-0">PLAN</H5>
                                                                </div>
                                                                <div class="col-4 text-center">
                                                                    <H4 <?php if ($bal > $planing) {
                                                                            echo 'class="text-warning"';
                                                                        } else if ($actual < $planing and $planing != NULL) {
                                                                            echo 'class="text-danger"';
                                                                        } else {
                                                                            echo 'class="text-dark"';
                                                                        } ?>>
                                                                        <?php
                                                                        if ($actual == null) {
                                                                            echo '0';
                                                                        } else {
                                                                            echo $actual;
                                                                        }
                                                                        ?>
                                                                    </H4>
                                                                    <H5 class="text-muted m-b-0">ACT</H5>
                                                                </div>
                                                                <div class="col-4 text-center">
                                                                    <H4 <?php if ($bal > $planing) {
                                                                            echo 'class="text-warning"';
                                                                        } else if ($actual < $planing and $planing != NULL) {
                                                                            echo 'class="text-danger"';
                                                                        } else {
                                                                            echo 'class="text-dark"';
                                                                        } ?>>
                                                                        <?php if ($bal == null) {
                                                                            echo '0';
                                                                        } else {
                                                                            echo $bal;
                                                                        } ?>
                                                                    </H4>
                                                                    <H5 class="text-muted m-b-0">BAL</H5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer bg-c-blue text-center">
                                                            <div class="row align-items-center">
                                                                <div class="col-2 text-">
                                                                    <a href="delivery_status.php?cst_filter=<?php echo $cst_id; ?>" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="See Delivery Status">
                                                                        <i style="font-size: 20px;" class="ti-arrow-circle-left text-white"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-8">
                                                                    <h5 class="text-white"><?php echo $cst; ?>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-2 text-">
                                                                    <a href="delivery_monitor.php?cst_filter=<?php echo $cst_id; ?>" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="See Item Delivery">
                                                                        <i style="font-size: 20px;" class="ti-arrow-circle-right text-white"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- Basic table card end -->
                                </div>
                                <!-- content end-->
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

    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="assets/pages/widget/excanvas.js "></script>
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
    <!-- moris -->
    <script src="assets/js/moris/cdnjs.cloudflare.com_ajax_libs_raphael_2.1.0_raphael-min.js"></script>
    <script src="assets/js/moris/cdnjs.cloudflare.com_ajax_libs_morris.js_0.5.1_morris.min.js"></script>
    <link rel="stylesheet" href="assets/js/moris/cdnjs.cloudflare.com_ajax_libs_morris.js_0.5.1_morris.css">
    <!-- moris -->
    <!-- apex -->
    <script src="assets/js/apex.js/cdn.jsdelivr.net_npm_apexcharts"></script>
    <!-- apex -->
    <script src="assets/js/chart.js/Chart.js"></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/script.js "></script>

    <!-- doughnut chart ach -->
    <?php
    foreach ($card_cst as $data_cst) {
        $cst = $data_cst['customer'];
        $cst_id = $data_cst['id'];
        $planing = $data_cst['planing'];
        $actual = $data_cst['actual'];
        $bal = $planing - $actual;
        if ($actual == null) {
            $ach = 0;
        } else {
            $ach = ($actual / $planing) * 100;
            $ach = round($ach, 1);
        }
    ?>
        <script>
            var customer<?php echo $cst_id; ?> = {
                chart: {
                    type: 'radialBar',
                    height: 220,
                    zoom: {
                        enabled: false
                    },
                    offsetY: 2
                },
                colors: [
                    <?php
                    if ($actual == $planing) {
                        echo "'#3A6EFF', '#1ABC9C'";
                    } else {
                        echo "'#E91E63', '#E91E63'";
                    }
                    ?>
                ],
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            name: {
                                show: false,
                            },
                            value: {
                                offsetY: 10,
                                fontSize: '30px',
                            }
                        }
                    }
                },
                series: [<?php echo $ach; ?>],
                theme: {
                    monochrome: {
                        enabled: false
                    }
                },
                legend: {
                    show: false
                }
            }

            var chart<?php echo $cst_id; ?> = new ApexCharts(document.querySelector('#customer<?php echo $cst_id; ?>'), customer<?php echo $cst_id; ?>);
            chart<?php echo $cst_id; ?>.render();
        </script>

    <?php
    };
    ?>
    <!-- doughnut chart ach -->

    <!-- js tooltip -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function() {
            $('[data-toggle="popover"]').popover({
                html: true,
                content: function() {
                    return $('#primary-popover-content').html();
                }
            });
        });
    </script>
    <!-- js tooltip -->
</body>

</html>