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
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css"> <link rel="stylesheet" type="text/css" href="../assets/css/style.css"><!-- Required Jquery -->
    <script type="text/javascript" src="../assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="../assets/pages/widget/excanvas.js "></script>
    <!-- sweet alert -->
    <script src="../assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
    <!-- sweet alert -->

    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.css">
    <script src="../assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.js"></script>
    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_1.13.5_css_jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_buttons_2.4.1_css_buttons.dataTables.min.css">
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
                                        <h5 class="m-b-10">List Part</h5>
                                        <p class="m-b-0">PT. Frina Lestari Nusantara</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row justify-content-end">
                                        <div class="col-md-5 text-right">
                                            <button type="button" class="btn btn-white btn-round text-dark" data-toggle="modal" data-target="#upload_excel_lp">Upload Data <i class="ti-upload"></i></button>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <button type="button" class="btn btn-white btn-round text-dark" data-toggle="modal" data-target="#add_lp">Add Part <i class="ti-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Page-header end -->
                    
                        <!-- Modal add part-->
                        <div class="modal fade" id="add_lp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                    <input type="text" name="part_number" id="part_number" class="form-control " placeholder="Input Part No FLN" autofocus onkeyup="code1()">
                                                </div>  
                                                <div class="form-group col-md-12">
                                                    <label for="Nama">Part Name</label>
                                                    <input type="text" name="part_name" id="part_name" class="form-control " placeholder="Input Part Name" onkeyup="code2()">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="Nama">Part No Cust</label>
                                                    <input type="text" name="part_number_cst" class="form-control " placeholder="Input Part No Customer">
                                                </div> 
                                                <div class="form-group col-md-6">
                                                    <label for="Nama">Code 1</label>
                                                    <input type="text" id="parent" name="code_4" class="form-control form-control-" placeholder="RH/LH">
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="Nama">Code 2</label>
                                                    <input type="text" id="child" name="code_5" class="form-control form-control-" placeholder="RHD/LHD">
                                                </div>    
                                                <div class="form-group col-md-6">
                                                    <label for="Nama">Code 3</label>
                                                    <input type="text" name="code_2" class="form-control form-control-" placeholder="std, high, etc">
                                                </div>  
                                                <div class="form-group col-md-6">
                                                    <label for="Nama">Code 4</label>
                                                    <input type="text" name="code_3" class="form-control form-control-" placeholder="Input Color Code">
                                                </div>  
                                                <div class="form-group col-md-12">
                                                    <label for="Nama">Qty/Box</label>
                                                    <input type="number" name="qty" class="form-control " placeholder="Input SNP">
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
                        <div class="modal fade" id="upload_excel_lp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload List Part :</h5>
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
                                        <button type="submit" name="submit_file_lp" class="btn btn-primary form-control">Upload File</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->

                        <?php
                        if(isset($_POST['save'])){
                                // terima data                                 
                                $Part_number = $_POST ['part_number'];
                                $Part_name = $_POST ['part_name'];
                                $Part_number_cst = $_POST ['part_number_cst'];
                                $parent = $_POST ['code_4'];
                                $child = $_POST ['code_5'];
                                $code_2 = $_POST ['code_2'];
                                $code_3 = $_POST ['code_3'];
                                $qty= $_POST ['qty'];

                                // tambahkan ke database    
                                $addd = mysqli_query($conn,"INSERT INTO list_part VALUES ('$Part_number','$Part_name','$Part_number_cst','$parent','$child','$code_2','$code_3','$qty')"); 
                                echo '<script languange="javascript">
                                        swal.fire({
                                            title: "Success",
                                            text: "Part Ditambahkan",
                                            icon:"success",
                                        }).then(function(){
                                            window.location.href="list_part.php";
                                            });
                                    </script>'; 
                            }
                        ?>

                        <?php
                            if(isset($_POST['submit_file_lp'])){
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

                                    $jumlah_data_lp= 0;
                                    for($i=1;$i<count($sheet_data);$i++){
                                        $part_no_lp= $sheet_data [$i]['0'];
                                        $part_name_lp= $sheet_data [$i]['1'];
                                        $part_no_cst_lp= $sheet_data [$i]['2'];
                                        $code_1_lp= $sheet_data [$i]['3'];
                                        $code_2_lp= $sheet_data [$i]['4'];
                                        $code_3_lp= $sheet_data [$i]['5'];
                                        $code_4_lp= $sheet_data [$i]['6'];
                                        $qty_lp= $sheet_data [$i]['7'];

                                        $upload_lp= "insert into list_part(part_no,part_name,part_no_cst,parent_code,child_code,add_code,colour_code,qty_box)
                                        VALUES('$part_no_lp','$part_name_lp','$part_no_cst_lp','$code_1_lp','$code_2_lp','$code_3_lp','$code_4_lp','$qty_lp')";

                                        mysqli_query($conn, $upload_lp);
                                        $jumlah_data_lp++;
                                        
                                    }
                                    if($jumlah_data_lp > 0){
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
                                                            <table class="table table-striped part_list datas">
                                                                <thead>
                                                                <th>PART NUMBER</th> 
                                                                <th>PART NAME</th>
                                                                <th>PART NO CUST</th>
                                                                <th>CODE 1</th>
                                                                <th>CODE 2</th>
                                                                <th>CODE 3</th>
                                                                <th>CODE 4</th>
                                                                <th>QTY/BOX</th>
                                                                <th>ACTION</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $list_part = mysqli_query ($conn,"SELECT * FROM list_part order by part_no asc");
                                                                        foreach($list_part AS $data){
                                                                        $part_no = $data['part_no'];  
                                                                        $part_name = $data['part_name']; 
                                                                        $part_no_cust = $data['part_no_cst']; 
                                                                        $parent_code = $data['parent_code']; 
                                                                        $child_code = $data['child_code']; 
                                                                        $add_code = $data['add_code']; 
                                                                        $colour_code = $data['colour_code']; 
                                                                        $qty_box = $data['qty_box']; 
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $part_no; ?></td>
                                                                        <td><?php echo $part_name; ?></td>
                                                                        <td><?php echo $part_no_cust; ?></td>
                                                                        <td><?php echo $parent_code; ?></td>
                                                                        <td><?php echo $child_code; ?></td>
                                                                        <td><?php echo $add_code; ?></td>
                                                                        <td><?php echo $colour_code; ?></td>
                                                                        <td><?php echo $qty_box; ?></td>
                                                                        <td class="icon-btn">
                                                                        <a href="../deleteMasterData/delete_list_part.php?part_no=<?php echo $part_no; ?>" class="alert_notif"> 
                                                                                <button type='button' class='btn btn-danger btn-round text-dark'>Hapus &nbsp;&nbsp;<i class="ti-trash"></i></button>
                                                                            </a>
                                                                            </a>
                                                                            <a href="../UpdateMasterData/update_list_part.php?id_part=<?php echo $part_no;?>"> 
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
    <script>
        // isi rh/lh
        function code1(){
            var no_part = $("#part_number").val();
            $.ajax({
                type : 'GET',
                url: 'parent_code.php',        
                data : 'no_part='+no_part,
                success :function(data){
                console.log(data);
                let obj = JSON.parse(data);
                $('#parent').val(obj.parent_code);
                }
            })
        };
        // fiter rh/lh

        // isi rhd/lhd
        function code2(){
            var part_name = $("#part_name").val();
            $.ajax({
                type : 'GET',
                url: 'child_code.php',        
                data : 'part_name='+part_name,
                success :function(data){
                console.log(data);
                let obj = JSON.parse(data);
                $('#child').val(obj.child_code);
                }
            })
        };
        // fiter rhd/lhd
    </script>

    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function(){
            $(this).find('[autofocus]').focus();
        });
    </script>
</html>
