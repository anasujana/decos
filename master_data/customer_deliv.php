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
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css"><!-- Required Jquery -->
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="../assets/pages/widget/excanvas.js "></script>
    <!-- sweet alert -->
    <script src="../assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
    <!-- sweet alert -->
     
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
                                    <div class="col-md-8">
                                            <div class="page-header-title">
                                            <h5 class="m-b-10">List Customer </h5>
                                            <p class="m-b-0">PT. Frina Lestai Nusantara</p>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li class="">
                                                <button type="button" class="btn btn-white btn-round text-dark" data-toggle="modal" data-target="#add_cst_deliv">Add Customer <i class="ti-plus"></i></button>                             
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <!-- Modal add customer deliv-->
                        <div class="modal fade" id="add_cst_deliv" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Customer (Delivery)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-row"> 
                                            <div class="form-group col-md-12">
                                                <label for="Nama">Customer</label>
                                                <input type="text" name="cst" class="form-control form-control-round" placeholder="Input Nama Customer" autofocus>
                                            </div>  
                                            <div class="form-group col-md-12">
                                                <label class="col-sm-12 col-form-label">Warehouse</label>
                                                <select name="wh" id="" class="form-control form-control-round">
                                                    <option value="">-- Pilih Warehouse --</option>
                                                    <?php
                                                    $cust = mysqli_query($conn,"SELECT id, nama_area FROM area where id_dept=1 order by nama_area asc");
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
                                            <div class="form-group col-md-12">
                                                <label class="col-sm-12 col-form-label">Scan Label</label>
                                                <select name="scan" class="form-control form-control-round" required>
                                                    <option value="">-- Pilih Scan --</option>
                                                    <option value="yes">YES</option>
                                                    <option value="no">NO</option> 
                                                </select>
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
                        <?php
                        if(isset($_POST['save'])){
                            $cst = $_POST['cst'];
                            $wh = $_POST['wh'];
                            $scan = $_POST['scan'];
                            $add_cs_deliv = mysqli_query($conn,"INSERT INTO customer_deliv VALUES (NULL,'$cst','$wh','$scan')"); 
                            echo '<script languange="javascript">
                                        swal.fire({
                                            title: "Success",
                                            text: "Customer Ditambahkan",
                                            icon:"success",
                                        }).then(function(){
                                            window.location.href="customer_deliv.php";
                                            });
                                    </script>';   
                        };
                        ?> 

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
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">                                                 
                                                            <table class="table table-striped plan_deliv datas">
                                                                <thead>
                                                                <th>ID CUSTOMER</th>
                                                                <th>CUSTOMER</th> 
                                                                <th>WAREHOUSE</th>
                                                                <th>SCAN LABEL</th>
                                                                <th>ACTION</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $list_customer = mysqli_query ($conn,"SELECT cd.id, cd.customer, cd.scan, ar.nama_area FROM customer_deliv cd left join area ar on ar.id=cd.id_area");
                                                                        foreach($list_customer AS $data){
                                                                        $id = $data['id'];
                                                                        $area = $data['nama_area'];  
                                                                        $customer = $data['customer']; 
                                                                        $scan = $data['scan'];
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $id; ?></td>
                                                                        <td><?php echo $customer; ?></td>
                                                                        <td><?php echo $area; ?></td>
                                                                        <td><?php echo $scan; ?></td>
                                                                        <td>
                                                                            <a href="../deleteMasterData/delete_cst_deliv.php?id_cs_deliv=<?php echo $id; ?>" class="alert_notif"> 
                                                                                <button type='button' class='btn btn-danger btn-round text-dark'>Hapus &nbsp;&nbsp;<i class="ti-trash"></i></button>
                                                                            </a>
                                                                            <a href="../UpdateMasterData/update_cst_deliv.php?id_cs=<?php echo $id;?>"> 
                                                                                <button type='button' class='btn btn-success btn-round text-dark'>Edit &nbsp;&nbsp;<i class="ti-pencil"></i></button>
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
    <!-- jika ada session sukses maka tampilkan alert yang telah di set dalam session sukses  -->
    <?php if(@$_SESSION['sukses']){ ?>
        <script>
            Swal.fire({            
                icon: 'success',                   
                title: 'Sukses',    
                text: 'data berhasil dihapus',                        
                timer: 3000,                                
                showConfirmButton: false
            })
        </script>
    <!-- unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>

    <!-- konfirmasi hapus data dengan sweet alert  -->
    <script>
        $('.alert_notif').on('click',function(){
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus data?",            
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"
            
            }).then(result => {
                //jika klik ya maka arahkan ke proses.php
                if(result.isConfirmed){
                    window.location.href = getLink
                }
            })
            return false;
        });
    </script>
    
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
    <!-- menu js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="../assets/js/script.js "></script>
    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.css">
    <script src="../assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.js"></script>
    
</body>
    <!-- datatables -->
    <script type="text/javascript" >
            $(document).ready(function(){
                $('.datas').DataTable();
            });
    </script>
    <!-- datatables -->
    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function(){
            $(this).find('[autofocus]').focus();
        });
    </script>
</html>
