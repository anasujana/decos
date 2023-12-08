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
                if(isset($_POST['part_scan'])){
                    // terima part_number
                    $part_scan = $_POST['part_scan'];
                    
                    // Cek part no
                    $part_no_db = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT part_no FROM list_part where part_no='$part_scan'"));
                    $part_no = $part_no_db['part_no'];

                    if($part_no==$part_scan){
                        // tambahkan box in    
                        $add = mysqli_query($conn,"INSERT INTO box_in VALUES (NULL,'$part_scan','$now_date')"); 

                        // Count box in
                        $qty_box = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT count(part_no) as qty FROM box_in where part_no='$part_scan' AND tgl='$now_date'"));
                        $qty = $qty_box['qty'];

                        // ambil qty last date from box in
                        $tgl_empty_box = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT tgl FROM empty_box where part_no='$part_scan' ORDER BY tgl DESC LIMIT 1"));
                        $qty_empty = $tgl_empty_box['tgl'];

                        // Count box in
                        $qty_box = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT qty FROM empty_box where part_no='$part_scan' AND tgl='$tgl_empty'"));
                        $qty = $qty_box['qty'];

                        $empty_box = $qty+$qty_empty;

                        // tambahkan TEMP    
                        $temp_box = mysqli_query($conn,"INSERT INTO temp VALUES (NULL,'$part_scan','$empty_box','$now_date',NULL,NULL)");

                        // tambahkan empty box    
                        $empty_box = mysqli_query($conn,"INSERT INTO empty_box VALUES (NULL,'$part_scan','$qty','$now_date')");

                        // ambil id empty box
                        $id_box = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT id FROM empty_box where part_no='$part_scan' ORDER BY id DESC LIMIT 1"));
                        $id = $id_box['id'];

                         // ambil id temp
                         $id_temp = mysqli_fetch_assoc(mysqli_query ($conn,"SELECT id FROM temp where box_name='$part_scan' ORDER BY id DESC LIMIT 1"));
                         $id_temp = $id_temp['id'];

                        // delete empty box
                        $delete_box = mysqli_query ($conn," DELETE FROM empty_box WHERE id<$id AND part_no='$part_scan' AND tgl='$now_date'");
                        $delete_empty = mysqli_query ($conn," DELETE FROM temp WHERE id<$id_temp AND box_name='$part_scan' AND  tgl_in='$now_date'");
                        
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
                    }else{
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
                }
                // SCAN PART CST
                ?>

                <div class="pcoded-content">
                    <!-- Page-header start -->
                    <div class="page-header d-print-none">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">Empty Box In</h5>
                                        <p class="m-b-0">FG 1</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="page-header-title">
                                    <p class="m-b-0 text-right"><?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                                                                                        echo strftime("%A, %d %B %Y");?>
                                    </p>
                                    <p class="m-b-0 text-right"><?php $now_time = date("H:i:s"); echo $now_time ;?></p>
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
                                                                <h5>Empty Box In From Customer</h5>
                                                            </div>
                                                        </div>
                                                    </div>                                                       
                                                    <div class="card-header-right">
                                                        <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <form action="" method="POST" >
                                                                <input type="text" name="part_scan" id="part_scan" class="form-control form-control-round" placeholder="Scan Box QR" autofocus>
                                                                <input type="submit" name="submit_scan" style="display:none" >
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th>NO</th> 
                                                                <th>WAREHOUSE</th>
                                                                <th>BOX NAME</th>
                                                                <th>BOX IN</th>
                                                                <th>EMPTY BOX</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $plan_deliv = mysqli_query ($conn,"SELECT s.part_no, 
                                                                                                                lp.part_name,
                                                                                                                count(s.part_no) as prod,
                                                                                                                ar.nama_area,
                                                                                                                eb.qty
                                                                                                        FROM box_in s 
                                                                                                        left join empty_box eb on eb.part_no=s.part_no
                                                                                                        left join list_part lp on s.part_no = lp.part_no
                                                                                                        left join part_prod pd on pd.part_no = s.part_no
                                                                                                        left join area ar on ar.id = pd.id_area
                                                                                                        where s.tgl='$now_date'
                                                                                                        GROUP BY s.part_no");
                                                                    

                                                                    

                                                                    $no=1;

                                                                    foreach($plan_deliv AS $data1){
                                                                    $nama_area = $data1['nama_area'];
                                                                    $part_no = $data1['part_no'];
                                                                    $part_name = $data1['part_name'];
                                                                    $prod = $data1['prod'];
                                                                    $qty = $data1['qty'];
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $no; ?></td>
                                                                    <td><?php echo $nama_area; ?></td>
                                                                    <td><?php echo $part_name; ?></td>
                                                                    <td><?php echo $prod; ?></td>
                                                                    <td><?php echo $qty; ?></td>
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

<script type="text/javascript" >
$(document).ready(function(){
    $('.datas').DataTable();
});
</script>
</body>

</html>
