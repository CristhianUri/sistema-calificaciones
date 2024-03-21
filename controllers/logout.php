<?php 
 if (session_start()) {
    # code...
    session_destroy();
    header("Location: ../index.php");
}
exit();
?>