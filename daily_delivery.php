<?php
    session_start();
    include('koneksi/koneksi.php');
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
    <!-- am chart export.css -->
    <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                   <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <div class="row">
                                          <!-- task, page, download counter  start -->
                                            <?php
                                                $now_month = date("m");
                                                $now_year = date("Y");
                                                mysqli_query($conn,"CREATE TEMPORARY TABLE acm_wh_total SELECT
                                                                                                        SUM(plan) AS plan_total,
                                                                                                        SUM(
                                                                                                            (SELECT SUM(qty) 
                                                                                                            FROM prepare pr 
                                                                                                            WHERE pr.part_no_prep = p.part_no 
                                                                                                            AND pr.no_delivery = p.no_delivery
                                                                                                            AND p.no_delivery NOT LIKE '%REC%')
                                                                                                        ) AS act_total
                                                                                                    FROM plan p
                                                                                                    LEFT JOIN surat_jalan sj ON sj.no_delivery = p.no_delivery
                                                                                                    WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl) = '$now_year'
                                                                                                    ");
                                                $total_del_acm = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM acm_wh_total"));
                                                $total_plan1 = $total_del_acm['plan_total'];
                                                $total_act1 = $total_del_acm['act_total'];
                                                $total_min1 = $total_plan1-$total_act1;

                                                if($total_act1==null){
                                                    $achtotal = "0";
                                                }else{
                                                    $achtotal = ($total_act1/$total_plan1)*100;
                                                    $achtotal = round($achtotal,1);
                                                }
                                            ?>
                                          <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-purple"><?php echo $total_plan1 ?></h4>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-purple">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Plan</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-green"><?php echo $total_act1 ?></h4>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Actual</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-red"><?php echo $total_min1 ?></h4>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-red">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Minus</p>
                                                            </div>
                                                            <div class="col-3 text-right">                                                                                                      
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue"><?php echo $achtotal."%" ?></h4>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">Total Achievement</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->
                                          <!--  plan vs act deliv -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <form action="" method="post">
                                                            <div class="form-group row">
                                                                <!-- <div class="col-sm-1">
                                                                        pilih bln & thn :
                                                                </div> -->
                                                                <div class="col-sm-2">
                                                                    <select id="bulan-filter" class="form-control">
                                                                        <option value="01">Januari</option>
                                                                        <option value="02">Februari</option>
                                                                        <option value="03">Maret</option>
                                                                        <option value="04">April</option>
                                                                        <option value="05">Mei</option>
                                                                        <option value="06">Juni</option>
                                                                        <option value="07">Juli</option>
                                                                        <option value="08">Agustus</option>
                                                                        <option value="09">September</option>
                                                                        <option value="10">Oktober</option>
                                                                        <option value="11">November</option>
                                                                        <option value="12">Desember</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                <select name='tahun' class="form-control" id="inlineFormCustomSelect">
                                                                    <?php
                                                                    $mulai = date('Y') - 50;
                                                                    $filterTahun = isset($_POST['tahun']) ? $_POST['tahun'] : ''; // Ganti $_POST dengan sumber data yang sesuai

                                                                    // Tambahkan opsi "Pilih Tahun" sebagai default jika tidak ada filter yang dipilih
                                                                    echo '<option value=""' . ($filterTahun == '' ? ' selected="selected"' : '') . '>Pilih Tahun</option>';

                                                                    for ($i = $mulai; $i < $mulai + 100; $i++) {
                                                                        $sel = $i == $filterTahun ? ' selected="selected"' : '';
                                                                        echo '<option value="' . $i . '"' . $sel . '>' . $i . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>

                                                                </div>
                                                            <div class="col-sm-1">
                                                                    <button type="submit" class="btn btn-info btn-round text-dark"><i class="ti-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="chartAch" style="height: 400px;">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  plan vs act deliv -->
                                            

                                             <!-- deliv statistik -->
                                             <div class="col-xl-9 col-md-12">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div id="deliv_tgl" style="height: 400px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- deliv statistik -->

                                            <!-- deliv status -->
                                            <div class="col-xl-3 col-md-12">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div id="deliv_status" style="height: 400px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- deliv status -->
                                           
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
    <!-- apex -->
    <script src="assets/js/apex.js/cdn.jsdelivr.net_npm_apexcharts"></script>
    <!-- apex -->
    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js "></script>
    <!-- custom js -->
    <script type="text/javascript" src="assets/js/script.js "></script>

    <script>
        var options = {
            series: [{
            name: 'plan',
            type: 'column',
            data: [<?php
                        $now_month = date("m");
                        $now_year = date("Y");
                                                            
                        $deliv_tgl = mysqli_query($conn, "SELECT p.tgl,
                                                                    SUM(plan) AS planning,
                                                                    SUM(
                                                                        CASE
                                                                            WHEN p.tgl = p.tgl_kirim THEN
                                                                                (SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no AND pr.no_delivery = p.no_delivery)
                                                                            ELSE 0
                                                                        END
                                                                    ) AS actual
                                                                FROM plan p
                                                                LEFT JOIN customer_deliv cd ON cd.id = p.id_customer
                                                                LEFT JOIN surat_jalan sj ON sj.no_delivery = p.no_delivery
                                                                WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl) = '$now_year'
                                                                GROUP BY p.tgl
                                                                ORDER BY p.tgl ASC
                                                                ");
                        $planing_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $planing_data[] = $data_tgl['planing'];
                        }
                        echo implode(",", $planing_data);
                    ?>]
            }, {
            name: 'actual',
            type: 'column',
            data: [<?php
                        $actual_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual_data[] = $data_tgl['actual'];
                        }
                        echo implode(",", $actual_data);
                    ?>]
            }, {
            name: 'achievement',
            type: 'line',
            data: [<?php
                        $ach_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual = $data_tgl['actual'];
                            $plan_tgl = $data_tgl['planing'];
                            if ($plan_tgl == 0) {
                                $achtotal = "0";
                            } else {
                                $achtotal = ($actual / $plan_tgl) * 100;
                                $achtotal = round($achtotal, 1);
                            }
                            $ach_data[] = $achtotal;
                        }
                        echo implode(",", $ach_data);
                    ?> ]
            }, {
            name: 'target',
            type: 'line',
            data: [<?php
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual = $data_tgl['actual'];
                            $plan_tgl = $data_tgl['planing'];
                            if ($plan_tgl == 0) {
                                $achtotal = "0";
                            } else {
                                $achtotal = ($actual / $plan_tgl) * 100;
                                $achtotal = round($achtotal, 1);
                            }
                            $ach_data = $achtotal;
                            echo "100".",";
                        }
                    ?> ]
            }
            ],
            chart: {
            height: 350,
            type: 'line',
            stacked: false,
            zoom: false,
            toolbar: false,
            },
            plotOptions: {
                bar: {
                dataLabels: {
                    orientation: 'vertical',
                    position: 'center' // bottom/center/top
                }
                }
            },
            dataLabels: {
                style: {
                colors: ['#E74C3C']
                },
                offsetY: 15, // play with this value
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [0,1,2], // Aktifkan dataLabels untuk seri "Achievement" (indeks 2)
                textAnchor: 'start',
                textOrientation: 'vertical',
                formatter: function(val, opts) {
                    if (opts.seriesIndex === 2) { // Hanya format label untuk series "ach"
                    return val.toFixed() + "%";
                    }
                    return val;
                },
                background: {
                    enabled: true,
                    foreColor: '#000', // Text color for the data labels
                    padding: 3, // Adjust the padding as needed
                    borderRadius: 2, // Adjust the border radius as needed
                    borderWidth: 2, // Adjust the border width as needed
                    borderColor: '', // Set the border color to match the series color
                },
                textAnchor: 'start',
                style: {
                    fontSize: '11px',
                    fontFamily: 'Helvetica, Arial, sans-serif',
                    fontWeight: 'bold',
                    colors: undefined
                },
            },
            stroke: {
            width: [1, 1, 4]
            },
            title: {
            text: 'Delivery Perfomance <?php echo date("F").' '.$now_year?>',
            align: 'left',
            offsetX: 0
            },
            xaxis: {
            categories: [<?php
                                foreach($deliv_tgl AS $data_tgl){
                                $tgl_deliv = $data_tgl['tgl'];
                            echo "'".$tgl_deliv."'".",";
                            }
                            ?>],
            },
            yaxis: [
                {
                    min: <?php echo min($planing_data); ?>, // Set min ke nilai minimum dari data plan
                    max: <?php echo max($planing_data); ?>, // Set max ke nilai maksimum dari data plan
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        }
                    },
                    title: {
                        text: "plan qty",
                        style: {
                            color: '#008FFB',
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                {
                    seriesName: 'plan',
                    opposite: true,
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            colors: '#00E396',
                        }
                    },
                    title: {
                        text: "act qty",
                        style: {
                            color: '#00E396',
                        }
                    },
                },
                {
                    min: 0, // Set min ke 0
                    max: 100, // Set max ke 100
                    seriesName: 'ach',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            colors: '#FEB019',
                        },
                    },
                    title: {
                        text: "achievement",
                        style: {
                            color: '#FEB019',
                        }
                    }
                },
            ],
            tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
            },
            legend: {
            horizontalAlign: 'left',
            offsetX: 40
            },
            redrawOnParentResize: true
            };
        var chart = new ApexCharts(document.querySelector("#chartAch"), options);
        chart.render();
    </script>

    <!-- deliv status -->
    <script>

        var options = {
            series: [{
            name: 'plan',
            type: 'column',
            data: [<?php
                        $now_month = date("m");
                        $now_year = date("Y");
                                                            
                        $deliv_tgl = mysqli_query($conn, "SELECT MONTH(tgl) as bln,
                                                            SUM(plan) AS planing,
                                                            SUM((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
                                                                                                        AND pr.no_delivery=p.no_delivery)) 
                                                            AS actual
                                                            FROM plan p 
                                                            left join customer_deliv cd on cd.id = p.id_customer 
                                                            LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
                                                            WHERE YEAR(tgl) = '$now_year'
                                                            GROUP BY MONTH(tgl) ORDER BY tgl ASC");
                        $planing_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $planing_data[] = $data_tgl['planing'];
                        }
                        echo implode(",", $planing_data);
                    ?>]
            }, {
            name: 'actual',
            type: 'column',
            data: [<?php
                        $actual_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual_data[] = $data_tgl['actual'];
                        }
                        echo implode(",", $actual_data);
                    ?>]
            }, {
            name: 'achievement',
            type: 'line',
            data: [<?php
                        $ach_data = [];
                        foreach ($deliv_tgl as $data_tgl) {
                            $actual = $data_tgl['actual'];
                            $plan_tgl = $data_tgl['planing'];
                            if ($plan_tgl == 0) {
                                $achtotal = "0";
                            } else {
                                $achtotal = ($actual / $plan_tgl) * 100;
                                $achtotal = round($achtotal, 1);
                            }
                            $ach_data[] = $achtotal;
                        }
                        echo implode(",", $ach_data);
                    ?> ]
            }],
            chart: {
            height: 350,
            type: 'line',
            stacked: false
            },
            plotOptions: {
                bar: {
                dataLabels: {
                    orientation: 'vertical',
                    position: 'center' // bottom/center/top
                }
                }
            },
            dataLabels: {
                style: {
                colors: ['#E74C3C']
                },
                offsetY: 15, // play with this value
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [0,1,2], // Aktifkan dataLabels untuk seri "Achievement" (indeks 2)
                textAnchor: 'start',
                textOrientation: 'vertical',
                formatter: function(val, opts) {
                    if (opts.seriesIndex === 2) { // Hanya format label untuk series "ach"
                    return val.toFixed() + "%";
                    }
                    return val;
                },
                background: {
                    enabled: true,
                    foreColor: '#000', // Text color for the data labels
                    padding: 3, // Adjust the padding as needed
                    borderRadius: 2, // Adjust the border radius as needed
                    borderWidth: 2, // Adjust the border width as needed
                    borderColor: '', // Set the border color to match the series color
                },
                textAnchor: 'start',
                style: {
                    fontSize: '11px',
                    fontFamily: 'Helvetica, Arial, sans-serif',
                    fontWeight: 'bold',
                    colors: undefined
                },
            },
            stroke: {
            width: [1, 1, 4]
            },
            title: {
            text: 'Monthly achievement 2023',
            align: 'left',
            offsetX: 0
            },
            xaxis: {
            categories: [<?php
                                foreach($deliv_tgl AS $data_tgl){
                                $tgl_deliv = $data_tgl['bln'];
                            echo "'".$tgl_deliv."'".",";
                            }
                            ?>],
            },
            yaxis: [
            {
                axisTicks: {
                show: true,
                },
                axisBorder: {
                show: true,
                color: '#008FFB'
                },
                labels: {
                style: {
                    colors: '#008FFB',
                }
                },
                title: {
                text: "plan qty",
                style: {
                    color: '#008FFB',
                }
                },
                tooltip: {
                enabled: true
                }
            },
            {
                seriesName: 'plan',
                opposite: true,
                axisTicks: {
                show: false,
                },
                axisBorder: {
                show: false,
                color: '#00E396'
                },
                labels: {
                style: {
                    colors: '#00E396',
                }
                },
                title: {
                text: "act qty",
                style: {
                    color: '#00E396',
                }
                },
            },
            {
                seriesName: 'ach',
                opposite: true,
                axisTicks: {
                show: true,
                },
                axisBorder: {
                show: true,
                color: '#FEB019'
                },
                labels: {
                style: {
                    colors: '#FEB019',
                },
                },
                title: {
                text: "achievement",
                style: {
                    color: '#FEB019',
                }
                }
            },
            ],
            tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
            },
            legend: {
            horizontalAlign: 'left',
            offsetX: 40
            },
            redrawOnParentResize: true
            };
        var chart = new ApexCharts(document.querySelector("#deliv_tgl"), options);
        chart.render();


    //    var optionsCircle1 = {
    //     chart: {
    //         type: 'radialBar',
    //         height: 350,
    //         zoom: {
    //         enabled: false
    //         },
    //         offsetY: 0
    //     },
    //     colors: ['#E91E63'],
    //     plotOptions: {
    //         radialBar: {
    //         dataLabels: {
    //             name: {
    //             show: false
    //             },
    //             value: {
    //             offsetY: 0,
    //             fontSize: '40px',
    //             }
    //         }
    //         }
    //     },
    //     series: [
    //             <?php
    //             $now_date = date("Y-m-d");
    //             mysqli_query($conn,"CREATE TEMPORARY TABLE acm_wh_total SELECT  SUM(plan) AS plan_total,
    //                                                                             SUM((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
    //                                                                                                                     AND pr.no_delivery=p.no_delivery)) 
    //                                                                             AS act_total
    //                                                                             FROM plan p 
                                                                        
    //                                                                             LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
    //                                                                             WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl) = '$now_year'");
    //             $total_del_acm = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM acm_wh_total"));
    //             $total_plan1 = $total_del_acm['plan_total'];
    //             $total_act1 = $total_del_acm['act_total'];
    //             if($total_act1==null){
    //                 $achtotal = "0";
    //             }else{
    //                 $achtotal = ($total_act1/$total_plan1)*100;
    //                 $achtotal = round($achtotal,1);
    //             }
    //             echo $achtotal ?>
    //             ],
    //     theme: {
    //         monochrome: {
    //         enabled: false
    //         }
    //     },
    //     legend: {
    //         show: false
    //     },
    //     title: {
    //         text: 'Total Achievement',
    //         align: 'left'
    //     }
    //     }

    //     var chartCircle1 = new ApexCharts(document.querySelector('#deliv_status'), optionsCircle1);
    //     chartCircle1.render();
    // </script>
    // <!-- deliv status -->

    // <!-- deliv statistik -->
    // <script>
    //     var optionsLine = {
    //     chart: {
    //         height: 328,
    //         type: 'line',
    //         zoom: {
    //         enabled: false
    //         },
    //         dropShadow: {
    //         enabled: true,
    //         top: 3,
    //         left: 2,
    //         blur: 4,
    //         opacity: 1,
    //         }
    //     },
    //     stroke: {
    //         curve: 'smooth',
    //         width: 2
    //     },
    //     //colors: ["#3F51B5", '#2196F3'],
    //     series: [
    //         // {
    //         // name: "100%",
    //         // data: [
    //         //     <?php
    //         //         $now_month = date("m");
    //         //         $now_year = date("Y");
                                                        
    //         //         $deliv_tgl = mysqli_query ($conn," SELECT p.tgl,
    //         //                                                 SUM(plan) AS planing,
    //         //                                                 SUM((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
    //         //                                                                                         AND pr.no_delivery=p.no_delivery)) 
    //         //                                                 AS actual
    //         //                                                 FROM plan p 
    //         //                                                 left join customer_deliv cd on cd.id = p.id_customer 
    //         //                                                 LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
    //         //                                                 WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl)= '$now_year'
    //         //                                                 GROUP BY p.tgl ORDER BY tgl ASC");
    //         //        foreach($deliv_tgl AS $data_tgl){
    //         //         echo "100".",";
    //         //         } 
    //         //     ?> 
    //         //     ]
    //         // },
    //         {
    //         name: "Ach",
    //         data: [
    //             <?php
    //                 $now_month = date("m");
    //                 $now_year = date("Y");
                                                        
    //                 $deliv_tgl = mysqli_query ($conn," SELECT p.tgl,
    //                                                         SUM(plan) AS planing,
    //                                                         SUM((SELECT SUM(qty) FROM prepare pr WHERE pr.part_no_prep = p.part_no
    //                                                                                                 AND pr.no_delivery=p.no_delivery)) 
    //                                                         AS actual
    //                                                         FROM plan p 
    //                                                         left join customer_deliv cd on cd.id = p.id_customer 
    //                                                         LEFT JOIN surat_jalan sj on sj.no_delivery=p.no_delivery
    //                                                         WHERE MONTH(tgl) = '$now_month' AND YEAR(tgl)= '$now_year'
    //                                                         GROUP BY p.tgl ORDER BY tgl ASC");
    //                foreach($deliv_tgl AS $data_tgl){
    //                     $total_plan = $data_tgl['planing'];
    //                     $total_act = $data_tgl['actual'];
    //                     if($total_plan==null){
    //                         $total_act = "0";
    //                     }else{
    //                         $achtotal = ($total_act/$total_plan)*100;
    //                         $achtotal = round($achtotal,1);
    //                     }
    //                 echo $achtotal.",";
    //                 } 
    //             ?> 
    //             ]
    //         }
    //     ],
    //     title: {
    //         text: 'Delivery Achievement',
    //         align: 'left'
    //     },
    //     markers: {
    //         size: 6,
    //         strokeWidth: 0,
    //         hover: {
    //         size: 9
    //         }
    //     },
    //     grid: {
    //         show: true,
    //         padding: {
    //         bottom: 0
    //         }
    //     },
    //     labels: [
    //         <?php
    //             foreach($deliv_tgl AS $data_tgl){
    //             $tgl_deliv = $data_tgl['tgl'];
    //         echo "'".$tgl_deliv."'".",";
    //         }
    //         ?>
    //         ],
    //         xaxis: {
    //         tooltip: {
    //         enabled: true // Mengaktifkan tooltip pada sumbu x
    //         }
    //     },
    //     dataLabels: {
    //         enabled: true, // Mengaktifkan data label
    //         background: {
    //         enabled: true,
    //         foreColor: '#000',
    //         padding: 4,
    //         borderRadius: 2,
    //         borderWidth: 1,
    //         borderColor: '#ccc',
    //         opacity: 0.9
    //         },
    //         textAnchor: 'start',
    //         formatter: function(val, opts) {
    //         return val.toFixed() + "%";
    //         }
    //     },
    //     legend: {
    //         position: 'top',
    //         horizontalAlign: 'right',
    //         offsetY: -20
    //     },
    //     yaxis: {
    //         title: {
    //         text: "achievement",
    //         },
    //         min: 5,
    //         max: 100,
    //     },
    //     }

    //     var chartLine = new ApexCharts(document.querySelector('#deliv_tgl'), optionsLine);
    //     chartLine.render();
    </script>
    <!-- deliv statistik -->

    <!-- js tooltip -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover({
                html: true,
                content: function() {
                    return $('#primary-popover-content').html();
                }
            });
        });
    </script>
    <!-- js tooltip -->
</body>

</html>
