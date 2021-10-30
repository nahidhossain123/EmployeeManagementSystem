<?php
    include "connection.php";
    session_start();
    if(!isset($_SESSION['user']))
    {
      if(!isset($_COOKIE['user']))
      {
        header("Location:AdminLogin.php"); 
      }else{
          $val=$_COOKIE['user'];
      }
    }
    else{
        $val=$_SESSION['user'];
    }
    $sql="SELECT * FROM admin WHERE admin_email='$val'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($result);
    $val=mysqli_fetch_assoc($result);
    if($row==0)
    {
        header("Location:AdminLogin.php"); 
    }
    $name=$email=$pass=$address=$salary=" ";
    $name_Error=$email_error=$pass_error=$address_error=$salary_error=$newA_Error=" ";

    if(isset($_POST['submit'])){
        if(empty($_POST['name']))
        {
            $name_Error="Name Required!!!";
        }else{
            $name=$_POST['name'];
        }
        if(empty($_POST['email']))
        {
            $email_error="Email Required!!!";
        }else{
            $email=$_POST['email'];
        }
        if(empty($_POST['pass']))
        {
            $pass_error="pass Required!!!";
        }else{
            $pass=$_POST['email'];
        }
        if(empty($_POST['address']))
        {
            $address_error="address Required!!!";
        }else{
            $address=$_POST['address'];
        }
        if(empty($_POST['salary']))
        {
            $salary_error="salary Required!!!";
        }else{
            $salary=$_POST['salary'];
        }
        $allowance=$_POST['allowance'];
        $val=$_POST['val'];
        
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
    <div class="main-wrapper">
        <div class="navbar">
            <div class="menu-bar" onclick="Expand()">
                <span><i class="fas fa-bars"></i><span class="dashboard-text">Dashboard</span></span>
            </div>
            <div class="admin-details">
                <img src="<?php echo $val['admin_image'] ?>" alt="profile image">
                <div class="admin-text">
                    <span> <?php echo $val['admin_name'] ?></span>
                    <span><a href="#">Log-Out</a></span>
                </div>
                
            </div>
        </div>
        <div class="side-menu" id="side-menu-collapse">
            <div class="logo">
                <span><span class="sm">M</span><span class="md">Management</span></span><span class="cancel" onclick="MinimizeSideMenu()"><i class="fas fa-times"></i></span>
            </div>
            <div class="side-menu-items">
                <span class="menu-items-con"><i class="fas fa-tachometer-alt"></i> <a href="Admin.php"><span class="menu-item-text">Dashboard</span></a></span>
                <span class="menu-items-con active"><i class="fas fa-user-plus"></i> <a href="AddEmployee.php"><span class="menu-item-text">Add Employee</span></a></span>
                <span class="menu-items-con"><i class="fas fa-info-circle"></i> <a href="#"><span class="menu-item-text">Employee Details</span></a></span>
                <span class="menu-items-con"><i class="fas fa-chart-line"></i> <a href="#"><span class="menu-item-text">Statistics</span></a></span>
                <span class="menu-items-con"><i class="fas fa-tasks"></i> <a href="#"><span class="menu-item-text">Manage</span></a></span>
            </div>
        </div>
        <div class="content wrapper">
            <div class="contents" style="overflow-y:auto;">
                
                <span style="display:flex;justify-content:center;">
                    <div style="width:100px;height:100px;border-radius:50px;border:3px solid black;display:flex;justify-content:center;align-items:center">
                        <i class="fas fa-user-plus fa-3x"></i>
                    </div>
                </span>
                <h2>Add Employee</h2>
                <br>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name" name="name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"  placeholder="Password" name="pass">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="Address" name="add">
                    </div>
                    <div class="form-group">
                        <input type="number" id="salary" onkeyup="Percent()" class="form-control"  placeholder="Salary" name="salary">
                    </div>
                    <div class="form-group" id="dynamic">
                        <div class="field">
                            <input type="text" style="margin-right:5px" class="form-control"  placeholder="Allowance" name="allowance[]">
                            <input type="text" style="margin-right:5px" class="form-control"  placeholder="Percent(%)" name="val[]">
                            <span style="margin-top:5px" onclick="addField()"><i class="fas fa-plus-circle"></i></span>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Add</button>
                </form>
                <br>
                <div class="allowance">
                    <span id="basic">Basic(30%):</span>
                    <span id="house">House Rent(27%):</span>
                    <span id="covence">Covence(13%):</span>
                    <span id="mobile">Mobile Allowance(30%):</span>
                    <hr>
                    <span id="total">Total(100%):</span>
                </div>
            </div>
        </div>
    </div>

<script src="JS/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>