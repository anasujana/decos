<?php 
    session_start();
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/FLN.png" type="image/x-icon">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body themebg-pattern="theme1">
<?php
    include('koneksi/koneksi.php');
?>
<section class="login-block">
<!-- Container-fluid starts -->
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<form action="login.php" method="post" class="md-float-material form-material">
    <div class="text-center">
        <img width="200 px" src="assets/images/logo fln.png" alt="logo.png">
    </div>
    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center txt-primary">LOGIN</h3>
                </div>
            </div>
            <div class="form-group form-primary">
                <input type="text" name="id_karyawan" class="form-control" required="">
                <span class="form-bar"></span>
                <label class="float-label">USER ID</label>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-primary">
                        <input type="password" name="password" class="form-control" required="">
                        <span class="form-bar"></span>
                        <label class="float-label">PASSWORD</label>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" name="save" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">SUBMIT</button>
                </div>
            </div>
            <div class="text-center text-danger" style="font-size: 15px;">
                <?php
                    if(isset($_POST['save'])){
                        $id = $_POST['id_karyawan'];
                        $password =$_POST['password'];
                        
                        $cek = mysqli_query($conn,"SELECT ar.nama_area,
                                                            ua.id_area,
                                                            ar.id_dept,
                                                            us.pass,
                                                            us.id,
                                                            ru.user_role
                                                            FROM user us 
                                                            LEFT JOIN role_user ru ON us.id=ru.id 
                                                            LEFT JOIN user_area ua ON us.id=ua.id_user
                                                            left join area ar on ar.id=ua.id_area
                                                            WHERE us.id='$id'");
                        $count= mysqli_num_rows($cek);
                        if($count > 0){
                        
                            $data=mysqli_fetch_array($cek);
                            $pass= $data['pass'];

                            $_SESSION["id_karyawan"]="$id";
                            $_SESSION["id_area"]=$data["id_area"];
                            $_SESSION["id_dept"]=$data["id_dept"];
                            $_SESSION["nama_area"]=$data["nama_area"];
                            $_SESSION["user_role"]=$data["user_role"];

                            if(password_verify($password,$pass)){
                                if($data['user_role']=="admin"){                                                                                  
                                    $_SESSION['logged_in']=true;
                                    header("location:andon_wh.php");

                                }else if($data['user_role']=="user" and $data['id_dept']==2){                                           
                                $_SESSION['logged_in']=true;
                                header("location:label_snp.php");

                                }else if($data['user_role']=="user" and $data['id_dept']=1){                                           
                                    $_SESSION['logged_in']=true;
                                    header("location:delivery_status.php");                                                                        
                                }                                    
                            }else{
                            echo "<strong>your password is incorect !</strong>";
                            }                                 
                        }else{
                            echo "<strong>your account not exists !</strong>";
                        }
                    }
                ?>
            </div>
            <hr/>
        </div>
    </div>
</form>
    
</div>
<!-- end of col-sm-12 -->
</div>
<!-- end of row -->
</div>
<!-- end of container-fluid -->
</section>
<!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>     <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>     <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>     <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
<!-- modernizr js -->
    <script type="text/javascript" src="assets/js/SmoothScroll.js"></script>     <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="assets/js/common-pages.js"></script>
</body>
</html>
