<?php
    include "connection.php";
    session_start();
    $error=" ";
    $email=$pass="";
    if(isset($_POST['sub']))
    {
        if(empty($_POST['email']))
        {
            $error="* Email or Password is Incorrect!!!";
        }else{
            $email=$_POST['email'];
        }
        if(empty($_POST['pass']))
        {
            $error="* Email or Password is Incorrect!!!";
        }else{
            $pass=$_POST['pass'];
        }
        if($error==" ")
        {  
            $sql="SELECT * FROM temp_employee WHERE em_email='$email' and em_pass='$pass' ";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_num_rows($result);
            $value=mysqli_fetch_assoc($result);
            if($row>0)
            {
                $_SESSION['user']=$value['em_email'];
                $email=$value['em_email'];
                if(isset($_POST["rem"]))
                {
                    setcookie("user","$email",time() + (86400 * 7), "/");
                }
                header("Location:Employee.php");
            }
            else{
                $error="* Email or Password is Incorrect!!!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-cont">
            <span style="display:flex;justify-content:center;"><i class="fas fa-user-cog fa-6x"></i></span>
            <h3 class="text-center">Employee Login</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pass" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rem" value="1">
                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                </div>
                <button type="submit" name="sub" class="btn btn-primary w-100">Log-In</button>
                <small class="form-text text-muted"><?php echo $error ?></small>
            </form>
        </div>
    </div>

<script src="JS/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>