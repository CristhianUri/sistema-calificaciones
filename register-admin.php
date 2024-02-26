<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #3d85ed !important;
        color: white;
        text-align: center;
    }
    </style>
</head>

<?php
session_start();
error_reporting(0);
if ($_SESSION['id']==1) {
    # code...
    header('location: index.php');
} else{
?>


<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php'); ?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">

        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('includes/leftbar.php'); ?>
        <!-- /.left-sidebar -->

        <div class="main-page">

            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">Agregar administrador</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>

                            <li class="active">Agregar adminstrador</li>
                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <section class="section">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Completa la información del estudiante</h5>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <form id="frm_registrar" class="p-5 border rounded shadow row" acction="" method="POST">

                                        <div class="form-group col-md-6">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input type="text" id="nombre" name="nombre" class="form-control"
                                                placeholder="Ingrese su nombre" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="aPaterno" class="form-label">Apellido paterno</label>
                                            <input type="text" id="aPaterno" name="aPaterno" class="form-control"
                                                placeholder="Ingrese su apellido paterno" required>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="aMaterno" class="form-label">Apellido materno</label>
                                            <input type="text" id="aMaterno" name="aMaterno" class="form-control"
                                                placeholder="Ingrese su apellido materno" required>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Ingrese su correo electrónico" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="contraseña" class="form-label">Contraseña</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Ingrese su contraseña" required>
                                        </div>



                                        <div class="form-group col-md-12">

                                            <button id="btn-registrar" class="btn btn-primary " type="submit">Crear
                                                administrador</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- /.col-md-12 -->
                    </div>

                </div>
            </section>


        </div>

        <!-- /.content-container -->
    </div>
    

    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- /.content-wrapper -->

    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btn-registrar").on('click', function(e){
                e.preventDefault();
             
                registrar();
                
            });
        });
    </script>
    <?php } ?>

    <!---------------------------------------------------------------------------------------->