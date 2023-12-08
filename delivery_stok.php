<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
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
                                                        }else if(isset($_GET ['cst_filter']) AND isset($_GET ['cycle_filter']) AND !isset($_GET['tgl'])){
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
                                                            
                                                        }else if(isset($_GET ['cst_filter']) AND isset($_GET['cycle_filter']) AND !isset($_GET['tgl_filter'])){ 
                                                            $cust = $_GET ['cst_filter'];
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
                                                                                                        where p.id_customer=$cust AND p.id_cycle=$cycle AND p.tgl='$now_date' 
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
                                                        <h5>List Stock & Delivery Item</h5>
                                                    </div>                                                       
                                                    <div class="card-header-right">
                                                        <form action="" method="GET" >
                                                            <div class="form-group row">
                                                                <div class="col-sm-7">
                                                                    <input type="hidden" name="cst_filter" class="form-control form-control-round" 
                                                                            value="<?php if(isset($_GET["cst_filter"])){
                                                                            echo $_GET["cst_filter"];
                                                                            };?>">

                                                                    <select name="cycle_filter" class="form-control form-control-round">
                                                                        <option value="">-- Pilih Cycle --</option>
                                                                        <?php
                                                                        if(isset($_GET["cst_filter"])){
                                                                            $filt_cst = $_GET["cst_filter"];
                                                                            $cst_filt = mysqli_query($conn,"SELECT p.id_cycle, cd.no_ct FROM plan p inner join cycle_deliv cd on cd.id=p.id_cycle WHERE id_customer='$filt_cst' GROUP BY p.id_cycle order by cd.no_ct asc");
                                                                        }
                                                                        foreach ($cst_filt AS $data_filt){
                                                                        $cust_filter = $data_filt['id_cycle'];
                                                                        $no_ct = $data_filt['no_ct'];
                                                                        ?>                                         
                                                                            <option value="<?php echo $cust_filter; ?>"><?php echo $no_ct;?></option> 
                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <input type="submit" class="btn btn-info btn-round form-control form-control-round" name="submit" value="filter">
                                                                </div>
                                                            </div>                 
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive " >                                                 
                                                        <!-- tabel scan -->
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <th>NO</th> 
                                                            <th>PART NO FLN</th>
                                                            <th>PART NO CUSTOMER</th>
                                                            <th>PART NAME</th>
                                                            <th>QTY PER BOX</th>
                                                            <th>PLAN</th>
                                                            <th>ACTUAL</th>
                                                            <th>BALANCE</th>
                                                            <th>NO SJ</th>
                                                            <th>STOK WH</th>
                                                            <th>DELIV (DAY)</th>
                                                            <th>STOCK (DAY)</th>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                                $now_date = date("Y-m-d");
                                                                if (isset($_GET ['cst_filter']) AND !isset($_GET ['cycle_filter']) AND !isset($_GET['tgl'])){
                                                                    $cust = $_GET ['cst_filter'];

                                                                    $plan_deliv = mysqli_query ($conn,"SELECT  p.part_no,
                                                                                                                lp.part_name,
                                                                                                                lp.part_no_cst,
                                                                                                                lp.qty_box,
                                                                                                                p.plan,
                                                                                                                (select sum(qty) from prepare pr where pr.part_no_prep = p.part_no
                                                                                                                                                        and pr.no_delivery=p.no_delivery)
                                                                                                                AS act,
                                                                                                                sj.no_sj,
                                                                                                                prod,
                                                                                                                deliv
                                                                                                                from plan p 
                                                                                                                left join cycle_deliv cd on p.id_cycle = cd.id
                                                                                                                left join list_part lp on p.part_no = lp.part_no
                                                                                                                left join surat_jalan sj on sj.no_delivery = p.no_delivery
                                                                                                                left join (SELECT s.part_no, 
                                                                                                                                    sum(qty) as prod, 
                                                                                                                                    (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = s.part_no GROUP BY pr.part_no_prep) 
                                                                                                                                    as deliv
                                                                                                                                FROM stock s GROUP BY s.part_no)
                                                                                                                        AS stok on stok.part_no=p.part_no
                                                                                                                where id_customer=$cust AND no_ct=1 AND tgl='$now_date'");
                                                                

                                                                }if(isset($_GET ['cst_filter']) AND isset($_GET ['cycle_filter']) AND !isset($_GET['tgl'])){
                                                                    $cust = $_GET ['cst_filter'];
                                                                    $cycle = $_GET ['cycle_filter'];
    
                                                                    $plan_deliv = mysqli_query ($conn,"SELECT p.part_no,
                                                                                                                lp.part_name,
                                                                                                                lp.part_no_cst,
                                                                                                                lp.qty_box,
                                                                                                                p.plan,
                                                                                                                (select sum(qty) from prepare pr where  pr.part_no_prep = p.part_no
                                                                                                                                                        and pr.no_delivery=p.no_delivery)
                                                                                                                AS act,
                                                                                                                sj.no_sj,
                                                                                                                prod,
                                                                                                                deliv
                                                                                                                from plan p 
                                                                                                                left join list_part lp on p.part_no = lp.part_no
                                                                                                                left join surat_jalan sj on sj.no_delivery = p.no_delivery
                                                                                                                left join (SELECT s.part_no, 
                                                                                                                                    sum(qty) as prod, 
                                                                                                                                    (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = s.part_no GROUP BY pr.part_no_prep) 
                                                                                                                                    as deliv
                                                                                                                                FROM stock s GROUP BY s.part_no)
                                                                                                                        AS stok on stok.part_no=p.part_no
                                                                                                                WHERE p.id_cycle=$cycle AND p.id_customer=$cust AND p.tgl='$now_date'");
                                                                }else if(isset($_GET['no_filter'])){ 
                                                                    $no_deliv = $_GET ['no_filter'];

                                                                    $plan_deliv = mysqli_query ($conn,"SELECT p.part_no,
                                                                                                                lp.part_name,
                                                                                                                lp.part_no_cst,
                                                                                                                lp.qty_box,
                                                                                                                p.plan,
                                                                                                                (select sum(qty) from prepare pr where  pr.part_no_prep = p.part_no
                                                                                                                                                        and pr.no_delivery=p.no_delivery)
                                                                                                                AS act,
                                                                                                                sj.no_sj,
                                                                                                                prod,
                                                                                                                deliv
                                                                                                                from plan p 
                                                                                                                left join list_part lp on p.part_no = lp.part_no
                                                                                                                left join surat_jalan sj on sj.no_delivery = p.no_delivery
                                                                                                                left join (SELECT s.part_no, 
                                                                                                                                    sum(qty) as prod, 
                                                                                                                                    (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = s.part_no GROUP BY pr.part_no_prep) 
                                                                                                                                    as deliv
                                                                                                                                FROM stock s GROUP BY s.part_no)
                                                                                                                        AS stok on stok.part_no=p.part_no
                                                                                                                where no_delivery='$no_deliv'");
                                                                

                                                                }

                                                                $no=1;

                                                                foreach($plan_deliv AS $data1){
                                                                $part_no = $data1['part_no'];
                                                                $part_cst = $data1['part_no_cst'];
                                                                $part_name = $data1['part_name'];
                                                                $qty_box = $data1['qty_box'];
                                                                $plan = $data1['plan'];
                                                                $actual = $data1['act'];
                                                                $prod = $data1['prod'];
                                                                $deliv = $data1['deliv'];
                                                                $no_sj = $data1['no_sj'];
                                                                if($actual==null){
                                                                    $actual = "0";
                                                                }else{
                                                                    $actual = "$actual";
                                                                };
                                                                $balance = $plan-$actual;
                                                                $stok = $prod-$deliv;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $no; ?></td>
                                                                <td><?php echo $part_no; ?></td>
                                                                <td><?php echo $part_cst; ?></td>
                                                                <td><?php echo $part_name; ?></td>
                                                                <td><?php echo $qty_box; ?></td>
                                                                <td><?php echo $plan; ?></td>
                                                                <td <?php
                                                                        if ($plan==$actual){
                                                                            $colour_act='text-success';
                                                                        }else{
                                                                            $colour_act='text-dark';
                                                                        }
                                                                    ?>
                                                                    class=<?php echo $colour_act; ?>>
                                                                    <?php echo $actual;?>
                                                                    </td>
                                                                <td
                                                                    <?php
                                                                        if ($balance !='0'){
                                                                            $colour='text-danger';
                                                                        }else{
                                                                            $colour='text-dark';
                                                                        }
                                                                    ?>
                                                                    class=<?php echo $colour; ?>>
                                                                    <?php echo $balance; ?>
                                                                </td>
                                                                <td><?php echo $no_sj; ?></td>
                                                                <td><?php echo $stok; ?></td>
                                                                <td></td>
                                                                <td></td>
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
</body>
</html>
