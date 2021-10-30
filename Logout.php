<?php
    session_start();
    $user=$_COOKIE['user'];
    session_destroy();
    setcookie("user",$user,time() -(86400 * 7));
    header("Location:AdminLogin.php");

?>