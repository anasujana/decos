<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
 <nav class="pcoded-navbar d-print-none">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
        <div class="pcoded-inner-navbar main-menu">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-80 img-radius" src="assets/images/profile1.png" alt="User-Profile-Image">
                    <div class="user-details">
                        <span class="text-uppercase" id="more-details"><?php echo $_SESSION['id_karyawan'];?><i class="fa fa-caret-down"></i></span>
                    </div>
                </div>
                <div class="main-menu-content">
                    <ul>
                        <li class="more-details">
                            <a href="../UpdateMasterData/update_user.php?id=<?php echo $_SESSION['id_karyawan'];?>"><i class="ti-settings"></i>Change Password</a>
                            <a href="index.php"><i class="ti-layout-sidebar-left"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="">
                        <a href="monthly_delivery.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Monthly Delivery</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="daily_delivery.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-dashboard"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Daily Delivery</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Monitoring Delivery</div>
                <ul class="pcoded-item pcoded-left-item">
                   <li class="">
                        <a href="andon_wh.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-dashboard"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Andon Warehouse</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <?php
                    if($_SESSION["id_dept"]!=2){
                    echo '
                    <li>
                        <a href="andon_customer.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-dashboard"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Andon Customer</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>';
                    }
                    ?>
                </ul>
            <?php
            if($_SESSION["id_dept"]!=2){
            echo '
            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Preparation Delivery</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="chekshet_delivery.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-check-box"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Schedule Delivery</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="delivery_status.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-truck"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Delivery Status</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Stok Warehouse</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="wh_stock.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-package"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Stok FG IN</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>';
            }
            ?>
            <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Preparation Produksi</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="label_snp.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-ticket"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Label Produksi (snp)</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="label_nosnp.php" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-ticket"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Label Produksi (no snp)</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <?php
                if($_SESSION["user_role"]=='admin'){
                echo '
                <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Master Data</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Delivery</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li>
                                        <a href="master_data/customer_deliv.php" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Customer Delivery</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="master_data/part_deliv.php" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Part Delivery</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li> 
                                </ul>
                            </li>
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Produksi</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li>
                                        <a href="master_data/line_prod.php" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Line Produksi</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                            
                                    <li>
                                        <a href="master_data/customer_prod.php" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Customer Produksi</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="master_data/part_prod.php" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Part Produksi</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li> 
                                </ul>
                            </li>
                            <li class="">
                                <a href="master_data/list_part.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-package"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">List Part</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="master_data/deliv_cycle.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-time"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Cycle Delivery</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="master_data/area.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-location-pin"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Area</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="master_data/departemen.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-map-alt"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Departemen</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">User Management</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li>
                                <a href="master_data/user.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">User</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="master_data/user_area.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">User Area</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="master_data/role_user.php" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Role User</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </div>';
                }
                ?>
</nav>