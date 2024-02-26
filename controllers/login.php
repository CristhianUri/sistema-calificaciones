<?php
   require_once '../includes/config.php';
   session_start();
   
   $limiteDeinicio = 3;
   $bloqueo = 10;
   
   // Validación para bloqueo
   if (isset($_SESSION['intento']) && $_SESSION['intento'] >= $limiteDeinicio) {
    if ((time() - $_SESSION['ultimoIntento']) < $bloqueo) {
        // Prohibido

        echo json_encode(["success" => false, "message" => "Demasiados intentos fallidos. Inténtalo nuevamente más tarde."]);
         
        exit();
    } else {
        // Reiniciar el contador de intentos y el tiempo del último intento
        $_SESSION['intento'] = 0;
        $_SESSION['ultimoIntento'] = time();
    }
    }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
       $email = $_POST['email'];
       $password = $_POST['password'];
        
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           echo json_encode(["success" => false, "message" => "Por favor, ingresa un correo electrónico válido"]);
           exit();
       }
   
       try {
           // Consulta preparada para evitar inyección SQL
           $stmt = $dbh->prepare("SELECT id, contrasena FROM admin WHERE email = ?");
           $stmt->execute([$email]);
           $user = $stmt->fetchObject();
           $stmt->closeCursor();
           $dbh = null;
           var_dump($user);
   
           if ($user && password_verify($password, $user->contrasena)) {
               // Verificar la contraseña utilizando password_verify
               $_SESSION['intento'] = 0;
               $_SESSION['user_id'] = $user->id;
               http_response_code(200);
               
               echo json_encode(["success" => true, "message" => "Inicio de sesion exitoso"]);
               
               // Cerrar la sesión después de éxito (opcional)
               
           } else {
               // Contraseña incorrecta
               $_SESSION['intento']++;
               $_SESSION['ultimoIntento'] = time();
               http_response_code(404);
               echo json_encode(["success" => false, "message" => "Inicio de sesión incorrecto"]);
           }
       } catch (PDOException $e) {
           http_response_code(500);
           echo json_encode(["success" => false, "message" => "Error en la base de datos"]);
       }
   } else {
       http_response_code(400);
       echo json_encode(["success" => false, "message" => "Solicitud incorrecta"]);
   }
?>