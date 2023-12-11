<?php
require 'koneksi/koneksi.php';
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delivery Control System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has a huge amount of ready-made features, UI components, pages which completely fulfill any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes">
    <link rel="icon" href="assets/images/FLN.png" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <style type="text/css">
        /* Tambahkan class CSS untuk tabel */
        .responsive-table {
            overflow-x: auto;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            overflow: hidden;
            padding: 9px;
            word-break: normal;
            font-weight: bold;
        }

        .tg .tg-v0401 {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            overflow: hidden;
            padding: 9px;
            word-break: normal;
        }

        .tg th {
            background-color: #2075c9;
            border-color: inherit;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            overflow: hidden;
            padding: 9px;
            word-break: normal;
        }

        .tg .tg-v040 {
            background-color: #212529;
            border-color: white;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            width: 100px;
            height: 140px;
            font-size: 16px;
        }

        .tg .tg-v0401 {
            background-color: #212529;
            border-color: white;
            color: white;
            text-align: center;
            vertical-align: middle;
            width: 110px;
        }

        /* Tambahkan aturan media query untuk tabel responsif */
        @media screen and (max-width: 768px) {
            .tg {
                font-size: 14px;
            }

            .tg td,
            .tg th {
                padding: 6px;
            }
        }
    </style>

</head>

<body>
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

    <div id="pcoded" class="pcoded">
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header d-print-none">
                <div class="navbar-wrapper">
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="delivery_status.php">
                                    <i style="font-size: 17px;" class="ti-truck"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php
                    // include('element/navbar.php');
                    ?>
                    <!-- <div class="pcoded-content">
                        <div class="pcoded-inner-content"> -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="assets/images/logo fln.png" width="145px" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <h1 style="font-size: 30px;" class="m-b-10 text-center font-weight-bold">Monitoring Delivery <br> To Customer</h1>
                                    </div>
                                    <div class="col-md-4 font-weight-bold">
                                        <p style="font-size: 13px;" class="m-b-10 text-right" id="tgl">
                                        </p>
                                        <p style="font-size: 13px;" class="text-right" id="clock">
                                        </p>
                                    </div>
                                </div>
                                <div class="row" id="andon_monitor">
                                    <table class="tg table responsive-table">
                                        <thead>
                                            <tr>
                                                <th class="tg-v0401"></th>
                                                <th class="tg-v0401" style="font-size: 30px; color: white;">PLAN</th>
                                                <th class="tg-v0401"><a href="" style="font-size: 30px; color: white;">ACTUAL</a></th>
                                                <th class="tg-v0401"><a href="" style="font-size: 30px; color: white;">BALANCE</a></th>
                                                <th class="tg-v0401"><a href="" style="font-size: 30px; color: white;">ACHIEVEMENT</a></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-table">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="tg-v0401" style="font-size: 35px; color: white; height: 140px;">TOTAL</th>
                                                <th class="tg-v0401" style="font-size: 60px; color: white;" id="total-plan"></th>
                                                <th class="tg-v0401" style="font-size: 60px; color: white;" id="total-act"></th>
                                                <th class="tg-v0401" style="font-size: 60px; color: white;" id="total-minus"></th>
                                                <th class="tg-v0401" style="font-size: 60px; color: white;" id="total-achievement"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/SmoothScroll.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/chart.js/Chart.js"></script>
    <script type="text/javascript" src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical-layout.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

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

    <script>
        const dataTable = document.getElementById("data-table");
        const totalPlan = document.getElementById("total-plan");
        const totalAct = document.getElementById("total-act");
        const totalMinus = document.getElementById("total-minus");
        const totalAchievement = document.getElementById("total-achievement");

        const eventSource = new EventSource("server1.php");

        eventSource.onmessage = function(event) {
            const data = JSON.parse(event.data);

            dataTable.innerHTML = "";
            if (data.length > 0) {
                for (let i = 0; i < data.length - 1; i++) {
                    const row = data[i];
                    const newRow = document.createElement("tr");

                    // Menentukan warna berdasarkan nilai achievement
                    let achievementColor = "text-primary";
                    if (row.achievement < 85) {
                        achievementColor = "text-danger";
                    } else if (row.achievement >= 85 && row.achievement < 95) {
                        achievementColor = "text-warning";
                    } else if (row.achievement >= 95 && row.achievement <= 99) {
                        achievementColor = "text-success";
                    } else if (row.achievement > 99) {
                        achievementColor = "text-primary";
                    }
                    newRow.innerHTML = `
                        <td  class="tg-v0401" style="font-size: 35px; color:white;">
                            <a href="andon_customer.php?area=${row.id ? row.id : ''}" style="font-size: 35px; color:white;" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Delivery ${row.nama_area ? row.nama_area : ''}">
                                ${row.nama_area ? row.nama_area : ''}
                            </a>
                        </td>
                        <td  class="tg-v040" style="font-size: 60px; color:white;">${row.plan_deliv ? row.plan_deliv : '0'}</td>
                        <td  class="tg-v040" style="font-size: 60px; color:white;">${row.act_deliv ? row.act_deliv : '0'}</td>
                        <td  class="tg-v040" style="font-size: 60px; color:white;">${row.minus ? row.minus : '0'}</td>
                        <td class="tg-v040 ${achievementColor}" style="font-size: 60px; color:white;">${row.achievement + '%' ? row.achievement + '%' : '0%'}</td>

                    `;
                    dataTable.appendChild(newRow);
                }

                totalPlan.textContent = data[data.length - 1].total_planning || '0';
                totalAct.textContent = data[data.length - 1].total_actual || '0';
                totalMinus.textContent = data[data.length - 1].total_minus || '0';
                totalAchievement.textContent = data[data.length - 1].total_achievement + '%' || '0%';

                // Menentukan warna berdasarkan nilai total achievement
                let totalAchievementColor = "text-primary";
                const totalAchievementValue = parseFloat(data[data.length - 1].total_achievement);
                if (totalAchievementValue < 85) {
                    totalAchievementColor = "text-danger";
                } else if (totalAchievementValue >= 85 && totalAchievementValue < 95) {
                    totalAchievementColor = "text-warning";
                } else if (totalAchievementValue >= 95 && totalAchievementValue <= 99) {
                    totalAchievementColor = "text-success";
                } else if (totalAchievementValue > 99) {
                    totalAchievementColor = "text-primary";
                }

                totalAchievement.classList.add(totalAchievementColor);
            } else {
                totalPlan.textContent = '';
                totalAct.textContent = '';
                totalMinus.textContent = '';
                totalAchievement.textContent = '';
            }
        };
    </script>
    <script type="text/javascript">
        function updateTime() {
            var now = new Date();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            var day = days[now.getDay()];
            var date = now.getDate();
            var month = months[now.getMonth()];
            var year = now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            var timeString = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            var tglString = day + ', ' + date + ' ' + month + ' ' + year;

            document.getElementById('clock').innerHTML = timeString;
            document.getElementById('tgl').innerHTML = tglString;
        }

        // Panggil updateTime() setiap detik
        setInterval(updateTime, 1000);
    </script>
</body>

</html>