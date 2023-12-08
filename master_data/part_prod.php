<?php
     // session_start();
     function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength= strlen($characters);
        $randomstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randomstring = $characters[rand(0, $charactersLength - 1)];
        }
        return $randomstring;
    }
    require_once (__DIR__ . '/../vendor/autoload.php'); 
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
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css"> <link rel="stylesheet" type="text/css" href="../assets/css/style.css"><!-- Required Jquery -->
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="../assets/pages/widget/excanvas.js "></script>
    <!-- sweet alert -->
    <script src="../assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
    <!-- sweet alert -->
    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_1.13.5_css_jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_buttons_2.4.1_css_buttons.dataTables.min.css">
    <script src="../assets/DataTables/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="../assets/DataTables/cdn.datatables.net_1.13.5_js_jquery.dataTables.min.js"></script>
    <script src="../assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_dataTables.buttons.min.js"></script>
    <script src="../assets/DataTables/cdnjs.cloudflare.com_ajax_libs_jszip_3.10.1_jszip.min.js"></script>
    <script src="../assets/DataTables/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_pdfmake.min.js"></script>
    <script src="../assets/DataTables/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_vfs_fonts.js"></script>
    <script src="../assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_buttons.html5.min.js"></script>
    <script src="../assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_buttons.print.min.js"></script>
     
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
                                          <h5 class="m-b-10">List Part (Produksi)</h5>
                                          <p class="m-b-0">PT. Frina Lestari Nusantara</p>
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row justify-content-end">
                                        <div class="col-md-5 text-right">
                                            <button type="button" class="btn btn-white btn-round text-dark" data-toggle="modal" data-target="#upload_excel_pp">Upload Data <i class="ti-upload"></i></button>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <button type="button" class="btn btn-white btn-round text-dark" data-toggle="modal" data-target="#add_part_prod">Add Part Line <i class="ti-plus"></i></button>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                          </div>
                      </div>
                      <!-- Page-header end -->
                      
                        <!-- Modal add part produksi-->
                        <div class="modal fade" id="add_part_prod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Part</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-row"> 
                                            <div class="form-group col-md-12">
                                                <label for="Nama">Part Number</label>
                                                <input type="text" name="Part_number" id="Part_number" class="form-control form-control-round" placeholder="Input Part No FLN" autofocus>
                                            </div>  
                                            <div class="form-group col-md-12">
                                                <label class="col-sm-12 col-form-label">Customer</label>
                                                <select name="customer" id="" class="form-control form-control-round">
                                                    <option value="">-- Pilih Customer --</option>               
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
                                                <select name="area" id="" class="form-control form-control-round">
                                                    <option value="">-- Pilih Line --</option>                   
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
                                                <label class="col-sm-12 col-form-label">Warehouse</label>
                                                <select name="wh" class="form-control form-control-round">
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
                        <!-- modal end-->

                         <!-- Modal upload excel-->
                         <div class="modal fade" id="upload_excel_pp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Part Produksi :</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="file-upload-form" method="POST" enctype="multipart/form-data" action="">       
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="file" class="form-control" name="file">
                                                    </div>
                                                </div>
                                            <div id="response"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit_file_pp" class="btn btn-primary form-control">Upload File</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->

                        <?php
                        // <!-- insert part -->
                            if(isset($_POST['save'])){
                                // terima data                                 
                                $rec_Part_number = $_POST ['Part_number'];
                                $rec_customer = $_POST ['customer'];
                                $rec_area = $_POST ['area'];
                                $rec_wh = $_POST ['wh'];

                                // tambahkan ke database    
                                $add = mysqli_query($conn,"INSERT INTO part_prod VALUES ('$rec_Part_number','$rec_customer','$rec_wh','$rec_area')");
                                echo '<script languange="javascript">
                                        swal.fire({
                                            title: "Success",
                                            text: "Part (Produksi) Ditambahkan",
                                            icon:"success",
                                        }).then(function(){
                                            window.location.href="part_prod.php";
                                            });
                                    </script>';  
                            }
                        // <!-- insert part end-->
                        ?>

                        <?php
                            if(isset($_POST['submit_file_pp'])){
                                $err="";
                                $ekstensi= "";
                                $succes= "";

                                $file_name= $_FILES['file']['name'];
                                $file_data= $_FILES['file']['tmp_name'];

                                if(empty($file_name)){
                                    $err= "<li>masukan file</li>"; 
                                }
                                else{
                                    $ekstensi= pathinfo($file_name)['extension'];
                                }

                                $ekstensi_allowed= array("xls","xlsx","csv");
                                if(!in_array($ekstensi, $ekstensi_allowed)){
                                    $err= "<script>
                                                Swal.fire({            
                                                    icon: 'error',                   
                                                    title: 'Error',    
                                                    text: 'you must upload file xls or xlsx',
                                                })
                                            </script>";
                                }

                                if(empty($err)){
                                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
                                    $spreadsheet= $reader->load($file_data);
                                    $sheet_data= $spreadsheet->getActiveSheet()->toArray();

                                    $jumlah_data_pp= 0;
                                    for($i=1;$i<count($sheet_data);$i++){
                                        $part_no_pp= $sheet_data [$i]['0'];
                                        $id_cust_pp= $sheet_data [$i]['1'];
                                        $id_area_pp= $sheet_data [$i]['2'];
                                        $id_line_pp= $sheet_data [$i]['3'];

                                        $add_data = mysqli_query($conn,"INSERT INTO part_prod VALUES ('$part_no_pp','$id_cust_pp','$id_area_pp','$id_line_pp')");
                                       
                                        $jumlah_data_pp++;
                                        
                                    }
                                    if($jumlah_data_pp > 0){
                                        echo '<script languange="javascript">
                                                    swal.fire({
                                                        title: "Success",
                                                        text: "upload success",
                                                        icon: "success",
                                                        timer: 1500
                                                    });
                                                    </script>';
                                    }
                                }

                                if($err){
                                    echo "$err";
                                }
                                if($succes){
                                    echo "$succes";
                                }
                            }
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
                                                            <table class="table table-striped part_produksi datas">
                                                                <thead>
                                                                <th>PART NUMBER</th> 
                                                                <th>CUSTOMER</th>
                                                                <th>LINE</th>
                                                                <th>WAREHOUSE</th>
                                                                <th>ACTION</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $customer_part = mysqli_query ($conn,"SELECT cs.customer,
                                                                                                                    li.name_line, 
                                                                                                                    pp.part_no,
                                                                                                                    ar.nama_area
                                                                                                        FROM part_prod pp
                                                                                                        left join line li on pp.id_line=li.id_line
                                                                                                        left join customer_prod cs on pp.customer_id=cs.id 
                                                                                                        left join area ar on ar.id=pp.id_area
                                                                                                        order by pp.part_no asc");
                                                                        foreach($customer_part AS $data){
                                                                        $part_no = $data['part_no'];  
                                                                        $customer = $data['customer']; 
                                                                        $area = $data['name_line']; 
                                                                        $wh = $data['nama_area']; 
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $part_no; ?></td>
                                                                        <td><?php echo $customer; ?></td>
                                                                        <td><?php echo $area; ?></td>
                                                                        <td><?php echo $wh; ?></td>
                                                                        <td>
                                                                            <a href="../deleteMasterData/delete_part_prod.php?part_no=<?php echo $part_no; ?>" class="alert_notif">
                                                                                <button type='button' class='btn btn-danger btn-round text-dark'>Hapus &nbsp;&nbsp;<i class="ti-trash"></i></button>
                                                                            </a>
                                                                            <a href="../UpdateMasterData/update_part_prod.php?part_no=<?php echo $part_no;?>"> 
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
</body>
    <!-- datatables -->
    <script type="text/javascript" >
        $(document).ready(function() {
            $('.datas').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    <!-- datatables -->
    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function(){
            $(this).find('[autofocus]').focus();
        });
    </script>
</html>
