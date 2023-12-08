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
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

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
    <!-- menu js -->
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="../assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="../assets/js/script.js "></script>
    <link rel="stylesheet" href="../assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.css">
    <script src="../assets/DataTables/cdn.datatables.net_v_dt_dt-1.13.5_datatables.min.js"></script>
    <!-- sweet alert -->
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
                                  <div class="col-md-8">
                                        <div class="page-header-title">
                                          <h5 class="m-b-10">Area</h5>
                                          <p class="m-b-0">PT. Frina Lestari Nusantara</p>
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="">
                                            <button type="button" class="btn btn-white btn-round text-dark" data-toggle="modal" data-target="#add_area">Add Area <i class="ti-plus"></i></button>                             
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
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive table_area">                                                 
                                                            <table class="table table-striped datas">
                                                                <thead>
                                                                <th>AREA</th>
                                                                <th>DEPARTEMEN</th>
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
</body>

    <!-- Modal add area-->
    <div class="modal fade" id="add_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="" method="post" id="formArea">
                    <div class="form-row"> 
                        <div class="form-group col-md-12">
                            <label for="Nama">Nama Area</label>
                            <input type="text" name="sarea" id="area" class="form-control form-control-round" placeholder="Input Nama Area" autofocus>
                        </div>  
                        <div class="form-group col-md-12">
                            <label class="col-sm-12 col-form-label">Departemen</label>
                            <select name="sdept" id="dept" class="form-control form-control-round">
                                <option value="">-- Pilih Departemen--</option>
                                <?php
                                $dept = mysqli_query($conn,"SELECT id_dept, nama_dept FROM departemen order by nama_dept asc");
                                foreach ($dept AS $data_dept){
                                $id_dept = $data_dept['id_dept'];
                                $nama_dept = $data_dept['nama_dept'];
                                ?>                                         
                                    <option value="<?php echo $id_dept; ?>"><?php echo $nama_dept; ?></option> 
                                <?php
                                }
                                ?> 
                            </select>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                        <input type="button" id="save_area" class="btn btn-primary btn-round" value="Save">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- Modal edit area-->
    <div class="modal fade" id="edit_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row"> 
                        <input type="hidden" name="" id="edit_id">
                        <div class="form-group col-md-12">
                            <label for="Nama">Nama Area</label>
                            <input type="text" id="area_edit" class="form-control form-control-round" autofocus>
                        </div>  
                        <div class="form-group col-md-12">
                            <label class="col-sm-12 col-form-label">Departemen</label>
                            <select id="dept_edit" class="form-control form-control-round" required>
                                <option id="dept_edt" value="">-- Pilih departemen --</option>
                                <?php
                                $dept = mysqli_query($conn,"SELECT id_dept, nama_dept FROM departemen order by nama_dept asc");
                                foreach ($dept AS $data_dept){
                                $id_dept = $data_dept['id_dept'];
                                $nama_dept = $data_dept['nama_dept'];
                                ?>                                         
                                    <option value="<?php echo $id_dept; ?>"><?php echo $nama_dept; ?></option> 
                                <?php
                                }
                                ?> 
                            </select>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                        <input type="button" id="save_edit" class="btn btn-primary btn-round" value="Save">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- datatables -->
    <script type="text/javascript" >
        //akses data json
        var table = $('.datas').DataTable({
            "ajax":'view_area.php?',
        })
    </script>
    <!-- datatables -->

    <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function(){
            $(this).find('[autofocus]').focus();
        });
    </script>

    <script type="text/javascript">
        // insert area
        $(document).ready(function(){
            $("#save_area").click(function(){
                var data = $('#formArea').serialize();
                $.ajax({
                    type: 'POST',
                    url: "../saveMaterData/save_area.php",
                    data: data,
                    success: function() {
                        $('#add_area').modal('hide');
                        table.ajax.reload();
                        Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Data berhasil ditambahakan',
                                    timer: 1500
                                })
                    }
                });
            });
        });
        // $( ".formuser" ).on( "submit", function( event ) {
        //     var data = $('.formuser').serialize();
        //     console.log(data)
        //         $.ajax({
        //             type: 'POST',
        //             url: "../saveMaterData/save_area.php",
        //             data: data,
        //             success: function() {
        //                 $('#add_area').modal('hide');
        //                 table.ajax.reload();
        //                 Swal.fire({
        //                             icon: 'success',
        //                             title: 'Success',
        //                             text: 'Data berhasil ditambahakan',
        //                             timer: 20500
        //                         })
        //             }
        //         });
        // });
    </script>

    <script type="text/javascript" >
        // konfirmasi hapus data dengan sweet alert
        $(document).on('click', '.delete_data', function() {
            var ide = $(this).data("id3");
            // console.log(ide)
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
                    $.ajax({
                        method: "POST",
                        url: "../deleteMasterData/delete_area.php",
                        data: {id_ar:ide},
                        success	: function(){
                        table.ajax.reload();
                        Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Data berhasil dihapus',
                                    timer: 1500
                                })
                    }
                    });
                }
            })
            return false;
        });

    </script>

    <script type="text/javascript">
        // edit area
        $('#save_edit').on("click",function(){
            var edit_id = $ ("#edit_id").val();
            var area_edit = $ ("#area_edit").val();
            var dept_edit = $ ("#dept_edit").val();
            console.log(edit_id);
            $.ajax({
                method: "POST",
                url: "../UpdateMasterData/update_area.php",
                data: {sedit_id:edit_id, 
                        sarea_edit:area_edit,
                        sdept_edit:dept_edit
                    },
                success	: function(){
                $('#edit_area').modal('hide');
                table.ajax.reload();
                Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil diupdate',
                            timer: 1500
                    })
                }
            });
        });
    </script>

    <script>
        // set data pada modal
        $('.datas').on('click','.edit_area',function(){
        var id = this;
        var id1 = $(this).data('idarea');
        $('#edit_id').val(id1);
        })

        $('.datas').on('click','.edit_area',function(){
            var id = this;
            var id1 = $(this).data('area');  
            $('#area_edit').val(id1);
        })
        
        $('.datas').on('click','.edit_area',function(){
            var id = this;
            var id1 = $(this).data('dept');
            $('#dept_edit').val(id1);
        })

        $('.datas').on('click','.edit_area',function(){
            var id = this;
            var id1 = $(this).data('dept');
            $('#dept_edt').val(id1);
        })
    </script>
</html>
