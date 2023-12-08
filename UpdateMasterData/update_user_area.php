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
                                            <h5 class="m-b-10">User Area</h5>
                                          <p class="m-b-0">Delivery Control System</p>
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
                                                        <h5>Edit User Area</h5>
                                                    </div>
                                                    <div class="card-body">
                                                    <?php
                                                        $id_user = $_GET['id_user'];
                                                        $us_area = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ua.id_user,
                                                                                                                ar.id,
                                                                                                                dept.id_dept,
                                                                                                                ar.nama_area ,
                                                                                                                dept.nama_dept
                                                                                                        FROM user_area ua
                                                                                                        left join area ar on ua.id_area=ar.id
                                                                                                        left join departemen dept on dept.id_dept=ar.id_dept
                                                                                                        where ua.id_user='$id_user'"));
                                                        $nama = $us_area['id_user'];  
                                                        $nama_area = $us_area['nama_area']; 
                                                        $nama_dept = $us_area['nama_dept'];
                                                        $id_dept = $us_area['id_dept']; 
                                                        $id_area = $us_area['id'];
                                                    ?>                                                   
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="nama" value="<?php echo $nama;?>" class="form-control form-control-round">
                                                            <div class="form-group row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="Nama">Id User</label>
                                                                    <input type="text" name="id_edit" value="<?php echo $nama;?>" class="form-control form-control-round">
                                                                </div>  
                                                                <div class="form-group col-md-12">
                                                                    <label class="col-sm-12 col-form-label">Area</label>
                                                                    <select name="area_edit" class="form-control form-control-round">
                                                                        <option value="<?php echo $id_area;?>"><?php echo $nama_area;?></option>
                                                                        <?php
                                                                        $cust = mysqli_query($conn,"SELECT id, nama_area FROM area order by nama_area asc");
                                                                        foreach ($cust AS $data_cus){
                                                                        $id_wh = $data_cus['id'];
                                                                        $nama_area = $data_cus['nama_area'];
                                                                        ?>                                         
                                                                            <option value="<?php echo $id_wh; ?>"><?php echo $nama_area; ?></option> 
                                                                        <?php
                                                                        }
                                                                        ?> 
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-12 float-left">
                                                                    <a href="../master_data/user_area.php"><button type="button" class="btn btn-secondary btn-round">Close</button></a>
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
                                            $nama = $_POST['nama'];
                                            $area_edit = $_POST['area_edit'];
                                            $id_edit = $_POST['id_edit'];

                                            $update = mysqli_query($conn, "UPDATE user_area SET id_user = '$id_edit', id_area = '$area_edit' WHERE user_area.id_user = '$nama' ");
                                            echo '<script languange="javascript">
                                                        swal.fire({
                                                            title: "Success",
                                                            text: " User Area Updated",
                                                            icon:"success",
                                                            timer: 1500
                                                        }).then(function(){
                                                            window.location.href="../master_data/user_area.php";
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
