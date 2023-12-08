<?php 
    session_start();
    require "session.php";
    require './koneksi/koneksi.php'; 
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
    <!-- <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all"> -->
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
    <style>
    @page { size:  auto; margin: 50px; }
    </style>
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
                    <div class="page-header d-print-none">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">Label Produksi</h5>
                                        <p class="m-b-0">Create label produksi with QR CODE</p>
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
                                                    <h5>Print Label Produksi</h5>
                                                </div>
                                                <div class="card-body">                                                   
                                                    <form target="_blank" action="label_print.php" method='POST'>   
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Line</label>
                                                            <div class="col-sm-12">
                                                                <select name="" id="id_line" onchange="myFunction()" class="form-control form-control-round">
                                                                    <option value="">-- PILIH LINE --</option>
                                                                    <?php
                                                                        $data_line = mysqli_query($conn, "SELECT * FROM line ORDER BY name_line asc");
                                                                        foreach ($data_line AS $line_data){
                                                                            $id_line = $line_data["id_line"];
                                                                            $line = $line_data["name_line"];
                                                                            ?>
                                                                                <option value="<?php echo $id_line; ?>"><?php echo $line; ?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>   
                                                        <div class="form-group row">
                                                            <label for="Region" class="col-sm-2 col-form-label">Part No</label>
                                                            <div class="col-sm-12">
                                                                <select name="content" id="content" class="form-control form-control-round" onchange="qtyQr()">
                                                                    <option value="">-- PILIH PART NUMBER --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Qty/Box</label>
                                                            <div class="col-sm-12">
                                                                <input type="number" name="qty_qr" id="qty_qr"
                                                                class="form-control form-control-round" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Tanggal Produksi</label>
                                                            <div class="col-sm-12">
                                                                <input type="date" name="Tanggal" id="Tanggal"
                                                                class="form-control form-control-round"
                                                                placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Shift</label>
                                                            <div class="col-sm-12">
                                                                <input type="number"name="Shift" id="Shift"
                                                                class="form-control form-control-round"
                                                                placeholder="1/2/3">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">No mesin/line</label>
                                                            <div class="col-sm-12">
                                                                <input type="number" name="Line" id="Line"
                                                                class="form-control form-control-round"
                                                                placeholder="Input No Mesin">
                                                            </div>
                                                        </div>  
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Leader</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="Leader" id="Leader"
                                                                class="form-control form-control-round"
                                                                placeholder="Input Nama Leader Produksi">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Qty label</label>
                                                            <div class="col-sm-12">
                                                                <input type="number" name="qty_label" id="qty"
                                                                class="form-control form-control-round"
                                                                placeholder="Input Qty Label" required>
                                                            </div>
                                                        </div>                                                                                                                         
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label"></label>
                                                            <div class="col-sm-12">
                                                                <button type="submit" name="simpan" value="Generate" class="btn waves-effect waves-light btn-info btn-round btn-block">SUBMIT</button>
                                                            </div>
                                                        </div>
                                                    </form>                                                
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

    <script type="text/javascript">
        // fiter line
        function myFunction(){
            var id_line = $("#id_line").val();
            $("#content").load("qr_code/no_part.php?line="+id_line+"")
        };
        // fiter line

        // isi snp
        function qtyQr(){
            var no_part = $("#content").val();
            $.ajax({
                type : 'GET',
                url: 'qr_code/qty_box.php',        
                data : 'no_part='+no_part,
                success :function(data){
                console.log(data);
                let obj = JSON.parse(data);
                $('#qty_qr').val(obj.qty);
                }
            })
        };
        // fiter snp
    </script>
    
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="assets/pages/widget/excanvas.js "></script>
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
