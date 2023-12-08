<!DOCTYPE html>
<html lang="en">
<?php 
session_start(); 
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
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-body start -->
                                <div class="page-body">  
                                    <div class="row"> 
                                        <div class="col-xl-4 col-md-4" id="acm_del">
                                            <div class="card">
                                                <div class="card-block" >
                                                    <div class="row align-items-center text-center" >
                                                        <?php
                                                            // SCAN PART FLN
                                                                    // if(isset($_POST['no_deliv']) AND isset($_POST['part_fln_scan'])){
                                                                    //     $part_fln_scan = $_POST['part_fln_scan'];
                                                                    //     $no_delivery = $_POST['no_deliv'];
                                                                    //     // pecah part no dan qty                                 
                                                                    //     $qr_part_no = explode("/",$part_fln_scan);
                                                                    //     // pecah part no dan qty 
                                                                        
                                                                    //     // compare aktual vs plan
                                                                    //     $qty = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT part_no,
                                                                    //                                                             plan, 
                                                                    //                                                             (SELECT SUM(qty) FROM prepare pr WHERE  pr.part_no_prep = p.part_no
                                                                    //                                                                                                 AND pr.no_delivery=p.no_delivery) 
                                                                    //                                                             AS act,
                                                                    //                                                             id_customer
                                                                    //                                                             FROM plan p 
                                                                    //                                                             where no_delivery='$no_delivery' AND part_no='$qr_part_no[0]'"));
                                                                    //     // compare aktual vs plan
                                                                            
                                                                    //     $part_fln_db = $qty['part_no'];
                                                                    //     $id_customer = $qty['id_customer'];   
                                                                    //     $plan = $qty['plan'];
                                                                    //     $act = $qty['act']+$qr_part_no[1];  
                                                                        
                                                                    //     // cek scan label customer
                                                                    //     $cst_deliv = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT scan, customer FROM customer_deliv where id=$id_customer"));
                                                                    //     $cus = $cst_deliv['scan']; 
                                                                    //     $cust = $cst_deliv['customer'];
                                                                    //     // cek scan label customer

                                                                    //     // create id primary key
                                                                    //     $date_now = date("Y-m-d H:i:s");
                                                                    //     $id_primary = strtotime($date_now)."$cust";
                                                                    //     // create id primary key

                                                                    //     if($part_fln_scan==NULL){
                                                                    //     echo '<script language="javascript">
                                                                    //                 swal.fire({
                                                                    //                     title: "Error!",
                                                                    //                     text: "Part Number Not Found",
                                                                    //                     icon:"error",
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_fln_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     }else if($part_fln_db==$qr_part_no[0] AND $cus=='no' AND $act>$plan){
                                                                    //     echo '<script language="javascript">
                                                                    //             swal.fire({
                                                                    //                 title: "Error!",
                                                                    //                 text: "Prepare Close / Over Qty",
                                                                    //                 icon: "error",
                                                                    //             }).then(function(){
                                                                    //                 document.getElementById("part_fln_scan").focus();
                                                                    //                 });
                                                                    //             </script>';
                                                                                
                                                                    //     }else if($part_fln_db==$qr_part_no[0] AND $cus=='no' AND $act<=$plan){
                                                                    //     // tambahkan ke database    
                                                                    //     $add = mysqli_query($conn,"INSERT INTO prepare (id_prep,part_no_prep,qty,no_delivery) VALUES ('$id_primary','$qr_part_no[0]','$qr_part_no[1]','$no_delivery')"); 
                                                                    //     echo '<script language="javascript">
                                                                    //             swal.fire({
                                                                    //                 title: "Success",
                                                                    //                 text: "Scan QR label Complete",
                                                                    //                 icon: "success",
                                                                    //                 timer: 1500
                                                                    //             }).then(function(){
                                                                    //                 document.getElementById("part_fln_scan").focus();
                                                                    //                 });
                                                                    //             </script>';
                                                                    //     }else if($part_fln_db!=$qr_part_no[0]){
                                                                    //     echo '<script language="javascript">
                                                                    //                 swal.fire({
                                                                    //                     title: "Error!",
                                                                    //                     text: "Part Number FLN Tidak Cocok",
                                                                    //                     icon:"error",
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_fln_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     }else if($qr_part_no[0]==NULL AND $cus=='yes'){
                                                                    //     echo '<script language="javascript">
                                                                    //                 swal.fire({
                                                                    //                     title: "Error!",
                                                                    //                     text: "Part Number Not Found",
                                                                    //                     icon:"error",
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_fln_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     }else if($part_fln_db==$qr_part_no[0] AND $cus=='yes' AND $act>$plan){
                                                                    //     echo '<script language="javascript">
                                                                    //             swal.fire({
                                                                    //                 title: "Error!",
                                                                    //                 text: "Prepare Close",
                                                                    //                 icon: "error",
                                                                    //             }).then(function(){
                                                                    //                 document.getElementById("part_fln_scan").focus();
                                                                    //                 });
                                                                    //             </script>';
                                                                    //     }else if($part_fln_db==$qr_part_no[0] AND $cus=='yes'){
                                                                    //     echo '<script language="javascript">
                                                                    //                 swal.fire({
                                                                    //                     title: "Success",
                                                                    //                     text: "Scan QR label Complete",
                                                                    //                     icon: "success",
                                                                    //                     timer: 1500
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_cst_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     }else if($part_fln_db!=$qr_part_no[0] AND $cus=='yes'){
                                                                    //     echo '<script language="javascript">
                                                                    //                 swal.fire({
                                                                    //                     title: "Error!",
                                                                    //                     text: "Part Number FLN Tidak Cocok",
                                                                    //                     icon:"error",
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_fln_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     };
                                                                    // } 
                                                            // SCAN PART FLN
                                                            
                                                            // SCAN PART CST
                                                                    // if(isset($_POST['no_deliv1']) AND isset($_POST['part_fln_scan1']) AND isset($_POST['part_cst_scan'])){
                                                                    //     $no_delivery1 = $_POST['no_deliv1'];
                                                                    //     $part_fln_scan1 = $_POST['part_fln_scan1'];
                                                                    //     $part_cst_scan = $_POST['part_cst_scan'];                                 
                                                                    //     $qr_part_no1 = explode("/",$part_fln_scan1);

                                                                    //     // ambil id customer
                                                                    //     $id_cs = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT id_customer FROM plan 
                                                                    //                                                                             where part_no='$qr_part_no1[0]' 
                                                                    //                                                                             AND no_delivery='$no_delivery1'"));

                                                                    //     $id_customer = $id_cs['id_customer']; 
                                                                    //     // ambil id customer

                                                                    //     // Cek part no
                                                                    //     $part_no_db2 = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT part_no_cst FROM part_deliv where part_no='$qr_part_no1[0]' AND customer_id=$id_customer"));
                                                                    //     $part_cst_db = $part_no_db2['part_no_cst'];
                                                                    //     // Cek part no

                                                                    //     // create id primary key
                                                                    //     $cst_deliv1 = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT customer FROM customer_deliv where id=$id_customer"));
                                                                    //     $cust1 = $cst_deliv1['customer'];
                                                                    //     $date_now = date("Y-m-d H:i:s");
                                                                    //     $id_primary1 = strtotime($date_now)."$cust1";
                                                                    //     // create id primary key

                                                                    //     if($part_cst_db==$part_cst_scan){
                                                                    //     // tambahkan ke database    
                                                                    //     $add = mysqli_query($conn,"INSERT INTO prepare (id_prep,part_no_prep,qty,no_delivery) VALUES ('$id_primary1','$qr_part_no1[0]','$qr_part_no1[1]','$no_delivery1')"); 
                                                                    //     echo '<script>
                                                                    //                 swal.fire({
                                                                    //                     title: "Success",
                                                                    //                     text: "Scan QR label Complete",
                                                                    //                     icon: "success",
                                                                    //                     timer: 1500
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_fln_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     }else{
                                                                    //     echo '<script>
                                                                    //                 swal.fire({
                                                                    //                     title: "Error!",
                                                                    //                     text: "Part Number Customer Tidak Cocok",
                                                                    //                     icon:"error",
                                                                    //                 }).then(function(){
                                                                    //                     document.getElementById("part_fln_scan").focus();
                                                                    //                     });
                                                                    //             </script>';
                                                                    //     };
                                                                    // }
                                                            // SCAN PART CST
                                                        ?>

                                                        <?php
                                                            $now_date = date("Y-m-d");

                                                            if(isset($_GET ['cst_filter']) AND !isset($_GET ['cycle_filter']) AND !isset($_GET['tgl'])){
                                                                $cust = $_GET ['cst_filter'];

                                                                mysqli_query($conn,"CREATE TEMPORARY TABLE act_deliv_cs SELECT 
                                                                                                                cd.customer,
                                                                                                                SUM(plan) as plan,
                                                                                                                sum((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                                                                        AND pr.no_delivery=p.no_delivery))
                                                                                                                as actual
                                                                                                                FROM plan p
                                                                                                                inner join customer_deliv cd on cd.id=p.id_customer
                                                                                                                left join cycle_deliv jam on jam.id=p.id_cycle
                                                                                                                WHERE jam.no_ct=1 AND p.id_customer=$cust AND p.tgl='$now_date'");
                                                            }if(isset($_GET ['cst_filter']) AND isset($_GET ['cycle_filter']) AND !isset($_GET['tgl'])){
                                                                $cust = $_GET ['cst_filter'];
                                                                $cycle = $_GET ['cycle_filter'];

                                                                mysqli_query($conn,"CREATE TEMPORARY TABLE act_deliv_cs SELECT 
                                                                                                                        cd.customer,
                                                                                                                        SUM(plan) as plan,
                                                                                                                        sum((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                                                                                AND pr.no_delivery=p.no_delivery))
                                                                                                                        as actual
                                                                                                                        FROM plan p
                                                                                                                        inner join customer_deliv cd on cd.id=p.id_customer
                                                                                                                        WHERE p.id_cycle=$cycle AND p.id_customer=$cust AND p.tgl='$now_date'");

                                                            }else if(isset($_GET['no_filter'])){ 
                                                                $no_deliv = $_GET ['no_filter'];

                                                                mysqli_query($conn,"CREATE TEMPORARY TABLE act_deliv_cs SELECT cd.customer,                                                                       
                                                                                                                                SUM(plan) as plan,
                                                                                                                                sum((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                                                                                            AND pr.no_delivery=p.no_delivery))
                                                                                                                                as actual
                                                                                                                            FROM plan p 
                                                                                                                            inner join customer_deliv cd on cd.id=p.id_customer
                                                                                                                            WHERE p.no_delivery='$no_deliv' GROUP by `id_customer`");
                                                            }
                                                            
                                                            $acm_cs = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT * from act_deliv_cs"));
                                                            
                                                            $cust_cs = $acm_cs['customer'];
                                                            $plan_cs = $acm_cs['plan'];
                                                                if($plan_cs==null){
                                                                    $plan_cs = "0";
                                                                }else{
                                                                    $plan_cs = "$plan_cs";
                                                                }
                                                            $act_cs = $acm_cs['actual'];
                                                                if($act_cs==null){
                                                                    $act_cs = "0";
                                                                }else{
                                                                    $act_cs = "$act_cs";
                                                                }
                                                            $bal_cs = $plan_cs-$act_cs;
                                                            if($bal_cs!='0'){
                                                                $colour = 'text-danger';
                                                            }else{
                                                                $colour = 'text-dark';
                                                            }
                                                        ?>

                                                        <div class="col-4 text-center">
                                                            <H4><?php echo $plan_cs;?></H4>
                                                            <H6 class="text-muted m-b-0">PLAN</H6>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <H4><?php echo $act_cs;?></H4>
                                                            <H6 class="text-muted m-b-0">ACTUAL</H6>
                                                        </div>
                                                        <div class="col-4 text-center">
                                                            <H4 class="<?php echo $colour ;?>"><?php echo $bal_cs;?></H4>
                                                            <H6 class="text-muted m-b-0">BALANCE</H6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-c-blue text-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-12">
                                                            <h5 class="text-white text-center"><?php echo $cust_cs;?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-8">
                                            <table class="table table-borderless font-weight-bold text-center">
                                                <thead>
                                                    <th class="font-weight-bold text-center">Warehouse</th>
                                                    <th class="font-weight-bold text-center">Customer</th>
                                                    <th class="font-weight-bold text-center">Tgl Delivery</th>
                                                    <th class="font-weight-bold text-center">Cycle</th>
                                                    <th class="font-weight-bold text-center">Jam</th>
                                                    <th class="font-weight-bold text-center">No Delivery</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $now_date = date("Y-m-d");
                                                        if(isset($_GET ['cst_filter']) AND !isset($_GET ['cycle_filter']) AND !isset($_GET['tgl_filter'])){
                                                            $cust = $_GET ['cst_filter'];
                                                            
                                                            $table_head = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT p.tgl,
                                                                                                    jam.no_ct,
                                                                                                    jam.waktu,
                                                                                                    cd.customer,
                                                                                                    ar.nama_area AS nama_area 
                                                                                                    from plan p 
                                                                                                    left join cycle_deliv jam on jam.id = p.id_cycle 
                                                                                                    left join customer_deliv cd on cd.id = p.id_customer 
                                                                                                    left join area ar on ar.id = cd.id_area
                                                                                                    where p.id_customer=$cust AND p.tgl='$now_date' AND jam.no_ct=1 
                                                                                                    ORDER BY p.no_delivery DESC LIMIT 1"));
                                                            
                                                        }else if(isset($_GET ['cst_filter']) AND isset($_GET['cycle_filter']) AND isset($_GET['tgl_filter'])){ 
                                                            $cust = $_GET ['cst_filter'];
                                                            $tgl = $_GET ['tgl_filter'];
                                                            $cycle = $_GET ['cycle_filter'];

                                                            $table_head = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT p.tgl,
                                                                                                        jam.no_ct,
                                                                                                        jam.waktu,
                                                                                                        cd.customer,
                                                                                                        ar.nama_area AS nama_area 
                                                                                                        from plan p 
                                                                                                        left join cycle_deliv jam on jam.id = p.id_cycle 
                                                                                                        left join customer_deliv cd on cd.id = p.id_customer 
                                                                                                        left join area ar on ar.id = cd.id_area
                                                                                                        where p.id_customer=$cust AND p.id_cycle=$cycle AND p.tgl='$tgl' 
                                                                                                        ORDER BY p.no_delivery DESC LIMIT 1"));
                                                        }else if(isset($_GET['no_filter'])){ 
                                                            $no_deliv = $_GET ['no_filter'];

                                                            $table_head = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT p.tgl,
                                                                                                                        jam.no_ct,
                                                                                                                        jam.waktu,
                                                                                                                        cd.customer,
                                                                                                                        ar.nama_area AS nama_area,
                                                                                                                        p.no_delivery
                                                                                                                from plan p 
                                                                                                                left join cycle_deliv jam on jam.id = p.id_cycle 
                                                                                                                left join customer_deliv cd on cd.id = p.id_customer 
                                                                                                                left join area ar on ar.id = cd.id_area
                                                                                                                where p.no_delivery='$no_deliv'"));
                                                        }

                                                        $wh = $table_head['nama_area'];
                                                        $customer = $table_head['customer'];
                                                        $tgl = $table_head['tgl'];
                                                        $no_ct = $table_head['no_ct'];
                                                        $no_delivery = $table_head['no_delivery'];

                                                        if($no_ct==null){
                                                            $no_ct = '-';
                                                        }else{
                                                            $no_ct = $no_ct;
                                                        };

                                                        $waktu = $table_head['waktu'];
                                                        if($waktu==null){
                                                            $waktu = '-';
                                                        }else{
                                                            $waktu = $waktu;
                                                        };                                                        
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $wh;?></td>
                                                        <td><?php echo $customer;?></td>
                                                        <td><?php echo $tgl;?></td>
                                                        <td><?php echo $no_ct;?></td>
                                                        <td><?php echo $waktu;?></td>
                                                        <td><?php echo $no_delivery;?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">  
                                        <!-- Basic table card start -->
                                        <div class="col-xl-12 col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-header-left">
                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <h5 class="no_deliv">
                                                                   <div class="col-sm-12">
                                                                <button type="button" style="font-size:15px;" class="btn btn-info btn-round sj btn-sm" data-toggle="modal" data-target="#no_sjln">Save & Input SJ</button>
                                                            </div>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>                                                       
                                                    <div class="card-header-right">
                                                        <?php 
                                                            $get_cs = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT id_customer
                                                                                                                FROM plan p 
                                                                                                                where no_delivery='$_GET[no_filter]'"));
                                                            $id_customer3 = $get_cs['id_customer'];  
                                                        
                                                            $cst_deliv = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT scan FROM customer_deliv where id='$id_customer3'"));
                                                            $cus = $cst_deliv['scan']; 
                                                        ?>
                                                        <div class="form-group row">
                                                            <!-- form scan fln -->
                                                            <div class="col-sm-<?php
                                                                            if($cus=='yes'){
                                                                                echo 6;
                                                                            }else{
                                                                                echo 12;
                                                                            }
                                                                            ?>">
                                                                <form action="" method="POST" id="formscan">
                                                                    <input type="hidden" name="no_deliv" id="no_deliv" value="<?php if(isset($_GET["no_filter"])){
                                                                                                                    echo $_GET["no_filter"];
                                                                                                                };
                                                                                                                ?>">
                                                                    <input type="text" name="part_fln_scan" id="part_fln_scan" class="form-control form-control-round" placeholder="Scan QR Label FLN" style="text-align: center;" autofocus>
                                                                    <button type="submit" style="display:none"></button>
                                                                </form>
                                                            </div>
                                                            <!-- form scan fln -->

                                                            <!-- form scan cst -->
                                                                <div class="col-sm-6">
                                                                    <form action="" method="" id="formScanCst">
                                                                        <input type="hidden" name="no_deliv1" id="no_deliv1" class="form-control form-control-round" 
                                                                                    value="<?php if(isset($_GET["no_filter"])){
                                                                                                                            echo $_GET["no_filter"];
                                                                                                                        };
                                                                                                                        ?>">
                                                                           
                                                                           <input type="hidden" name="part_fln_scan1" id="part_fln_scan1" class="form-control form-control-round" 
                                                                                    placeholder="Scan QR Label FLN">

                                                                            <?php
                                                                            if($cus=='yes'){
                                                                                echo '<input type="text" name="part_cst_scan" id="part_cst_scan" class="form-control form-control-round" 
                                                                                value="" placeholder="Scan QR Label CST" style="text-align: center;">';
                                                                            }
                                                                            ?>
                                                                        <button type="submit" style="display:none"></button>
                                                                    </form>
                                                                </div>
                                                            <!-- form scan cst -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">                                                 
                                                        <table class="table table-striped datas">
                                                            <thead>
                                                            <th>NO</th> 
                                                            <th>PART NO FLN</th>
                                                            <th>PART NO CUSTOMER</th>
                                                            <th>PART NAME</th>
                                                            <th>QTY PER BOX</th>
                                                            <th>PLAN</th>
                                                            <th>ACTUAL</th>
                                                            <th>BALANCE</th>
                                                            </thead>
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
<div class="info-notif"></div>
<div class="info-notif2"></div>

    <!-- Modal sj-->
    <div class="modal fade" id="no_sjln" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content rounded-top">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Save & Input SJ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php
                $sumary_qty = mysqli_fetch_array(mysqli_query($conn,"SELECT cd.customer,
                                                                sum(plan) as planing,
                                                                sum(
                                                                    (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                            AND pr.no_delivery=p.no_delivery)
                                                                )as actual
                                                                FROM plan p inner join customer_deliv cd on p.id_customer=cd.id
                                                                WHERE p.no_delivery='$_GET[no_filter]' GROUP BY p.id_customer"));
                $customer = $sumary_qty['customer'];
                $plan = $sumary_qty['planing'];
                $act = $sumary_qty['actual'];
                if($act==null){
                    $act = "0";
                }else{
                    $act = "$actual";
                }
                if($act<$plan){
                    $colour = 'text-danger';
                }else if($act==$plan){
                    $colour = 'text-dark';
                }
                $bal = $plan-$act;
                if ($plan==$act){
                    $status = "CLOSE";
                }else{
                    $status = "OPEN";
                }
                ?>
                <form action="" method="post">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center text-center">
                                <div class="col-4 text-center">
                                    <H4 class="text-c-dark"><?php echo $plan; ?></H4>
                                    <H6 class="text-muted m-b-0">PLAN</H6>
                                </div>
                                <div class="col-4 text-center">
                                    <H4 class="text-c-dark"><?php echo $act; ?></H4>
                                    <H6 class="text-muted m-b-0">ACTUAL</H6>
                                </div>
                                <div class="col-4 text-center">
                                    <H4 class="<?php echo $colour ;?>"><?php echo $bal; ?></H4>
                                    <H6 class="text-muted m-b-0">BALANCE</H6>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue text-center">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h6 class="text-white m-b-0"><?php echo $customer; ?></h6>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="form-group col-md-12">
                            <label for="Nama">No Delivery</label>
                            <input type="text" value="<?php echo $_GET['no_filter'] ?>" name="no_deliv" class="form-control form-control-round" readonly>
                        </div>  
                        <div class="form-group col-md-12">
                            <label for="Nama">Status Delivery</label>
                            <input type="text" value="<?php echo $status; ?>" class="form-control form-control-round" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="Nama">No Surat Jalan</label>
                            <input type="text" name="no_sj" class="form-control form-control-round" required placeholder="Input Surat Jalan" autofocus>
                        </div>                                 
                    </div>                
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-round">Reset</button>&nbsp;
                        <input type="submit" class="btn btn-primary btn-round" value="Save">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end-->

    <!-- insert sj -->
    <?php
        if(isset($_POST['no_deliv']) and isset($_POST['no_sj'])){
            // terima data                                 
            $rec_no_deliv = $_POST['no_deliv'];
            $rec_no_sj = $_POST['no_sj'];
                        
            // 1 insert sj   
            $add = mysqli_query($conn,"INSERT INTO surat_jalan VALUES ('$rec_no_deliv','$rec_no_sj')"); 
            
            $data_del2 = mysqli_fetch_array(mysqli_query ($conn,"SELECT no_delivery FROM plan WHERE no_delivery='$_POST[no_deliv]'"));
            $del_rec = $data_del2['no_delivery'];
            $del_rec = substr($del_rec, -1);

            // 2 compare plan dengan actual                                                             
            $compare = mysqli_query($conn,"SELECT p.id,
                                                    p.id_customer,
                                                    p.part_no, 
                                                    p.plan, 
                                                    (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                            AND no_delivery='$no_delivery') 
                                                    as act,
                                                    p.id_cycle, 
                                                    jam.no_ct,    
                                                    p.tgl,       
                                                    p.no_delivery,
                                                    cd.customer
                                            FROM plan p 
                                            left join customer_deliv cd on p.id_customer=cd.id   
                                            inner join cycle_deliv jam on jam.id=p.id_cycle
                                            where no_delivery='$_POST[no_deliv]'                            
                                    ");

            $rec = $del_rec+1;
        
            foreach($compare AS $data){
            $compare_id = $data['id'];
            $compare_part_no = $data['part_no'];
            $id_customer = $data['id_customer'];
            $compare_plan = $data['plan'];
            $compare_actual = $data['act'];
            $id_cycle = $data['id_cycle'];
            $compare_cycle = $data['no_ct'];
            $compare_tgl = $data['tgl'];
            $compare_tgl = date("Ymd",strtotime($compare_tgl));
            $jam = date("His");
            $no_delivery = $data['no_delivery'];
            $custom = $data['customer'];

            $date_now = date("Y-m-d H:i:s");
            $no_deliv = strtotime($date_now)."REC$rec";
            
                if($compare_plan!=$compare_actual){
                    $minus = $compare_plan-$compare_actual;
                        // 2.1 insert plan
                        $add_plan = mysqli_query($conn,"INSERT INTO plan VALUES (null,'$compare_part_no','$compare_tgl','$id_customer','$id_cycle','$minus','$no_deliv')");
                        //2.2 update plan
                        $update_plan_old = mysqli_query($conn,"UPDATE plan SET plan='$compare_actual' WHERE id='$compare_id'"); 
                }
                //2.2 delete plan 
                if($compare_actual==null){
                    $delete_plan = mysqli_query($conn,"DELETE FROM plan WHERE id='$compare_id'");                                         
                }     
            }
            echo "<script>window.location.href='delivery_status.php';</script>";
        }
    ?>
    <!-- insert sj end-->

  
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
        function disableF5(e){if ((e.which || e.keyCode) == 116) e.preventDefault();};
        $(document).bind("keydown", disableF5);
        $(document).on("keydown", disableF5);
    </script>
    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function(){
            $(this).find('[autofocus]').focus();
        });
    </script>

     <!-- datatables -->
     <script type="text/javascript" >
        //akses data json
        
    </script>
    <!-- datatables -->

    <script type="text/javascript">
        var table = $('.datas').DataTable({
            "ajax":'prepare_data.php<?php
                    echo '?no_filter='.$_GET ['no_filter'];
                ?>',
        })

        $(document).ready(function() {
            $('#formscan').on('submit', function(e) {
                e.preventDefault();

                // Ambil data dari form
                var no_deliv = $('#no_deliv').val();
                var part_fln_scan = $('#part_fln_scan').val();

                if (part_fln_scan == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Part Number Not Found!'
                    });
                } else {
                    // Kirim data ke server menggunakan AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'save_prepare.php', // Ganti dengan URL pemrosesan Anda
                        data: {
                            no_deliv: no_deliv,
                            part_fln_scan: part_fln_scan
                        },
                        success: function(response) {
                            $('.info-notif').html(response);
                            table.ajax.reload();
                            // Reset form
                            $('#formscan')[0].reset();
                            document.getElementById("part_cst_scan").focus();
                            let obj = JSON.parse(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Scan QR Berhasil',
                                timer: 1500
                            }).then(function() {
                                // Setelah SweetAlert ditutup, masukkan nilai ke dalam form ID
                                $('#part_fln_scan1').val(obj.part_scan);
                            });
                        },

                        error: function(response) {
                            // Tampilkan SweetAlert untuk pesan error
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengirim data.'
                            });
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#formScanCst').on('submit', function(e) {
                e.preventDefault();

                // Ambil data dari form
                var no_deliv1 = $('#no_deliv1').val();
                var part_fln_scan1 = $('#part_fln_scan1').val();
                var part_cst_scan = $('#part_cst_scan').val();

                if (part_fln_scan1 == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Part Number Not Found!'
                    });
                } else {
                    // Kirim data ke server menggunakan AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'save_prepare_cst.php', // Ganti dengan URL pemrosesan Anda
                        data: {
                            no_deliv1: no_deliv1,
                            part_fln_scan1: part_fln_scan1,
                            part_cst_scan: part_cst_scan
                        },
                        success: function(respon) {
                            $('.info-notif2').html(respon);

                            // Reset form
                            $('#formScanCst')[0].reset();
                            table.ajax.reload();
                        },

                        error: function(responses) {
                            // Tampilkan SweetAlert untuk pesan error
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengirim data.'
                            });
                        }
                    });
                };
                document.getElementById("part_fln_scan").focus();
            });
        });
    </script>
</body>
</html>
