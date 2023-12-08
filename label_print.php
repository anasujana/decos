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
    <style>
    @page { size:  auto; margin: 19px; }
    td { 
        text-align: center;
        font-size: 7px;"
    }
    </style>
</head>
<body>
    <?php
        include('koneksi/koneksi.php');

        if (isset($_POST['simpan'])) {
        $qty_label = $_POST['qty_label'];
        ?>
        <div class="col-md-12">                                        
            <div class="card shadow mb-12">
                <div class="card-header d-print-none">
                    <div class="row">
                        <div class="col-12">
                        <a href="javascript:window.print()">
                            <button  class="btn btn-warning btn-round text-dark">PRINT&nbsp;&nbsp;<i class="ti-printer"></i></i></button>
                        </a>
                        <a href="label_snp.php">
                            <button  class="btn btn-round btn-info text-dark">BACK&nbsp;&nbsp;<i class="ti-back-left"></i></button>
                        </a>
                        </div>
                    </div>   
                </div>                                               
                <div class="card-body">
                    <div class="row">                  
                        <?php
                        include "phpqrcode/qrlib.php";

                        for ($x = 1; $x <= $qty_label; $x++) {  

                            $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
                            if (!file_exists($tempdir)) //Buat folder bername temp
                            mkdir($tempdir);

                            //isi qrcode jika di scan
                            $codeContents = $_POST['content'];
                            $qty_box = $_POST['qty_qr'];

                            $qr_content = $codeContents."/".$qty_box;
                            
                            //nama file qrcode yang akan disimpan
                            $namaFile=$_POST['content'].".png";
                            $tanggal = $_POST['Tanggal'];
                            $Shift = $_POST['Shift'];
                            $Line1 = $_POST['Line'];
                            $Line = ".".$Line1;
                            $Leader = $_POST['Leader'];

                            //ECC Level
                            $level=QR_ECLEVEL_H;
                            //Ukuran pixel
                            $UkuranPixel=10;
                            //Ukuran frame
                            $UkuranFrame=4;

                            QRcode::png($qr_content,$tempdir."$namaFile",$level,$UkuranPixel,$UkuranFrame);
                            
                            $cst = mysqli_fetch_array(mysqli_query ($conn,"SELECT cs.customer,
                                                                                    cp.part_no, 
                                                                                    lp.part_no_cst,
                                                                                    lp.part_name,
                                                                                    lp.qty_box,
                                                                                    lp.parent_code,
                                                                                    lp.child_code,
                                                                                    lp.add_code,
                                                                                    lp.colour_code
                                                                            FROM part_prod cp 
                                                                            left join list_part lp on cp.part_no=lp.part_no 
                                                                            left join customer_prod cs on cp.customer_id=cs.id
                                                                            where cp.part_no='$codeContents'"));
                            $Customer =  $cst['customer'];
                            $part_name =  $cst['part_name'];
                            $part_no =  $cst['part_no']; 
                            $part_no_cst =  $cst['part_no_cst'];
                            $parent_code =  $cst['parent_code']; 
                                if($parent_code!=null){
                                    $parent_code="$parent_code";
                                }else{
                                    $parent_code= "-";
                                }
                            $child_code =  $cst['child_code'];
                                if($child_code!=null){
                                    $child_code="$child_code";
                                }else{
                                    $child_code= "-";
                                }
                            $add_code =  $cst['add_code'];
                                if($add_code!=null){
                                    $add_code="$add_code";
                                }else{
                                    $add_code= "-";
                                }
                            $colour_code =  $cst['colour_code'];
                                if($colour_code!=null){
                                    $colour_code="$colour_code";
                                }else{
                                    $colour_code= "-";
                                }    
                        
                            ?>
                                                
                            <div class="col-sm-6">
                                <table style="width: 50px;" border="1">
                                    <tbody>
                                        <tr >
                                            <td colspan="2">&nbsp;No Form : F.PRO.45.REV.01&nbsp;</td>
                                            <td colspan="4">Tgl Efektif : 07 Agustus 2017&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle text-center">&nbsp;
                                                <img class="img-fluid" width="30px" src="assets/images/FLN.png" alt="" />
                                            </td>
                                            <td style="text-align: center; font-size: 11px;" colspan="4"><strong>LABEL PACKAGING </strong>&nbsp;&nbsp;&nbsp;</td>
                                            <td style="text-align: center; font-size: 31px;" rowspan="2"><strong><?php echo $parent_code; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl prod</td>
                                            <td>&nbsp;Shift&nbsp;</td>
                                            <td>&nbsp;Lot No Prod&nbsp;</td>
                                            <td colspan="2">Customer &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td ><?php echo $tanggal; ?></td>
                                            <td ><?php echo $Shift; ?></td>
                                            <td >&nbsp;
                                                <?php 
                                                if(isset($Line1) and $Line1!=null){
                                                    $Tgl_lot = date("Y.m.d",strtotime ($tanggal));
                                                    $Tgl_lot_prod = substr("$Tgl_lot",2).".";
                                                    echo $Tgl_lot_prod,$Shift,$Line;
                                                }else if(!isset($Line1) and $Line1=null){
                                                    echo '-';
                                                }
                                                ?>&nbsp;
                                            </td>
                                            <td style="text-transform: uppercase; font-size: 8px;" colspan="2">&nbsp;<strong><?php echo $Customer; ?></strong>&nbsp;</td>
                                            <td style="font-size: 31px;" rowspan="2"><strong><?php echo $child_code; ?></strong></td>
                                        </tr>
                                        <tr >
                                            <td colspan="2">Part No&nbsp;</td>
                                            <td colspan="3">Part Name&nbsp;&nbsp;</td>
                                        </tr>
                                        <tr >
                                            <td colspan="2" style="font-size: 13px;"><?php echo "<strong>".$part_no ."<br>".$part_no_cst."</strong>";?></td>
                                            <td colspan="3" style="font-size: 8px;">&nbsp;<?php echo $part_name; ?>&nbsp; </td>
                                            <td style="font-size: 31px;"><strong><?php echo $add_code; ?></strong></td>
                                        </tr>
                                        <tr >
                                            <td >Colour</td>
                                            <td >&nbsp;QTY&nbsp;</td>
                                            <td >Leader</td>
                                            <td >&nbsp;Man Power &nbsp;<br>Produksi</td>
                                            <td >&nbsp;Man Power &nbsp;<br>Quality</td>
                                            <td rowspan="2"><?php echo'<img src="'.$tempdir.$namaFile.'" width="65px"/>';?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 24px;"><strong><?php echo $colour_code; ?></strong></td>
                                            <td style="font-size: 9px;"><?php echo $qty_box; ?></td>
                                            <td style="text-transform: uppercase; font-size: 9px;"><?php echo $Leader; ?></td>
                                            <td >&nbsp;
                                                <?php ?>
                                            </td>
                                            <td >&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table> 
                                <br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>                       
                </div>
            </div>                    
        </div>
    <?php                                                             
    }
    ?>    
</body>
</html>
