<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['email'];
    $password = $_POST['pass'];
    $sql = "SELECT id, email , contrasena FROM alumnos WHERE email=:email AND status=1 ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $uname, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetchObject();
    
    if ($user && password_verify($password, $user->contrasena)) {
       $_SESSION['alogin'] = $user->id;
       echo "<script type='text/javascript'> document.location = 'result.php'; </script>";
    } else {
 
       echo "<script >alert('vuelve a intentarlo')</script>";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado Estudiante</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/icheck/skins/flat/blue.css">
    <link rel="stylesheet" href="assets/css/main.css" media="screen">
    <script src="assets/js/modernizr/modernizr.min.js"></script>
</head>

<body class="" style="background-image: url(assets/images/back1.jpg);
      background-color: #ffffff;
      background-size: cover;
      height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
    <div class="main-wrapper">

        <div class="login-bg-color">
            <div class="row">
                <div class="col-md-4 col-md-offset-7">
                    <div class="panel login-box" style="    background: #3d86ed;">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                <a href="#">
                                    <img style="height: 70px" src="assets/images/footer-logo.png"></a>
                                <h3 class="text-white">Verifica tus Resultados</h3>
                            </div>
                        </div>
                        <div class="panel-body p-20">



                            <form action="find-result.php" method="post" class="admin-login">
                                <div class="form-group">
                                    <label for="rollid" class="control-label">Ingresa tu email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Ingresa tu email" autocomplete="off" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="default" class="control-label">contraseña</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Ingresa tu contraseña" autocomplete="off" name="pass">
                                    
                                </div>


                                <div class="form-group mt-20">
                                    <div class="">

                                        <button type="submit" class="btn" style="color: #172541;">Buscar</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <a href="index.php" class="text-white">Volver</a>
                                </div>
                            </form>


                        </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-md-6 col-md-offset-3 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /. -->

    </div>
    <!-- /.main-wrapper -->
    <!--alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ========== COMMON JS FILES ========== -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/pace/pace.min.js"></script>
    <script src="assets/js/lobipanel/lobipanel.min.js"></script>
    <script src="assets/js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="assets/js/icheck/icheck.min.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="assets/js/main.js"></script>
    <script>
        $(function() {
            $('input.flat-blue-style').iCheck({
                checkboxClass: 'icheckbox_flat-blue'
            });
        });
    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>