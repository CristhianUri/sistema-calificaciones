<?php
require '../includes/config.php';

    function emailRegistrado($dbh, $email) {
        $validar = $dbh->prepare("SELECT COUNT(*) FROM admin WHERE email = ?");
        $validar->execute([$email]);
        return $validar->fetchColumn() > 0;
    }

    if ($_SERVER['REQUEST_METHOD']=== 'POST'  ) {
        # code...
        $nombre = $_POST['nombre'];
        $aPaterno =$_POST['aPaterno'];
        $aMaterno = $_POST['aMaterno'];
        $email = $_POST['email'];
        $contraseña = $_POST['password'];
        //$pass= password_hash((string)$contraseña, PASSWORD_BCRYPT);
        $pass= md5($contraseña);
        if (emailRegistrado($dbh, $email)) {
           
            echo json_encode(["success"=>false,"message"=>"fallo"]);
        } else {
            $query = $dbh->prepare("INSERT INTO admin (nombre, aPaterno, aMaterno, email, contrasena) VALUES(?,?,?,?,?)");
            $execute = $query -> execute([ $nombre, $aPaterno, $aMaterno, $email, $pass]);
         
            echo json_encode(["success"=>true,"message"=>"exito"]);
        }
    }
?>