<?php
    include "connection.php";
    $em=$_GET['email'];
    $sql="INSERT INTO permanent_employee (`pm_name`, `pm_email`, `pm_phone`, `pm_pass`, `pm_address`, `pm_salary`) select em_name, em_email,em_phone, em_pass, em_address,em_salary from temp_employee where em_email='$em'";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        $sql="DELETE from temp_employee where em_email='$em'";
        mysqli_query($conn,$sql);
        header("Location:Employee.php");
    }
    else{
        header("Location:Employee.php");
    }

?>