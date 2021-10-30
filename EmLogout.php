<?php
    session_start();
    $user=$_COOKIE['employee'];
    unset($_SESSION['employee']);
    setcookie("employee",$user,time() -(86400 * 7));
    header("Location:EmployeeLogin.php");

?>