<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
?>


    <?php include('includes/topbar.php'); ?>
    <div class="content-wrapper">
        <div class="content-container">

            <?php include('includes/leftbar.php'); ?>

            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-sm-6">
                            <h2 class="title">Dashboard</h2>

                        </div>
                        <!-- /.col-sm-6 -->
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

                <section class="section">
                    <div class="container-fluid">
                        <div class="row">
                            

                        </div>
                        <section class="section">
                            <div class="container-fluid">



                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Resultados Publicados Recientemente</h5>
                                                </div>
                                            </div>
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nombre Estudiante</th>
                                                            <th>ID Roll</th>
                                                            <th>Año</th>
                                                            <th>Fecha de Registro</th>
                                                            <th>Estado</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $sql = "SELECT  distinct tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblresult join tblstudents on tblstudents.StudentId=tblresult.StudentId  join tblclasses on tblclasses.id=tblresult.ClassId";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {   ?>
                                                                <tr>
                                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                                    <td><?php echo htmlentities($result->StudentName); ?></td>
                                                                    <td><?php echo htmlentities($result->RollId); ?></td>
                                                                    <td><?php echo htmlentities($result->ClassName); ?>(<?php echo htmlentities($result->Section); ?>)</td>
                                                                    <td><?php echo htmlentities($result->RegDate); ?></td>
                                                                    <td><?php if ($result->Status == 1) {
                                                                            echo htmlentities('Active');
                                                                        } else {
                                                                            echo htmlentities('Blocked');
                                                                        }
                                                                        ?></td>
                                                                </tr>
                                                        <?php $cnt = $cnt + 1;
                                                            }
                                                        } ?>


                                                    </tbody>
                                                </table>


                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->


                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                    </div>
                    <!-- /.panel -->
            </div>
            <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.section -->

    </div>
    <!-- /.main-page -->


    </div>
    <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('includes/footer.php'); ?>



<?php } ?>