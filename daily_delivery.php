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
                                            if (isset($_POST['bln_filter']) and isset($_POST['thn_filter'])) {
                                                $bln_filter = $_POST['bln_filter'];
                                                $thn_filter = $_POST['thn_filter'];

                                                $total_del_acm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT  SUM(plan) AS plan_total,
                                                                                                                    SUM(
                                                                                                                        CASE
                                                                                                                            WHEN p.tgl = p.tgl_kirim THEN
                                                                                                                                (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery)
                                                                                                                            ELSE 0
                                                                                                                        END
                                                                                                                    ) AS act_total
                                                                                                                    FROM plan p 
                                                                                                            
                                                                                                                    LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
                                                                                                                    WHERE MONTH(tgl) = '$bln_filter' AND YEAR(tgl) = '$thn_filter' AND tgl!='$now_date'"));

                                                $mindel = mysqli_query($conn, "SELECT ar.nama_area,
                                                                                        cs.customer,
                                                                                        p.part_no,
                                                                                        lp.part_name,
                                                                                        SUM(p.plan) as minus
                                                                                        from plan p 
                                                                                        left join customer_deliv cs on cs.id=p.id_customer
                                                                                        left join area ar on ar.id = cs.id_area
                                                                                        join list_part lp on p.part_no = lp.part_no
                                                                                        WHERE (p.tgl != p.tgl_kirim OR p.tgl_kirim IS NULL) AND tgl!='$now_date' 
                                                                                        GROUP BY p.part_no, p.id_customer
                                                                                       ORDER BY cs.customer ASC");
                                            } else {
                                                $total_del_acm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT  SUM(plan) AS plan_total,
                                                                                                                    SUM(
                                                                                                                        CASE
                                                                                                                            WHEN p.tgl = p.tgl_kirim THEN
                                                                                                                                (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery)
                                                                                                                            ELSE 0
                                                                                                                        END
                                                                                                                    ) AS act_total
                                                                                                                    FROM plan p 
                                                                                                                    LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
                                                                                                                    WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl) = '$now_year' AND tgl!='$now_date'"));

                                                $mindel = mysqli_query($conn, "SELECT ar.nama_area,
                                                                                        cs.customer,
                                                                                        p.part_no,
                                                                                        lp.part_name,
                                                                                        SUM(p.plan) as minus
                                                                                        from plan p 
                                                                                        left join customer_deliv cs on cs.id=p.id_customer
                                                                                        left join area ar on ar.id = cs.id_area
                                                                                        join list_part lp on p.part_no = lp.part_no
                                                                                        WHERE (p.tgl != p.tgl_kirim OR p.tgl_kirim IS NULL) AND tgl!='$now_date' 
                                                                                        GROUP BY p.part_no, p.id_customer
                                                                                    ORDER BY cs.customer ASC");
                                            }
                                            $total_plan1 = $total_del_acm['plan_total'];
                                            $total_act1 = $total_del_acm['act_total'];
                                            $total_min1 = $total_plan1 - $total_act1;

                                            if ($total_act1 == null) {
                                                $achtotal = "0";
                                            } else {
                                                $achtotal = ($total_act1 / $total_plan1) * 100;
                                                $achtotal = round($achtotal, 1);
                                            }
                                            ?>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h3 class="text-c-purple"><?php echo $total_plan1 ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <img class="img-40" src="assets\images\plan.png" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Plan</p>
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
                                                                <h3 class="text-c-green"><?php echo $total_act1 ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <img class="img-40" src="assets\images\act.png" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Actual</p>
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
                                                                <h3 class="text-c-red"><?php echo $total_min1 ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <img class="img-40" src="assets\images\minus.png" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-red">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Minus</p>
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
                                                                <h3 class="text-c-blue"><?php echo $achtotal . "%" ?></h3>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <img class="img-40" src="assets\images\ach.png" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Achievement</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->
                                            <!--  plan vs act deliv -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <form action="" method="post">
                                                            <div class="form-group row">
                                                                <div class="col-sm-3">
                                                                    <select id="bln_filter" name="bln_filter" class="form-control">
                                                                        <?php
                                                                        $filterBulan = isset($_POST['bln_filter']) ? $_POST['bln_filter'] : ''; // Ganti $_POST dengan sumber data yang sesuai

                                                                        // Tambahkan opsi "Pilih Bulan" sebagai default jika tidak ada filter yang dipilih
                                                                        echo '<option value=""' . ($filterBulan == '' ? ' selected="selected"' : '') . '>Pilih Bulan</option>';

                                                                        // Dapatkan bulan sekarang dalam format MM (01-12)
                                                                        $currentMonth = date('m');

                                                                        // Loop untuk menampilkan opsi bulan
                                                                        for ($i = 1; $i <= 12; $i++) {
                                                                            $monthValue = str_pad($i, 2, '0', STR_PAD_LEFT); // Format menjadi dua digit (01-09)
                                                                            echo '<option value="' . $monthValue . '"' . ($filterBulan == $monthValue ? ' selected="selected"' : ($currentMonth == $monthValue && $filterBulan == '' ? ' selected="selected"' : '')) . '>' . date('F', mktime(0, 0, 0, $i, 1)) . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>

                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <select name='thn_filter' class="form-control" id="inlineFormCustomSelect">
                                                                        <?php
                                                                        $mulai = date('Y') - 5;
                                                                        $filterTahun = isset($_POST['thn_filter']) ? $_POST['thn_filter'] : ''; // Ganti $_POST dengan sumber data yang sesuai

                                                                        for ($i = $mulai; $i < $mulai + 3; $i++) {
                                                                            $sel = $i == $filterTahun ? ' selected="selected"' : '';
                                                                            echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                                                        }

                                                                        // Tambahkan opsi "Tahun Sekarang" jika filternya adalah tahun sekarang
                                                                        $tahunSekarang = date('Y');
                                                                        $selectedDefault = ($filterTahun == '' || $filterTahun == $tahunSekarang) ? ' selected="selected"' : '';
                                                                        echo '<option value="' . $tahunSekarang . '"' . $selectedDefault . '>' . $tahunSekarang . '</option>';
                                                                        ?>
                                                                    </select>


                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <button type="submit" class="btn btn-info btn-round text-dark"><i class="ti-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="chartAch" style="height: 400px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  plan vs act deliv -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <h5 class="no_deliv">
                                                                        Minus Delivery
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered datas">
                                                                <thead>
                                                                    <th>NO</th>
                                                                    <th>WAREHOUSE</th>
                                                                    <th>CUSTOMER</th>
                                                                    <th>PART NO FLN</th>
                                                                    <th>PART NAME</th>
                                                                    <th>QTY MINUS</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no_min = 1;
                                                                    foreach ($mindel as $data_minus) {
                                                                        $min_nama_area = $data_minus['nama_area'];
                                                                        $min_customer = $data_minus['customer'];
                                                                        $min_part_no = $data_minus['part_no'];
                                                                        $min_part_name = $data_minus['part_name'];
                                                                        $min_plan = $data_minus['minus'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $no_min; ?></td>
                                                                            <td><?php echo $min_nama_area; ?></td>
                                                                            <td><?php echo $min_customer; ?></td>
                                                                            <td><?php echo $min_part_no; ?></td>
                                                                            <td><?php echo $min_part_name; ?></td>
                                                                            <td><?php echo "-" . $min_plan; ?></td>
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
                                            <!--  plan vs act deliv -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <h5 class="no_deliv">
                                                                        Current Stock in FG
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered text-center" id="stok_data">
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
                                                                        <th style="width: 28px;" colspan="2" class="text-center" style="vertical-align: middle;">&nbsp;PLAN DELIVERY</th>
                                                                        <th style="width: 30px;" colspan="2" class="text-center" style="vertical-align: middle;">&nbsp;STD STOCK</th>
                                                                        <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;REMARK</th>
                                                                        <th style="width: 15px; vertical-align: middle;" rowspan="2" class="text-center">&nbsp;ACTION&nbsp;</th>
                                                                    </tr>
                                                                    <tr style="text-align: center;">
                                                                        <th style="width: 15.2125px;" class="text-center" style="vertical-align: middle;">&nbsp;PCS</th>
                                                                        <th style="width: 14.7875px;" class="text-center" style="vertical-align: middle;">&nbsp;DAYS</th>
                                                                        <th style="width: 115px;" class="text-center" style="vertical-align: middle;">PRODUKIS</th>
                                                                        <th style="width: 115px;" class="text-center" style="vertical-align: middle;">RM</th>
                                                                        <th style="width: 18px;" class="text-center" style="vertical-align: middle;">&nbsp;PLAN</th>
                                                                        <th style="width: 10px;" class="text-center" style="vertical-align: middle;">&nbsp;BALANCE</th>
                                                                        <th style="width: 15px;" class="text-center" style="vertical-align: middle;">&nbsp;PCS</th>
                                                                        <th style="width: 15px;" class="text-center" style="vertical-align: middle;">BALANCE</th>
                                                                    </tr>
                                                                </thead>
                                                                <!-- Your table body goes here -->
                                                            </table>
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

    <!-- Modal edit stock-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
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
                                <label for="Nama">Standar Stock</label>
                                <input type="text" name="std_edit" id="std_data" class="form-control form-control-round">
                            </div>
                            <!-- <div class="form-group col-md-12">
                                <label for="Nama">Current Stock</label>
                                <input type="text" name="stock_edit" id="stock_data" class="form-control form-control-round">
                            </div> -->
                            <div class="form-group col-md-12">
                                <label for="Nama">Delivery/Day</label>
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
            $('.datas').DataTable();
        });
    </script>
    <!-- datatables -->

    <script>
        var options = {
            series: [{
                name: 'plan',
                type: 'column',
                data: [<?php
                        if (isset($_POST['bln_filter']) and isset($_POST['thn_filter'])) {
                            $bln_filter = $_POST['bln_filter'];
                            $thn_filter = $_POST['thn_filter'];

                            $deliv_tgl = mysqli_query($conn, "SELECT p.tgl,
                                                                    SUM(plan) AS planing,
                                                                    SUM(
                                                                        CASE
                                                                            WHEN p.tgl = p.tgl_kirim THEN
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
                                                                            WHEN p.tgl = p.tgl_kirim THEN
                                                                                (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery)
                                                                            ELSE 0
                                                                        END
                                                                    ) AS actual
                                                                FROM plan p
                                                                LEFT JOIN customer_deliv cd ON cd.id = p.id_customer
                                                                LEFT JOIN surat_jalan sj ON sj.no_delivery = p.no_delivery
                                                                WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl) = '$now_year' AND tgl!='$now_date'
                                                                GROUP BY p.tgl
                                                                ORDER BY p.tgl ASC");
                        }
                        $planing_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $planing_data[] = $data_tgl['planing'];
                        }
                        echo implode(",", $planing_data);
                        ?>]
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
                                $achtotal = round($achtotal, 1);
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
                            $actual = $data_tgl['actual'];
                            $plan_tgl = $data_tgl['planing'];
                            if ($plan_tgl == 0) {
                                $achtotal = "0";
                            } else {
                                $achtotal = ($actual / $plan_tgl) * 100;
                                $achtotal = round($achtotal, 1);
                            }
                            $ach_data = $achtotal;
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
                            return val.toFixed(1) + "%"; // Jika desimal, tampilkan satu angka desimal
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
                categories: [<?php
                                foreach ($deliv_tgl as $data_tgl) {
                                    $tgl_deliv = $data_tgl['tgl'];
                                    echo "'" . $tgl_deliv . "'" . ",";
                                }
                                ?>],
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
                    position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                    offsetY: 30,
                    offsetX: 60
                },
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
        })

        $('#stok_data').on('click', '.edit', function() {
            var id = this;
            var id2 = $(this).data('nama');
            $('#part_name_data').val(id2);
        })

        $('#stok_data').on('click', '.edit', function() {
            var id = this;
            var id1 = $(this).data('qtystock');

            $('#stock_data').val(id1);
        })

        $('#stok_data').on('click', '.edit', function() {
            var id = this;
            var id2 = $(this).data('qtydeliv');
            $('#deliv_data').val(id2);
        })

        $('#stok_data').on('click', '.edit', function() {
            var id = this;
            var id1 = $(this).data('qtystd');

            $('#std_data').val(id1);
        })
    </script>

</body>

</html>