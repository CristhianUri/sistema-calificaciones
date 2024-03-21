<?php
require '../includes/config.php';

// Contraseña predeterminada para todos los registros
$contrasena_predeterminada = '123';
$estatus = 1;
$archivotmp = $_FILES['alumnoFile']['tmp_name'];
$lineas = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    // Omitir la primera fila (encabezados de columna)
    if ($i == 0) {
        $i++;
        continue;
    }

    $datos = explode(",", $linea);

    $curp                  = !empty($datos[0])  ? ($datos[0]) : ' ';
    $nombre                = !empty($datos[1])  ? ($datos[1]) : ' ';
    $aPaterno              = !empty($datos[2])  ? ($datos[2]) : ' ';
    $aMaterno              = !empty($datos[3])  ? ($datos[3]) : ' ';
    $email                 = !empty($datos[4])  ? ($datos[4]) : ' ';
    $semestre              = !empty($_POST['semestre']) ? $_POST['semestre'] : ' ';
    $t_nombre              = !empty($datos[5])  ? ($datos[5]) : ' ';
    $t_aPaterno              = !empty($datos[6])  ? ($datos[6]) : ' ';
    $t_aMaterno             = !empty($datos[7])  ? ($datos[7]) : ' ';
    // Evitar inserción de celdas vacías
    if (!empty($curp) && !empty($nombre) && !empty($aPaterno) && !empty($aMaterno) && !empty($email) && !empty($semestre)) {
        // Hash para la contraseña predeterminada (puedes usar password_hash)
        $hash_contrasena = password_hash($contrasena_predeterminada, PASSWORD_DEFAULT);

        // Verificar si el CURP ya existe
        $consulta_curp = $dbh->prepare("SELECT COUNT(*) FROM alumnos WHERE curp = ?");
        $consulta_curp->execute([$curp]);
        $existe_curp = $consulta_curp->fetchColumn() > 0;

        if ($existe_curp) {
            // Si el CURP existe, actualizar la información
            $actualizar = $dbh->prepare("UPDATE alumnos SET nombre=?, aPaterno=?, aMaterno=?, email=?, contrasena=?, semestre=?,  t_nombre=?, t_aPaterno=?, t_aMaterno=? ,status= ?   WHERE curp=?");
            $ejecutar_actualizacion = $actualizar->execute([$nombre, $aPaterno, $aMaterno, $email, $hash_contrasena, $semestre, $t_nombre, $t_aPaterno, $t_aMaterno, $estatus, $curp]);
            echo "Éxito al actualizar";
        } else {
            // Si el CURP no existe, insertar nueva información
            $insertar = $dbh->prepare("INSERT INTO alumnos (curp, nombre, aPaterno, aMaterno, email, contrasena, semestre, t_nombre, t_aPaterno, t_aMaterno, status) VALUES(?,?,?,?,?,?,?,?,?,?,?) ");
            $ejecutar = $insertar->execute([$curp, $nombre, $aPaterno, $aMaterno, $email, $hash_contrasena, $semestre,$t_nombre,$t_aPaterno,$t_aMaterno,$estatus]);
            echo "Éxito al insertar";
        }
    } else {
        echo "Ignorado: Celda(s) vacía(s)";
    }
    $i++;
}
?>