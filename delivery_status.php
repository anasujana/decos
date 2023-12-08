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
                    <!-- Page-header start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="page-header-title">
                                        <p class="m-b-10">Delivery Status</p>
                                        <h5 class="m-b-0"><?php echo $_SESSION['nama_area'];?></h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="andon_deliv.php">Delivery Control</a>
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
                                    <div class="col-xl-12 col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-header-left">
                                                    <h5>List Delivery Status</h5>
                                                    </div>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive scaner_part" id="table_scan">
                                                    <table class="table table-striped datas text-center">
                                                        <thead>
                                                            <th>Customer</th>
                                                            <th>Tanggal</th>
                                                            <th>Cycle</th>
                                                            <th>No Delivery</th>
                                                            <th>No Surat Jalan</th>
                                                            <th>Status</th>
                                                            <th>Delivery</th>
                                                        </thead>
                                                        <tbody> 
                                                                <?php
                                                                    $now_date = date("Y-m-d");
                                                                    if(isset($_GET ['cst_filter'])){ 
                                                                        $cust = $_GET ['cst_filter'];

                                                                        mysqli_query($conn,"CREATE TEMPORARY TABLE deliv_status SELECT p.id_customer,
                                                                                                                                        cd.customer,
                                                                                                                                        p.id_cycle,
                                                                                                                                        jam.no_ct,
                                                                                                                                        p.tgl,
                                                                                                                                        p.no_delivery,
                                                                                                                                        sj.no_sj
                                                                                                                                from plan p 
                                                                                                                                left join cycle_deliv jam on jam.id = p.id_cycle
                                                                                                                                join customer_deliv cd on p.id_customer = cd.id 
                                                                                                                                left join surat_jalan sj on sj.no_delivery=p.no_delivery WHERE p.id_customer=$cust AND sj.no_sj IS NULL
                                                                                                                                group by p.id_cycle,p.tgl,p.no_delivery order by p.tgl DESC");

                                                                    }else if(!isset($_GET ['cst_filter'])){
                                                                        mysqli_query($conn,"CREATE TEMPORARY TABLE deliv_status SELECT p.id_customer,
                                                                                                                                        cd.customer,
                                                                                                                                        p.id_cycle,
                                                                                                                                        jam.no_ct,
                                                                                                                                        p.tgl,
                                                                                                                                        p.no_delivery,
                                                                                                                                        sj.no_sj,
                                                                                                                                        cd.id_area
                                                                                                                                from plan p 
                                                                                                                                left join cycle_deliv jam on jam.id = p.id_cycle
                                                                                                                                left join customer_deliv cd on p.id_customer = cd.id 
                                                                                                                                left join surat_jalan sj on sj.no_delivery=p.no_delivery WHERE cd.id_area=$_SESSION[id_area] AND sj.no_sj IS NULL
                                                                                                                                group by p.id_customer,p.id_cycle,p.tgl,p.no_delivery order by p.tgl DESC");

                                                                    }

                                                                    $tgl_filt = mysqli_query($conn,"SELECT * FROM deliv_status order by no_ct ASC");
                                                                    
                                                                    foreach ($tgl_filt AS $data){
                                                                    $tgl = $data['tgl'];
                                                                    $cycle = $data['no_ct'];
                                                                    $id_cycle = $data['id_cycle'];
                                                                    $id_custom = $data['id_customer'];
                                                                    $customer = $data['customer'];
                                                                    $no_delivery = $data['no_delivery'];
                                                                    $no_sj = $data['no_sj'];
                                                                    if($no_sj==NULL){
                                                                        $statusdb = 'OPEN';
                                                                        $no_sj = 'N/A';
                                                                    }else{
                                                                        $statusdb = 'CLOSE';
                                                                    }
                                                                    
                                                                    ?>
                                                                    <tr> 
                                                                    <td><?php echo $customer;?></td>
                                                                    <td><?php echo $tgl;?></td>
                                                                    <td><?php echo $cycle;?></td>
                                                                    <td><?php echo $no_delivery;?></td>
                                                                    <td><?php echo $no_sj;?></td>
                                                                    <td <?php if($statusdb=='OPEN'){
                                                                                echo 'class="text-danger"';
                                                                            }else{
                                                                                echo 'class="text-dark"';
                                                                            }?>
                                                                    ><?php echo $statusdb;?></td>
                                                                    <td>
                                                                        <a href="delivery_prepare.php?no_filter=<?php echo $no_delivery;?>"> 
                                                                            <button type='button' class='btn btn-success btn-round text-dark'>Preparation &nbsp;&nbsp;<i class="ti-eye"></i></button>
                                                                        </a>
                                                                        <a href="chekshet_delivery.php?no_filter=<?php echo $no_delivery;?>"> 
                                                                            <button type='button' class='btn btn-success btn-round text-dark'>Schedule &nbsp;&nbsp;<i class="ti-eye"></i></i></button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
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
    <!-- datatables -->
    <script type="text/javascript" >
            $(document).ready(function(){
                $('.datas').DataTable();
            });
    </script>
    <!-- datatables -->
</body>

</html>
