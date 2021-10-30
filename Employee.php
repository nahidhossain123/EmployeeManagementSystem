<?php
    include "connection.php";
    session_start();
    if(!isset($_SESSION['employee']))
    {
      if(!isset($_COOKIE['employee']))
      {
        header("Location:EmployeeLogin.php"); 
      }else{
          $val=$_COOKIE['employee'];
      }
    }
    else{
        $val=$_SESSION['employee'];
    }
    $sql="SELECT * FROM temp_employee WHERE em_email='$val'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($result);
    $value=mysqli_fetch_assoc($result);
    
    if($row==0)
    {
        $sql="SELECT * FROM permanent_employee WHERE pm_email='$val'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_num_rows($result);
        $value=mysqli_fetch_assoc($result);
        if($row==0)
        {
            header("Location:EmployeeLogin.php"); 
        }
        else{
            $email=$value['pm_email'];
            $name=$value['pm_name'];
            $salary=$value['pm_salary'];
        }
    }
    else{
        $email=$value['em_email'];
        $name=$value['em_name'];
        $salary=$value['em_salary'];
        $id=$value['em_id'];
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
                <img src="Media/profile.png" alt="profile image">
                <div class="admin-text">
                    <span> <?php echo $name ?></span>
                    <span><a href="EmLogout.php">Log-Out</a></span>
                </div>
                
            </div>
        </div>
        <div class="side-menu" id="side-menu-collapse">
            <div class="logo">
                <span><span class="sm">M</span><span class="md">Management</span></span><span class="cancel" onclick="MinimizeSideMenu()"><i class="fas fa-times"></i></span>
            </div>
            <div class="side-menu-items">
                <span class="menu-items-con active"><i class="fas fa-tachometer-alt"></i> <a href="#"><span class="menu-item-text">My Timeline</span></a></span>
                <span class="menu-items-con"><i class="fas fa-user-plus"></i> <a href="#"><span class="menu-item-text">My Profile</span></a></span>
                <span class="menu-items-con"><i class="fas fa-info-circle"></i> <a href="#"><span class="menu-item-text">My Status</span></a></span>
                <span class="menu-items-con"><i class="fas fa-chart-line"></i> <a href="#"><span class="menu-item-text">My History</span></a></span>
                <span class="menu-items-con"><i class="fas fa-tasks"></i> <a href="#"><span class="menu-item-text">Manage</span></a></span>
            </div>
        </div>
        <div class="content">
            <<div class="table1">
                <h2>My Proposal</h2>
                <hr>
                <div class="table-item">
                    <?php 
                    if(isset($id))
                    { 
                    ?>
                    <span id="odd"><span>Name</span><span><?php echo $name ?></span></span>
                    <span><span>Email</span><span><?php echo $email ?></span></span>
                    <span id="odd"><span>Salary</span><span><?php echo $salary ?> BDT</span></span>
                    <?php
                        $sql="select * from allowance where em_id ='$email'";
                        $result=mysqli_query($conn,$sql);
                        $i=0;
                        while($row=mysqli_fetch_assoc($result))
                        {
                            if($i%2==1){
                    ?>
                            <span id="odd"><span><?php echo $row['al_name'] ?></span><span><?php echo $row['al_percent'] ?> BDT</span></span>
                            <?php
                            }
                            else{
                            ?>
                            <span><span><?php echo $row['al_name'] ?></span><span><?php echo $row['al_percent'] ?> BDT</span></span>
                            <?php
                            }
                            $i++;
                        }
                            ?>
                    <br>
                    <a href="accept.php?email=<?php echo $email ?>" class="btn btn-secondary">Accept</a>
                    <?php
                    }else{
                        echo "<h5 class='text-center'>----------Empty----------</h5>";
                    } 
                    ?>
                    
                </div>
            </div>
        </div>
    </div>

<script src="JS/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>