
<?php
session_start();
if(empty($_SESSION['id'])){
    
  header("location: login/login.php");

}
unset($_SESSION['id_user']);
session_destroy();
header("location: ../login/login.php");
exit;
?>