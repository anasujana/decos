<!DOCTYPE html>
<html lang="en">
<?php
session_start();
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randomstring = $characters[rand(0, $charactersLength - 1)];
    }
    return $randomstring;
}
require_once(__DIR__ . '/vendor/autoload.php');
require "session.php";
date_default_timezone_set('Asia/Jakarta')
?>

<head>
    <title>Chekshet & Sumary Delivery </title>
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
    <!-- sweet alert -->
    <script src="assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
    <!-- sweet alert -->
    <style type="text/css" media="print">
        .print-none {
            display: none;
        }

        @media print {
            .print-none {
                display: none !important;
            }
        }
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
                                            <p class="m-b-10">Schedule & Sumary Delivery</p>
                                            <h5 class="m-b-0"><?php echo $_SESSION['nama_area']; ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb-title">
                                            <li>
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Andon Monitoring</a>
                                                    </li>
                                                </ul>
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
                                            <!-- Basic table card start -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <form action="" method="GET">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-2">
                                                                        Filter Tanggal :
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="tgl_mulai" class="form-control form-control-round">
                                                                    </div>
                                                                    <div class="col-sm1">
                                                                        <h3>-</h3>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="date" name="tgl_akhir" class="form-control form-control-round">
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <button type="submit" class="btn btn-info btn-round text-dark"><i class="ti-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="card-header-right">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    Create Plan :
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <button type="button" style="background-color: #3d9cdd;" class="btn btn- btn-round text-dark" data-toggle="modal" data-target="#upload_excel">Upload Excel &nbsp;&nbsp;<i class="ti-upload"></i></button>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <button type="button" style="background-color: #82C0E9;" class="btn btn- btn-round rounded-1 text-dark" data-toggle="modal" data-target="#upload_manual">Input Manual &nbsp;&nbsp;<i class="ti-upload"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style d-print-none">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped" id="tableSumary">
                                                                <thead>
                                                                    <th>NO</th>
                                                                    <th>CUSTOMER</th>
                                                                    <th>TANGGAL (PLAN)</th>
                                                                    <th>TANGGAL (ACTUAL)</th>
                                                                    <th>CYCLE</th>
                                                                    <th>JAM</th>
                                                                    <th>PART NUMBER</th>
                                                                    <th>PART NAME</th>
                                                                    <th>QTY PER BOX</th>
                                                                    <th>PLAN</th>
                                                                    <th>ACTUAL</th>
                                                                    <th>BALANCE</th>
                                                                    <th>NO DELIVERY</th>
                                                                    <th>NO SJ</th>
                                                                    <th>ACTION</th>
                                                                </thead>
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

    <!-- Modal plan deliv-->
    <div class="modal fade" id="upload_manual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Plan Delivery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="plan_delivery/plan_deliv.php" method='POST'>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="Region" class="col-sm-4 col-form-label">Customer :</label>
                            <div class="col-sm-12">
                                <select name="customer" onchange="myFunction()" class="form-control form-control-round customer" required>
                                    <option value="">-- Pilih Customer --</option>
                                    <?php
                                    $cust = mysqli_query($conn, "SELECT id, customer FROM customer_deliv cd WHERE id_area='$_SESSION[id_area]'");
                                    foreach ($cust as $data_cus) {
                                        $id_cs = $data_cus['id'];
                                        $customer = $data_cus['customer'];
                                    ?>
                                        <option value="<?php echo $id_cs; ?>"><?php echo $customer; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal : </label>
                            <div class="col-sm-12">
                                <input type="date" name="tgl_deliv" class="form-control form-control-round" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cycle :</label>
                            <div class="col-sm-12">
                                <select name="cycle_deliv" class="form-control form-control-round cycle_deliv" onchange="jamCycle()" required>
                                    <option value="">-- pilih Cycle --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jam :</label>
                            <div class="col-sm-12">
                                <input type="time" id="time_deliv" class="form-control form-control-round" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">No Order <strong>(OPSIONAL)</strong>: </label>
                            <div class="col-sm-12">
                                <input type="text" name="no_order_deliv" class="form-control form-control-round" value="" placeholder="Input no DN atau angka 1,2,3">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="reset" class="btn btn-secondary btn-round">Reset</button>&nbsp;
                        <button type="submit" name="simpan" value="" class="btn waves-effect waves-light btn-info btn-round">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal end-->

    <!-- Modal upload excel-->
    <div class="modal fade" id="upload_excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Plan Delivery :</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="file-upload-form" method="" enctype="multipart/form-data" action="">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="file" class="form-control" name="file">
                            </div>
                        </div>
                        <div id="response"></div>
                    </div>
                    <div class="modal-footer">
                        <a href="formatUploadFile/format_upload_plan.php">
                            <button type="button" class="btn btn-secondary form-control">Download Format Upload</button>
                        </a>
                        <button type="submit" name="submit_file" class="btn btn-primary form-control">Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="assets/pages/widget/excanvas.js "></script>
    <!-- sweet alert -->
    <script src="assets/js/swetalert2/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
    <!-- sweet alert -->
    <link rel="stylesheet" href="assets/DataTables/cdn.datatables.net_1.13.5_css_jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/DataTables/cdn.datatables.net_buttons_2.4.1_css_buttons.dataTables.min.css">
    <script src="assets/DataTables/cdn.datatables.net_1.13.5_js_jquery.dataTables.min.js"></script>
    <sript src="assets/DataTables/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js">
        </script>
        <script src="assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_dataTables.buttons.min.js"></script>
        <script src="assets/DataTables/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_pdfmake.min.js"></script>
        <script src="assets/DataTables/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_vfs_fonts.js"></script>
        <script src="assets/DataTables/cdnjs.cloudflare.com_ajax_libs_jszip_3.10.1_jszip.min.js"></script>
        <script src="assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_buttons.html5.min.js"></script>
        <script src="assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_buttons.colVis.min.js"></script>
        <script src="assets/DataTables/cdn.datatables.net_buttons_2.4.1_js_buttons.print.min.js"></script>
        <script src="assets/DataTables/cdn.datatables.net_select_1.7.0_js_dataTables.select.min.js"></script>

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
        <script type="text/javascript">
            var table = $('#tableSumary').DataTable({
                "ajax": 'sumary.php<?php
                                    if (isset($_GET['tgl_mulai']) and isset($_GET['tgl_akhir'])) {
                                        $tgl_mulai = $_GET['tgl_mulai'];
                                        $tgl_akhir = $_GET['tgl_akhir'];
                                        echo '?fil_tgl_mulai=' . $tgl_mulai;
                                        echo '&fil_tgl_akhir=' . $tgl_akhir;
                                    } else if (isset($_GET['no_filter'])) {
                                        $no_filter = $_GET['no_filter'];
                                        echo '?fil_no_filter=' . $no_filter;
                                    };
                                    ?>',
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        autoFilter: true,
                        sheetName: 'Exported data',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        },
                        extend: 'print',
                        text: 'Print'
                    },
                    'colvis'
                ],
                language: {
                    buttons: {
                        colvis: 'Hide Column'
                    },
                },
                columnDefs: [{
                    targets: -1,
                    visible: false
                }, ],
                select: true,
            });
            $(document).ready(function() {
                $("#file-upload-form").on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: 'upload.php', // The PHP file that handles the upload
                        type: 'POST',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            table.ajax.reload();
                            $("#response").html(response);
                            console.log("Form submitted successfully.");
                            $("#upload_excel").modal("hide");
                            console.log("Modal should be closed.");
                        }
                    });

                    return false;
                });
            });

            // cycle delivery
            function myFunction() {
                var id_cs = $(".customer").val();
                $(".cycle_deliv").load("plan_delivery/cycle.php?cs=" + id_cs + "")
            };
            //cycle delivery

            // jam delivery
            function jamCycle() {
                var cycle_deliv = $(".cycle_deliv").val();
                $.ajax({
                    type: 'GET',
                    url: 'plan_delivery/cycle_jam.php',
                    data: {
                        kcycle_deliv: cycle_deliv
                    },
                    success: function(data) {
                        console.log(data);
                        let obj = JSON.parse(data);
                        $('#time_deliv').val(obj.jam);
                    }
                })
            };
            // jam delivery
        </script>
        <!-- datatables -->


        <!-- jika ada session sukses maka tampilkan alert yang telah di set dalam session sukses  -->
        <?php if (@$_SESSION['sukses']) { ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'data berhasil dihapus',
                    timer: 2000,
                    showConfirmButton: false
                })
            </script>
            <!-- unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['sukses']);
        } ?>

        <!-- konfirmasi hapus data dengan sweet alert  -->
        <script>
            $('.alert_notif').on('click', function() {
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
                    if (result.isConfirmed) {
                        window.location.href = getLink
                    }
                })
                return false;
            });
        </script>
</body>

</html>