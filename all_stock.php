<?php
session_start();
include('koneksi/koneksi.php');
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
    <!-- am chart export.css -->
    <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <?php
    include('koneksi/koneksi.php');
    ?>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
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
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <?php
                                            $now_date = date("Y-m-d");
                                            $now_month = date("m");
                                            $now_year = date("Y");

                                            $critical = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(part_no) as critical_stock FROM stock_all sa WHERE sa.qty < sa.std_stock"));
                                            $over = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(part_no) as over_stock FROM stock_all sa WHERE sa.qty > sa.std_stock"));
                                            $total_item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(part_no) as total_item FROM list_part"));
                                            $total_stock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(qty) as total_stock FROM stock_all sa WHERE tgl_updated"));

                                            $critical_stock = $critical['critical_stock'];
                                            $over_stock = $over['over_stock'];
                                            $total_item = $total_item['total_item'];
                                            $total_stock = $total_stock['total_stock'];
                                            ?>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h3 class="text-c-purple"><?php echo $total_item ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <!-- <img class="img-40" src="assets\images\plan.png" alt=""> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Item</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h3 class="text-c-green"><?php echo $total_stock ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <!-- <img class="img-40" src="assets\images\ach.png" alt=""> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Stock</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h3 class="text-c-red"><?php echo $critical_stock ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <!-- <img class="img-40" src="assets\images\act.png" alt=""> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-red">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Critical Stock</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card" data-toggle="modal" data-target="#minus_item" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Tampilkan Minus Delivery">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h3 class="text-c-blue"><?php echo $over_stock ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <!-- <img class="img-40" src="assets\images\minus.png" alt=""> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Over stock</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->
                                            <!-- data stock -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <h5 class="no_deliv">
                                                                        Data Stock
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="tab-content tabs card-block">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered text-center critical autofit" id="stock_all">
                                                                    <thead>
                                                                        <tr style="text-align: center;">
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;NO&nbsp;</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">WH&nbsp;&nbsp;</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;CUSTOMER&nbsp;</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;PART NO&nbsp;</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">PART NAME&nbsp;&nbsp;</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;TOTAL STOCK&nbsp;</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;DELIV/DAY&nbsp;</th>
                                                                            <th style="width: 30px;" colspan="2" class="text-center" style="vertical-align: middle;">STOCK FG&nbsp;&nbsp;</th>
                                                                            <th style="width: 115px;" colspan="2" class="text-center" style="vertical-align: middle;">STOCK WIP</th>
                                                                            <th style="width: 30px;" colspan="2" class="text-center" style="vertical-align: middle;">&nbsp;STD STOCK</th>
                                                                            <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;ACTION&nbsp;</th>
                                                                        </tr>
                                                                        <tr style="text-align: center;">
                                                                            <th style="width: 15.2125px;" class="text-center" style="vertical-align: middle;">&nbsp;PCS</th>
                                                                            <th style="width: 14.7875px;" class="text-center" style="vertical-align: middle;">&nbsp;DAYS</th>
                                                                            <th style="width: 115px;" class="text-center" style="vertical-align: middle;">RM</th>
                                                                            <th style="width: 115px;" class="text-center" style="vertical-align: middle;">PRODUKIS</th>
                                                                            <th style="width: 15px;" class="text-center" style="vertical-align: middle;">&nbsp;PCS</th>
                                                                            <th style="width: 15px;" class="text-center" style="vertical-align: middle;">BALANCE</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $all_stock_data = mysqli_query($conn, "WITH RankedData AS (
                                                                            SELECT
                                                                                DENSE_RANK() OVER (PARTITION BY sar.part_no ORDER BY sa.tgl_updated DESC) AS rnk,
                                                                                ar.nama_area AS wh,
                                                                                cs.customer,
                                                                                pp.part_no,
                                                                                lp.part_name,
                                                                                sa.id,
                                                                                sa.qty AS total_stock,
                                                                                sa.del_day AS deliv_day,
                                                                                MAX(CASE WHEN sar.kategori = 1 THEN COALESCE(sar.current_stock, 0) END) AS stock_fg,
                                                                                MAX(CASE WHEN sar.kategori = 2 THEN COALESCE(sar.current_stock, 0) END) AS wip_rm,
                                                                                MAX(CASE WHEN sar.kategori = 3 THEN COALESCE(sar.current_stock, 0) END) AS wip_produksi,
                                                                                sa.std_stock AS std_stok,
                                                                                '' AS action -- You had an extra pair of single quotes without any value here, not sure if you intended to put something
                                                                            FROM 
                                                                                list_part lp
                                                                                LEFT JOIN stock_all sa ON sa.part_no = lp.part_no 
                                                                                LEFT JOIN stock sar ON sar.part_no = lp.part_no AND sar.kategori IN (1, 2, 3) 
                                                                                LEFT JOIN kategori_stock ks ON ks.id = sar.kategori
                                                                                LEFT JOIN part_prod pp ON lp.part_no = pp.part_no
                                                                                LEFT JOIN customer_prod cs ON pp.customer_id = cs.id
                                                                                LEFT JOIN area ar ON ar.id = pp.id_area
                                                                            GROUP BY
                                                                                sar.part_no,
                                                                                ar.nama_area,
                                                                                cs.customer,
                                                                                pp.part_no,
                                                                                lp.part_name,
                                                                                sa.id,
                                                                                sa.qty,
                                                                                sa.del_day,
                                                                                sa.std_stock,
                                                                                sa.remark,
                                                                                sa.tgl_updated
                                                                        )
                                                                        
                                                                        SELECT *
                                                                        FROM RankedData
                                                                        WHERE rnk = 1 
                                                                        ORDER BY total_stock DESC");

                                                                        $no_min = 1;
                                                                        foreach ($all_stock_data as $data_stock) {
                                                                            $wh_name = $data_stock['wh'];
                                                                            $id_stock = $data_stock['id'];
                                                                            $cust_name = $data_stock['customer'];
                                                                            $part_no_all = $data_stock['part_no'];
                                                                            $part_name_all = $data_stock['part_name'];
                                                                            $total_stock = $data_stock['total_stock'];
                                                                            $fg_stock = $data_stock['stock_fg'];
                                                                            $rm_stock = $data_stock['wip_rm'];
                                                                            $prod_stock = $data_stock['wip_produksi'];
                                                                            $del_day = $data_stock['deliv_day'];
                                                                            $std_stock = $data_stock['std_stok'];
                                                                            $bal_std = $total_stock - $std_stock;
                                                                            // Menghindari pembagian 0/0
                                                                            $stock_day = ($del_day != 0) ? $fg_stock / $del_day : 0;
                                                                            $stock_day = round($stock_day, 1);
                                                                            // Menangani kasus pembagian 0/0
                                                                            if ($del_day == 0 && $stock_day != 0) {
                                                                                $del_day = 0; // Atau berikan nilai atau pesan yang sesuai
                                                                            }
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $no_min; ?></td>
                                                                                <td><?php echo $wh_name; ?></td>
                                                                                <td><?php echo $cust_name; ?></td>
                                                                                <td><?php echo $part_no_all; ?></td>
                                                                                <td><?php echo $part_name_all; ?></td>
                                                                                <td><?php echo $total_stock; ?></td>
                                                                                <td><?php echo $del_day; ?></td>
                                                                                <td><?php echo $fg_stock; ?></td>
                                                                                <td><?php echo $stock_day; ?></td>
                                                                                <td><?php echo $rm_stock; ?></td>
                                                                                <td><?php echo $prod_stock; ?></td>
                                                                                <td><?php echo $std_stock; ?></td>
                                                                                <td><?php echo $bal_std; ?></td>
                                                                                <td><button type='button' class='btn btn-icon btn-success btn-circle btn-sm edit_stock' data-toggle='modal' data-idstockall="<?= $id_stock ?> " data-idnoall="<?= $part_no_all ?>" data-namaall="<?= $part_name_all ?>" data-qtydelivall="<?= $del_day ?>" data-qtystdall="<?= $std_stock ?>" data-target='#editStock'>
                                                                                        EDIT
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                            $no_min++;
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
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

    <!-- Modal setting stock-->
    <div class="modal fade" id="editStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update_stock_all.php" method="post">
                        <div class="form-row">
                            <input type="hidden" id="id_stock_all" name="id_stock_all">
                            <div class="form-group col-md-12">
                                <label for="Nama">Part No :</label>
                                <input type="text" id="part_no_all" class="form-control" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Nama">Part Name </label>
                                <input type="text" id="part_name_all" class="form-control" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Nama">Del/day :</label>
                                <input type="text" name="del_day_all" id="del_day_all" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Nama">Std stock : </label>
                                <input type="text" name="std_stock_all" id="std_stock_all" class="form-control">
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

    <!-- Required Jquery -->
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
    <link rel="stylesheet" href="assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.css">
    <script src="assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="assets/js/chart.js/Chart.js"></script>
    <!-- apex -->
    <script src="assets/js/apex.js/cdn.jsdelivr.net_npm_apexcharts"></script>
    <!-- apex -->
    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/script.js "></script>

    <!-- datatables -->
    <script type="text/javascript">
        $(document).ready(function() {
            new DataTable('.critical', {
                // scrollX: true,
                // scrollY: 400
            });
            $('.datas').DataTable();
        });
    </script>
    <!-- datatables -->

    <script>
        var options = {
            series: [{
                name: 'plan',
                type: 'column',
                data: [
                    <?php
                    if (isset($_POST['bln_filter']) and isset($_POST['thn_filter'])) {
                        $bln_filter = $_POST['bln_filter'];
                        $thn_filter = $_POST['thn_filter'];

                        $deliv_tgl = mysqli_query($conn, "SELECT p.tgl,
                                                                    SUM(plan) AS planing,
                                                                    SUM(
                                                                        CASE
                                                                            WHEN p.tgl <= p.tgl_kirim THEN
                                                                                (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery)
                                                                            ELSE 0
                                                                        END
                                                                    ) AS actual
                                                                FROM plan p
                                                                LEFT JOIN customer_deliv cd ON cd.id = p.id_customer
                                                                LEFT JOIN surat_jalan sj ON sj.no_delivery = p.no_delivery
                                                                WHERE MONTH(tgl) = '$bln_filter' AND YEAR(tgl) = '$thn_filter'
                                                                GROUP BY p.tgl
                                                                ORDER BY p.tgl ASC");
                    } else {
                        $deliv_tgl = mysqli_query($conn, "SELECT p.tgl,
                                                                    SUM(plan) AS planing,
                                                                    SUM(
                                                                        CASE
                                                                            WHEN p.tgl <= p.tgl_kirim THEN
                                                                                (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery)
                                                                            ELSE 0
                                                                        END
                                                                    ) AS actual
                                                                FROM plan p
                                                                LEFT JOIN customer_deliv cd ON cd.id = p.id_customer
                                                                LEFT JOIN surat_jalan sj ON sj.no_delivery = p.no_delivery
                                                                WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl) = '$now_year' AND tgl <'$now_date'
                                                                GROUP BY p.tgl
                                                                ORDER BY p.tgl ASC");
                    }
                    $planing_data = [];
                    foreach ($deliv_tgl as $data_tgl) {
                        $planing_data[] = $data_tgl['planing'];
                    }
                    echo implode(",", $planing_data);
                    ?>
                ]
            }, {
                name: 'actual',
                type: 'column',
                data: [<?php
                        $actual_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual_data[] = $data_tgl['actual'];
                        }
                        echo implode(",", $actual_data);
                        ?>]
            }, {
                name: 'achievement',
                type: 'line',
                data: [<?php
                        $ach_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual = $data_tgl['actual'];
                            $plan_tgl = $data_tgl['planing'];
                            if ($plan_tgl == 0) {
                                $achtotal = "0";
                            } else {
                                $achtotal = ($actual / $plan_tgl) * 100;
                                $achtotal = round($achtotal, 2);
                            }
                            $ach_data[] = $achtotal;
                        }
                        echo implode(",", $ach_data);
                        ?>]
            }, {
                name: 'target (100%)',
                type: 'line',
                data: [<?php
                        foreach ($deliv_tgl as $data_tgl) {
                            echo "100" . ",";
                        }
                        ?>]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                zoom: false,
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        orientation: 'vertical',
                        position: 'center' // bottom/center/top
                    }
                }
            },
            dataLabels: {
                style: {
                    colors: ['#E74C3C']
                },
                offsetY: 15, // play with this value
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [0, 1, 2], // Aktifkan dataLabels untuk seri "Achievement" (indeks 2)
                textAnchor: 'start',
                textOrientation: 'vertical',
                formatter: function(val, opts) {
                    if (opts.seriesIndex === 2) { // Hanya format label untuk series "ach"
                        if (val % 1 === 0) {
                            return val.toString() + "%"; // Jika bilangan bulat, kembalikan tanpa desimal
                        } else {
                            return val.toFixed(2) + "%"; // Jika desimal, tampilkan satu angka desimal
                        }
                    }
                    return val;
                },
                background: {
                    enabled: true,
                    foreColor: '#000', // Text color for the data labels
                    padding: 3, // Adjust the padding as needed
                    borderRadius: 2, // Adjust the border radius as needed
                    borderWidth: 2, // Adjust the border width as needed
                    borderColor: '', // Set the border color to match the series color
                },
                textAnchor: 'start',
                style: {
                    fontSize: '11px',
                    fontFamily: 'Helvetica, Arial, sans-serif',
                    fontWeight: 'bold',
                    colors: undefined
                },
            },
            stroke: {
                width: [1, 1, 4, 4]
            },
            title: {
                text: 'Delivery Perfomance <?php if (isset($_POST['bln_filter']) and isset($_POST['thn_filter'])) {
                                                $bln_filter = $_POST['bln_filter'];
                                                $bln_old = DateTime::createFromFormat('!m', $bln_filter);
                                                $bln_new = $bln_old->format('F');

                                                echo $bln_new . ' ' . $_POST['thn_filter'];
                                            } else {
                                                echo date("F") . ' ' . $now_year;
                                            }
                                            ?>',
                align: 'left',
                offsetX: 0
            },
            xaxis: {
                categories: [
                    <?php
                    foreach ($deliv_tgl as $data_tgl) {
                        $tgl_deliv = $data_tgl['tgl'];
                        echo "'" . $tgl_deliv . "'" . ",";
                    }
                    ?>
                ],
            },
            yaxis: [{
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        }
                    },
                    title: {
                        text: "Total quantity (pcs)",
                        style: {
                            color: '#008FFB',
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                {
                    seriesName: 'plan',
                    opposite: true,
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            colors: '#00E396',
                        }
                    },
                    title: {
                        text: "act qty",
                        style: {
                            color: '#00E396',
                        }
                    },
                    show: false
                },
                {
                    seriesName: 'achievement',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            colors: '#FEB019',
                        },
                    },
                    title: {
                        text: "Delivery achievement (100%)",
                        style: {
                            color: '#FEB019',
                        }
                    },
                    show: true
                },
                {
                    seriesName: 'achievement',
                    opposite: false,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#E74C3C'
                    },
                    labels: {
                        style: {
                            colors: '#E74C3C',
                        },
                    },
                    title: {
                        text: "target (100%)",
                        style: {
                            color: '#E74C3C',
                        }
                    },
                    show: false
                }
            ],
            tooltip: {
                fixed: {
                    enabled: true,
                    position: 'topLeft',
                    offsetY: 30,
                    offsetX: 60
                },
                y: {
                    formatter: function(val, opts) {
                        if (opts.seriesIndex === 2 || opts.seriesIndex === 3) {
                            if (val % 1 === 0) {
                                return val.toFixed(0) + "%";
                            } else {
                                return val.toFixed(1) + "%";
                            }
                        }
                        return val;
                    }
                },
                enabledOnSeries: [0, 1, 2],
            },
            legend: {
                horizontalAlign: 'left',
                offsetX: 40
            },
            redrawOnParentResize: true
        };
        var chart = new ApexCharts(document.querySelector("#chartAch"), options);
        chart.render();
    </script>
    <!-- deliv statistik -->

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

    <script>
        function editData(1) {
            // Panggil modal edit menggunakan Ajax
            $.ajax({
                url: 'edit_stock.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#editModal').html(response);
                    $('#editModal').modal('show');
                }
            });
        }

        // Submit form edit menggunakan Ajax
        $('#editForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'update_data.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#editModal').modal('hide');
                    // Refresh halaman setelah berhasil mengedit data
                    location.reload();
                }
            });
        });
    </script>
    <!-- js tooltip -->

    <script>
        var table = $('#stok_data').DataTable({
            "ajax": 'stock_data.php?',
        })

        $('#stok_data').on('click', '.edit', function() {
            var id = this;
            var id1 = $(this).data('id');
            $('#part_no_data').val(id1);

            var id2 = $(this).data('nama');
            $('#part_name_data').val(id2);

            var id3 = $(this).data('idstock');
            $('#stock_id').val(id3);
        })

        $('#stock_all').on('click', '.edit_stock', function() {
            var id = this;
            var id1 = $(this).data('idstockall');
            $('#id_stock_all').val(id1);

            var id2 = $(this).data('idnoall');
            $('#part_no_all').val(id2);

            var id3 = $(this).data('namaall');
            $('#part_name_all').val(id3);

            var id4 = $(this).data('qtydelivall');
            $('#del_day_all').val(id4);

            var id5 = $(this).data('qtystdall');
            $('#std_stock_all').val(id5);
        })
    </script>

</body>

</html>