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
                    <span><a href="Logout.php">Log-Out</a></span>
                </div>
                
            </div>
        </div>
        <div class="side-menu" id="side-menu-collapse">
            <div class="logo">
                <span><span class="sm">M</span><span class="md">Management</span></span><span class="cancel" onclick="MinimizeSideMenu()"><i class="fas fa-times"></i></span>
            </div>
            <div class="side-menu-items">
                <span class="menu-items-con active"><i class="fas fa-tachometer-alt"></i> <a href="Admin.php"><span class="menu-item-text">Dashboard</span></a></span>
                <span class="menu-items-con"><i class="fas fa-user-plus"></i> <a href="AddEmployee.php"><span class="menu-item-text">Add Employee</span></a></span>
                <span class="menu-items-con"><i class="fas fa-info-circle"></i> <a href="#"><span class="menu-item-text">Employee Details</span></a></span>
                <span class="menu-items-con"><i class="fas fa-chart-line"></i> <a href="#"><span class="menu-item-text">Statistics</span></a></span>
                <span class="menu-items-con"><i class="fas fa-tasks"></i> <a href="#"><span class="menu-item-text">Manage</span></a></span>
            </div>
        </div>
        <div class="content">
            <div class="table1">
                <h2>Accepted</h2>
                <div class="table-item">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="SELECT * from permanent_employee";
                            $result=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($result))
                            {
                        ?>
                        <tr>
                        <td><?php echo $row['pm_name'] ?></td>
                        <td><?php echo $row['pm_email'] ?></td>
                        <td><?php echo $row['pm_phone'] ?></td>
                        <td><i class="far fa-check-circle"></i></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="table2">
                <h2>Proposed</h2>
                <div class="table-item">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql="select * from temp_employee";
                            $result=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($result))
                            { 
                        ?>
                        <tr>
                        <td><?php echo $row["em_name"] ?></td>
                        <td><?php echo $row["em_email"] ?></td>
                        <td><?php echo $row["em_phone"] ?></td>
                        <td><i class="far fa-times-circle"></i></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="JS/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>