
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Admin</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/prism/prism.css" media="screen">
    <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
    <link rel="stylesheet" href="assets/css/main.css" media="screen">
    <script src="assets/js/modernizr/modernizr.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="funtions/functions.js"></script>
</head>

<body class="" style="background-image: url(assets/images/back2.jpg);
      background-color: #3d85ed;
      background-size: cover;
      height: 100%;
 
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
    <div class="main-wrapper">
        <div class="">
            <div class="row">
                <div class="col-md-offset-7 col-lg-5">
                    <section class="section">
                        <div class="row mt-40">
                            <div class="col-md-offset-2 col-md-10  pt-50">
                                <div class="row mt-30 ">
                                    <div class="col-md-11">
                                        <div class="panel login-box" style="    background: #3d86ed;">
                                            <div class="panel-heading">

                                                <div class="text-center"><br>
                                                    <a href="#">
                                                        <img style="height: 70px"
                                                            src="assets/images/footer-logo.png"></a>
                                                    <br>
                                                    <h5 style="color: white;"> <strong>Acceso Administrativo</strong>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="panel-body p-20">
                                                <form id="frm_login" class="p-5 border rounded shadow" method="post">
                                                    

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Correo electrónico</label>
                                                        <input type="email" id="email" name="email" class="form-control"
                                                            placeholder="Ingrese su correo electrónico" required
                                                            autofocus>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Contraseña</label>
                                                        <input type="password" id="password" name="password"
                                                            class="form-control" placeholder="Ingrese su contraseña"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p>¿No tienes cuenta?<a href="registrar.php"> registrate
                                                                aqui</a></p>
                                                    </div>
                                                    <button id="btn-login" class="btn btn-primary btn-block"
                                                        type="submit">Iniciar sesión</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-11 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->
                    </section>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /. -->
    </div>
    <!-- sweet-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- /.main-wrapper -->
    <!-- ========== COMMON JS FILES ========== -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/pace/pace.min.js"></script>
    <script src="assets/js/lobipanel/lobipanel.min.js"></script>
    <script src="assets/js/iscroll/iscroll.js"></script>
    <!-- ========== PAGE JS FILES ========== -->
    <!-- ========== THEME JS ========== -->
    <script src="assets/js/main.js"></script>
    <script>
    $(function() {

    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#btn-login").submit(function(e) {
            e.preventDefault();
            $("#btn-login").prop("disabled", true); 
            iniciarSesion();
          

        });
    });
    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>