<?php
require '../includes/config.php';

// Obtener el valor enviado por AJAX
$opcion = $_POST['opcion'];

// Consultar datos del alumno y sus calificaciones
$sql = "SELECT alumnos.curp,
                CONCAT(alumnos.nombre, ' ', alumnos.aPaterno, ' ', alumnos.aMaterno) AS nombre_completo,
                tblsubjects.SubjectName,
                calificaciones.calificacion1,
                calificaciones.calificacion2,
                calificaciones.calificacion3
        FROM alumnos
        LEFT JOIN calificaciones ON alumnos.id = calificaciones.id_alumno
        JOIN tblsubjectcombination ON alumnos.semestre = tblsubjectcombination.ClassId
        JOIN tblsubjects ON tblsubjectcombination.SubjectId = tblsubjects.id
        WHERE alumnos.semestre = :opcion
        ORDER BY alumnos.curp, nombre_completo, tblsubjects.SubjectName";

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':opcion', $opcion, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Construir la tabla HTML
$html = '<table border="1">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>CURP</th>';
$html .= '<th>Nombre completo</th>';

// Obtener nombres de materias
$materias = array();
foreach ($resultados as $fila) {
    $materias[$fila['SubjectName']] = $fila['SubjectName'];
}
foreach ($materias as $nombre_materia) {
    $html .= '<th colspan="3">' . $nombre_materia . '</th>';
}
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$alumnos_procesados = array(); // Alumnos procesados para evitar repeticiones

// Rellenar tabla con datos
foreach ($resultados as $fila) {
    // Si el alumno no ha sido procesado, imprimir sus datos
    if (!isset($alumnos_procesados[$fila['curp']])) {
        $html .= '<tr>';
        $html .= '<td rowspan="' . count($materias) . '">' . $fila['curp'] . '</td>';
        $html .= '<td rowspan="' . count($materias) . '">' . $fila['nombre_completo'] . '</td>';
        $alumnos_procesados[$fila['curp']] = true;
    }
    
    // Si hay datos de calificación disponibles para esta materia, imprimir las calificaciones
    if ($fila['calificacion1'] !== null || $fila['calificacion2'] !== null || $fila['calificacion3'] !== null) {
        $html .= '<td>' . ($fila['calificacion1'] ?? '') . '</td>';
        $html .= '<td>' . ($fila['calificacion2'] ?? '') . '</td>';
        $html .= '<td>' . ($fila['calificacion3'] ?? '') . '</td>';
        $html .= '</tr>';
    }

}
$html .= '</tbody>';
$html .= '</table>';

// Devolver la tabla HTML como respuesta a la solicitud AJAX
echo $html;
?>
