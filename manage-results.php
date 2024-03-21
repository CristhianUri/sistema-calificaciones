<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {

?>
    <link rel="stylesheet" type="text/css" href="assets/js/DataTables/datatables.min.css" />
    <!-- ========== TOP NAVBAR ========== -->
    <?php include('includes/topbar.php'); ?>
    <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
        <div class="content-container">
            <?php include('includes/leftbar.php'); ?>

            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-md-6">
                            <h2 class="title">Gestionar Resultados</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Resultados</li>
                                <li class="active">Gestionar Resultados</li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->

                <section class="section">
                    <div class="container-fluid">



                        <div class="row">
                            <div class="col-md-12">
                               <div class="col-md-6">
                               <form action="">
                                    <select name="semestre" class="form-control col-md-3" id="semestre" required="required">
                                        <option value="">Seleccionar semestre</option>
                                        <?php $sql = "SELECT * from tblclasses";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {   ?>
                                                <option value="<?php echo htmlentities($result->id); ?>">

                                                    Semestre-<?php echo htmlentities($result->Section); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </form>
                               </div>
                                <div class="panel">
                                    <div class="panel-heading">



                                        <div class="panel-title">

                                        </div>
                                    </div>
                                   
                                    <div class="panel-body p-20">

                                    <div id="tabla"></div>

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
    <!-- /.section -->

    </div>
    <!-- /.main-page -->


    </div>
    <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->
    

    <?php include('includes/footer.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(e){
            $("#semestre").change(function(){
                var data = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "controllers/obtener_tabla.php",
                    data: {opcion:data},
                    success: function(respuesta){
                        $('#tabla').html(respuesta);
                    },
                    error: function(){
                        alert('Error al obtener los datos')
                    }
                })
            })
        })
    </script>
<?php } ?>