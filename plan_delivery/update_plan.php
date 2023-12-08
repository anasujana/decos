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
    <!-- Google font-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet"> -->
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
        <!-- am chart export.css -->
        <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
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
                include('../element/navbar.php');
                ?>
                  
                <div class="pcoded-content">
                      <!-- Page-header start -->
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
                                                        <h5>Edit Plan Delivery</h5>
                                                    </div>
                                                    <div class="card-body">
                                                    <?php
                                                        $id_planing = $_GET['id_planing'];
                                                        $data_deliv = mysqli_fetch_array(mysqli_query($conn, "SELECT p.id, 
                                                                                                                        p.id_customer,
                                                                                                                        p.plan,
                                                                                                                        p.part_no, 
                                                                                                                        lp.part_name,
                                                                                                                        sj.no_sj,
                                                                                                                        p.no_delivery FROM plan p
                                                                                                                    INNER JOIN list_part lp on p.part_no=lp.part_no
                                                                                                                    LEFT JOIN cycle_deliv cd on p.id_cycle=cd.id
                                                                                                                    INNER JOIN customer_deliv cs on p.id_customer=cs.id
                                                                                                                    LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
                                                                                                                    WHERE p.id='$id_planing'"));
                                                        $id_plan = $data_deliv['id'];
                                                        $part_no = $data_deliv['part_no'];
                                                        $part_name = $data_deliv['part_name'];
                                                        $plan = $data_deliv['plan'];
                                                        $id_customer = $data_deliv['id_customer'];
                                                        $no_delivery = $data_deliv['no_delivery'];
                                                        $no_sj = $data_deliv['no_sj'];
                                                    ?>                                                   
                                                        <form action="" method='POST'>   
                                                            <input type="hidden" value="<?php echo $id_plan;?>" name="id_plan"
                                                                    class="form-control form-control-round">
                                                            <input type="hidden" value="<?php echo $no_delivery;?>" name="no_delivery"
                                                            class="form-control form-control-round">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Part Number</label>
                                                                <div class="col-sm-12">
                                                                    <select name="item_edit" class="form-control form-control-round">
                                                                        <option value="<?php echo $part_no;?>"><?php echo $part_no." == ".$part_name;?></option>
                                                                        <?php
                                                                        $data_part = mysqli_query($conn,"SELECT pd.part_no, lp.part_name FROM part_deliv pd
                                                                                                                            inner join list_part lp on lp.part_no=pd.part_no
                                                                                                                            where pd.customer_id = '$id_customer' ORDER BY pd.part_no asc");
                                                                        foreach ($data_part AS $part){
                                                                        $part_no_edit = $part['part_no'];
                                                                        $part_name_edit = $part['part_name'];
                                                                        ?>                                         
                                                                            <option value="<?php echo $part_no_edit; ?>"><?php echo $part_no_edit." == ".$part_name_edit; ?></option> 
                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Plan</label>
                                                                <div class="col-sm-12">
                                                                    <input type="number" value="<?php echo $plan;?>"name="plan_edit"
                                                                    class="form-control form-control-round">
                                                                </div>
                                                            </div>  
                                                            <div class="form-group row">
                                                                <?php
                                                                    if($no_sj != null){
                                                                        echo '<label class="col-sm-2 col-form-label">no_sj</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" value="'.$no_sj.'"name="sj_edit"
                                                                            class="form-control form-control-round"
                                                                        </div>';
                                                                    }
                                                                    ?>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                               <a href="../chekshet_delivery.php"><button type="button" class="btn btn-secondary btn-round">Close</button>&nbsp;</a>
                                                                <input type="submit" class="btn btn-primary btn-round" value="Save">
                                                            </div>
                                                        </form>                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if((isset($_POST['id_plan']) and isset($_POST['item_edit']) and isset($_POST['plan_edit']) and isset($_POST['no_delivery'])) OR (isset($_POST['sj_edit']))){
                                            $id_plan = $_POST['id_plan'];
                                            $plan_edit = $_POST['plan_edit'];
                                            $sj_edit = $_POST['sj_edit'];
                                            $no_delivery = $_POST['no_delivery'];
                                            $item_edit = $_POST['item_edit'];
                                            
                                            $updateted_plan = mysqli_query($conn, "UPDATE plan SET plan='$plan_edit', part_no='$item_edit' WHERE id='$id_plan'");
                                            $update_sj = mysqli_query($conn, "UPDATE surat_jalan SET no_sj='$sj_edit' WHERE no_delivery='$no_delivery'");
                                            
                                            echo '<script languange="javascript">
                                            swal.fire({
                                                title: "Success",
                                                text: "Planing Delivery Updated",
                                                icon:"success",
                                                timer: 1500
                                            }).then(function(){
                                                window.location.href="../chekshet_delivery.php";
                                                });
                                        </script>';   
                                        };
                                    ?>   
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
