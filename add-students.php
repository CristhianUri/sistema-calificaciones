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
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
   
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
                        <h2 class="title">Agregar Estudiante</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>

                            <li class="active">Agregar Estudiante</li>
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
                                    <?php if ($msg) { ?>
                                    <div class="alert alert-success left-icon-alert" role="alert">
                                        <strong>Bien hecho! </strong><?php echo htmlentities($msg); ?>
                                    </div><?php } else if ($error) { ?>
                                    <div class="alert alert-danger left-icon-alert" role="alert">
                                        <strong>Algo salió mal!</strong> <?php echo htmlentities($error); ?>
                                    </div>
                                    <?php } ?>
                                    
                                    <form action="files.php" class="row" method="post" enctype="multipart/form-data" id="formFiles">

                                        <div class="form-group col-md-6">
                                        <label for="default" class="control-label">Archivo alumnos .cvs</label>
                                            <input class="form-control" type="file" name="alumnoFile">

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="default" class="control-label">Año</label>
                                            <select name="class" class="form-control" id="class" required="required">
                                                <option value="">Seleccionar Año</option>
                                                <?php $sql = "SELECT * from tblclasses";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {   ?>
                                                <option value="<?php echo htmlentities($result->id); ?>">
                                                    <?php echo htmlentities($result->ClassName); ?>&nbsp;
                                                    Semestre-<?php echo htmlentities($result->Section); ?></option>
                                                <?php }
                                                    } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="button" onclick="subirArchivo()"
                                                class=" btn btn-success  ">Cargar
                                                Archivo</button>
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
    <!-- /.content-wrapper -->
    <?php include('includes/footer.php'); ?>
    <script>
function subirArchivo() {
    // Obtén el formulario y el archivo seleccionado
    var formData = new FormData(document.getElementById('formFiles'));
    
    // Obtén el valor del semestre seleccionado
    var semestre = document.getElementById('class').value;
    
    // Agrega el valor del semestre al objeto formData
    formData.append('semestre', semestre);
    
    // Crea una instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configura la solicitud POST al script PHP que procesará el archivo
    xhr.open('POST', 'controllers/importar.php', true);

    // Define el evento onload que se ejecutará cuando la solicitud se complete
    xhr.onload = function() {
        if (xhr.status === 200) {
            // La solicitud fue exitosa, muestra la respuesta del servidor (mensaje de éxito o error)
            alert(xhr.responseText);
        } else {
            // Hubo un error en la solicitud
            alert('Error al subir el archivo.');
        }
    };

    // Envía la solicitud con los datos del formulario (incluyendo el archivo y el semestre)
    xhr.send(formData);
}
</script>



    <?PHP } ?>