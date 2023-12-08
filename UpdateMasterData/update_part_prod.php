<?php
    session_start();
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
                include('../element/navbar_admin.php');
                ?>
                  
                  <div class="pcoded-content">
                      <!-- Page-header start -->
                      <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-4">
                                        <div class="page-header-title">
                                          <h5 class="m-b-10">Part (Produksi) </h5>
                                          <p class="m-b-0">PT. Frina Lestai Nusantara</p>
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
                                            <div class="col-md-12 d-print-none">
                                                <div class="card shadow mb-12">
                                                    <div class="card-header">
                                                        <h5>Edit Part (Produksi)</h5>
                                                    </div>
                                                    <div class="card-body">
                                                    <?php
                                                        $part_no = $_GET['part_no'];
                                                        $part = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cs.id,
                                                                                                                cs.customer,
                                                                                                                li.id_line,
                                                                                                                li.name_line, 
                                                                                                                pp.part_no,
                                                                                                                ar.id,
                                                                                                                ar.nama_area
                                                                                                        FROM part_prod pp
                                                                                                        left join line li on pp.id_line=li.id_line
                                                                                                        left join customer_prod cs on pp.customer_id=cs.id 
                                                                                                        left join area ar on ar.id=pp.id_area
                                                                                                       WHERE pp.part_no='$part_no' order by pp.part_no asc"));
                                                        $part_no_edit = $part['part_no'];
                                                        $customer = $part['customer']; 
                                                        $name_line = $part['name_line']; 
                                                        $id_line = $part['id_line']; 
                                                        $id = $part['cs.id'];
                                                        $wh = $part['nama_area'];
                                                        $id_area = $part['ar.id'];
                                                    ?>                                                   
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="part_no" value="<?php echo $part_no_edit;?>" class="form-control form-control-round">
                                                            <div class="form-group row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="Nama">Part Number</label>
                                                                    <input type="text" name="part_edit" value="<?php echo $part_no_edit;?>" class="form-control form-control-round">
                                                                </div>  
                                                                <div class="form-group col-md-12">
                                                                    <label class="col-sm-2 col-form-label">Customer</label>
                                                                    <select name="customer_edit" class="form-control form-control-round">
                                                                        <option value="<?php echo $id;?>"><?php echo $customer;?></option>
                                                                        <?php
                                                                        $cust = mysqli_query($conn,"SELECT id, customer FROM customer_prod order by customer asc");
                                                                        foreach ($cust AS $data_cus){
                                                                        $id_cs = $data_cus['id'];
                                                                        $customer = $data_cus['customer'];
                                                                        ?>                                         
                                                                            <option value="<?php echo $id_cs; ?>"><?php echo $customer; ?></option> 
                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>  
                                                                <div class="form-group col-md-12">
                                                                    <label class="col-sm-2 col-form-label">Line</label>
                                                                    <select name="line_edit" class="form-control form-control-round">
                                                                        <option value="<?php echo $id_area;?>"><?php echo $name_line;?></option>
                                                                        <?php
                                                                        $id_area = mysqli_query($conn,"SELECT id_line, name_line FROM line order by id_line asc");
                                                                        foreach ($id_area AS $data_ar){
                                                                        $id = $data_ar['id_line'];
                                                                        $area = $data_ar['name_line'];
                                                                        ?>                                         
                                                                            <option value="<?php echo $id; ?>"><?php echo $area; ?></option> 
                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div> 
                                                                <div class="form-group col-md-12">
                                                                    <label class="col-sm-2 col-form-label">Warehouse</label>
                                                                    <select name="wh_edit" class="form-control form-control-round">
                                                                        <option value="<?php echo $id_line;?>"><?php echo $wh;?></option>
                                                                        <?php
                                                                        $id_area = mysqli_query($conn,"SELECT id, nama_area FROM area where id_dept=1  order by nama_area asc");
                                                                        foreach ($id_area AS $data_ar){
                                                                        $id = $data_ar['id'];
                                                                        $nama_area = $data_ar['nama_area'];
                                                                        ?>                                         
                                                                            <option value="<?php echo $id; ?>"><?php echo $nama_area; ?></option> 
                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>                      
                                                                <div class="form-group col-md-12 float-left">
                                                                    <a href="../master_data/part_prod.php"><button type="button" class="btn btn-secondary btn-round">Close</button></a>
                                                                    <input type="submit" name="save" class="btn btn-primary btn-round" value="Save">
                                                                </div>
                                                            </div>
                                                        </form>                                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if(isset($_POST['save'])){
                                            $part_no = $_POST['part_no'];
                                            $part_edit = $_POST['part_edit'];
                                            $customer_edit = $_POST['customer_edit'];
                                            $line_edit = $_POST['line_edit'];
                                            $wh_edit = $_POST['wh_edit'];

                                            $update = mysqli_query($conn, "UPDATE part_prod SET part_no = '$part_edit', customer_id = '$customer_edit', id_area= '$wh_edit', id_line = '$line_edit' WHERE part_prod.part_no = '$part_no' ");
                                            echo '<script languange="javascript">
                                                        swal.fire({
                                                            title: "Success",
                                                            text: " Data Part Updated",
                                                            icon:"success",
                                                            timer: 1500
                                                        }).then(function(){
                                                            window.location.href="../master_data/part_prod.php";
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
