<?php
// Conectar con la base de datos
require '../includes/config.php';
// Verificar si se ha enviado un archivo CSV
if(isset($_FILES["calificacion"]) && $_FILES["calificacion"]["error"] == 0) {
    $archivo_temporal = $_FILES["calificacion"]["tmp_name"];

    // Leer el archivo CSV y procesar los datos
    $fila = 1;
    if (($gestor = fopen($archivo_temporal, "r")) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            if ($fila == 1) { // Si es la primera fila, son los encabezados
                $encabezados = $datos;
            } else { // Si no, son los datos de un alumno
                // Obtener el ID del alumno mediante la CURP
                $curp_alumno = $datos[0]; // Suponiendo que la CURP está en la primera columna
                $consulta_curp = $dbh->prepare("SELECT id FROM alumnos WHERE curp = ?");
                $consulta_curp->execute([$curp_alumno]);
                $id_alumno = $consulta_curp->fetch(PDO::FETCH_COLUMN);

                // Insertar las calificaciones en la tabla de calificaciones
                for ($j = 1; $j < count($encabezados); $j++) {
                    // Obtener el ID de la materia mediante el nombre de la materia
                    $nombre_materia = $encabezados[$j];
                    $consulta_materia = $dbh->prepare("SELECT id FROM tblsubjects WHERE SubjectName = ?");
                    $consulta_materia->execute([$nombre_materia]);
                    $id_materia = $consulta_materia->fetch(PDO::FETCH_COLUMN);

                    // Insertar las calificaciones en la tabla de calificaciones
                    $calificaciones = explode(",", $datos[$j]);
                    $calificacion_1 = $calificaciones[0];
                    $calificacion_2 = $calificaciones[1];
                    $calificacion_3 = $calificaciones[2];

                    $consulta_insertar = $dbh->prepare("INSERT INTO calificaciones (id_alumno, id_materia, calificacion1, calificacion2, calificacion3) VALUES (?, ?, ?, ?, ?)");
                    $consulta_insertar->execute([$id_alumno, $id_materia, $calificacion_1, $calificacion_2, $calificacion_3]);
                }
            }
            $fila++;
        }
        fclose($gestor);
        echo "Calificaciones insertadas correctamente";
    } else {
        echo "Error: No se ha podido abrir el archivo CSV.";
    }
} else {
    echo "Error: No se ha enviado ningún archivo o ha ocurrido un error al subir el archivo.";
}
?>
