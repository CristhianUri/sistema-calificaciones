<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

    $stid = intval($_GET['stid']);

    if (isset($_POST['submit'])) {
        $studentname = $_POST['fullanme'];
        $aPaterno = $_POST['aPaterno'];
        $aMaterno = $_POST['aMaterno'];
        $studentemail = $_POST['emailid'];
        $classid = $_POST['class'];
        $status = $_POST['status'];
        $sql = "update alumnos set nombre=:studentname,aPaterno=:aPaterno,aMaterno=:aMaterno,email=:studentemail,status=:status where id=:stid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentname', $studentname, PDO::PARAM_STR);
        $query->bindParam(':aPaterno', $aPaterno, PDO::PARAM_STR);
        $query->bindParam(':aMaterno', $aMaterno, PDO::PARAM_STR);
        $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
        $query->execute();

        $msg = "Información de Estudiante Actualizada Correctamente";
    }


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
                            <h2 class="title">Admisión de Estudiante</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>

                                <li class="active">Admisión de Estudiante</li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
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
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Proceso correcto! </strong><?php echo htmlentities($msg); ?>
                                        </div><?php } else if ($error) { ?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Hubo un inconveniete! </strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>
                                    <form class="form-horizontal" method="post">
                                        <?php

                                        $sql = "SELECT nombre, aPaterno,aMaterno,email, status, Section, ClassName from alumnos join tblclasses on tblclasses.id = alumnos.semestre where alumnos.id=:stid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {  ?>


                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Nombre Completo</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="fullanme" class="form-control" id="fullanme" value="<?php echo htmlentities($result->nombre) ?>" required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Apellido paterno</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="aPaterno" class="form-control" id="aPaterno" value="<?php echo htmlentities($result->aPaterno) ?>"  required="required" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Apellido materno</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="aMaterno" class="form-control" id="aMaterno" value="<?php echo htmlentities($result->aMaterno) ?>"  required="required" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Correo</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="emailid" class="form-control" id="email" value="<?php echo htmlentities($result->email) ?>" required="required" autocomplete="off">
                                                    </div>
                                                </div>



                                               



                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Año</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="classname" class="form-control" id="classname" value="<?php echo htmlentities($result->ClassName) ?>(Semestre-<?php echo htmlentities($result->Section) ?>)" readonly>
                                                    </div>
                                                </div>
                                               
                                                

                                                <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Estado</label>
                                                    <div class="col-sm-10">
                                                        <?php $stats = $result->Status;
                                                        if ($status == 1) {
                                                        ?>
                                                            <input type="radio" name="status" value="1" required="required" checked>Active <input type="radio" name="status" value="0" required="required">Block
                                                        <?php } ?>
                                                        <?php
                                                        if ($stats == 0) {
                                                        ?>
                                                            <input type="radio" name="status" value="1" required="required">Active <input type="radio" name="status" value="0" required="required" checked>Block
                                                        <?php } ?>



                                                    </div>
                                                </div>

                                        <?php }
                                        } ?>


                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                </div>
            </div>
            <!-- /.content-container -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('includes/footer.php'); ?>



    <?PHP } ?>