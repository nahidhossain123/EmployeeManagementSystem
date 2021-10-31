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
    $sql1="SELECT * FROM admin WHERE admin_email='$val'";
    $result1=mysqli_query($conn,$sql1);
    $row=mysqli_num_rows($result1);
    $val=mysqli_fetch_assoc($result1);
    if($row==0)
    {
        header("Location:AdminLogin.php"); 
    }
    $name=$email=$pass=$add=$salary=$message=$phone=NULL;
    $name_Error=$email_error=$pass_error=$add_error=$salary_error=$newA_Error=$phone_error=" ";

    if(isset($_POST['submit'])){
        if(empty($_POST['name']))
        {
            $name_Error="*Name Required!!!";
        }else{
            $name=$_POST['name'];
        }
        if(empty($_POST['email']))
        {
            $email_error="*Email Required!!!";
        }else{
            $email=$_POST['email'];
            $sql="SELECT * from temp_employee where em_email='$email'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_num_rows($result);
            if($row>0)
            {
                $email_error="Email Already Exist Try Another One!!";
            }
        }
        if(empty($_POST['phone']))
        {
            $phone_error="*Phone Number Required!!!";
        }else{
            $phone=$_POST['phone'];
        }
        if(empty($_POST['pass']))
        {
            $pass_error="*Password Required!!!";
        }else{
            $pass=$_POST['pass'];
        }
        if(empty($_POST['add']))
        {
            $add_error="*Address Required!!!";
        }else{
            $add=$_POST['add'];
        }
        if(empty($_POST['salary']))
        {
            $salary_error="*Salary Required!!!";
        }else{
            $salary=$_POST['salary'];
        }
        
        $basic=(30*$salary)/100;
        $house=(27*$salary)/100;
        $covence=(13*$salary)/100;
        $mobile=(30*$salary)/100;
        $ar=array("Basic(30%)"=>$basic,"House Rent(27%)"=>$house,"Covence(13%)"=>$covence,'Mobile(30%)'=>$mobile);
        $allowance=$_POST['allowance'];
        $value=$_POST['val'];
        if(!empty($allowance[0]) && !empty($value[0]))
        {
            for($i=0;$i<count($allowance);$i++)
            {
                $ar+=array($allowance[$i]=>$value[$i]);
            }
        }
     
        if($name_Error==" " && $email_error==" " && $pass_error==" " && $add_error==" " && $salary_error==" " && $phone_error==" ")
        {
            $sql="INSERT INTO `temp_employee`( `em_name`, `em_email`,`em_phone`, `em_pass`, `em_address`, `em_salary`) VALUES ('$name','$email','$phone','$pass','$add','$salary')";
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $message="Employee Inserted Successfully!!";
                foreach($ar as $key=>$value)
                {
                    $sql="INSERT INTO `allowance`( `em_id`, `al_name`, `al_percent`) VALUES ('$email','$key','$value')";
                    $result=mysqli_query($conn,$sql);
                    if(!$result)
                    {
                        echo "failed";
                    }
                }
                
                header("Location:AddEmployee.php?msg=$message");
            }
            else{
                $message="Insertion Failed!!";
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
                <span class="menu-items-con"><i class="fas fa-info-circle"></i> <a href="EmployeeDetails.php"><span class="menu-item-text">Employee Details</span></a></span>
                <span class="menu-items-con"><i class="fas fa-chart-line"></i> <a href="#"><span class="menu-item-text">Statistics</span></a></span>
                <span class="menu-items-con"><i class="fas fa-tasks"></i> <a href="#"><span class="menu-item-text">Manage</span></a></span>
            </div>
        </div>
        <div class="content wrapper">
            <div class="contents" style="overflow-y:auto;">
                
                <span style="display:flex;justify-content:center;">
                    <div style="color:gray;display:flex;justify-content:center;align-items:center">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </div>
                </span>
                <h4 class="text-center" style="color:gray">Add Employee</h4>
                <br>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name" name="name" value="<?php 
                            if(isset($name))
                            {
                                echo $name;
                            }
                        ?>">
                        <small><?php echo $name_Error ?></small>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php 
                            if(isset($email))
                            {
                                echo $email;
                            }
                        ?>">
                        <small><?php echo $email_error ?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php 
                            if(isset($phone))
                            {
                                echo $phone;
                            }
                        ?>">
                        <small><?php echo $phone_error ?></small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"  placeholder="Password" name="pass" value="<?php 
                            if(isset($pass))
                            {
                                echo $pass;
                            }
                        ?>">
                        <small><?php echo $pass_error ?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="Address" name="add" value="<?php 
                            if(isset($add))
                            {
                                echo $add;
                            }
                        ?>">
                        <small><?php echo $add_error ?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" id="salary" onkeyup="Percent()" class="form-control"  placeholder="Salary" name="salary" value="<?php 
                            if(isset($salary))
                            {
                                echo $salary;
                            }
                        ?>">
                        <small><?php echo $salary_error ?></small>
                    </div>
                    <div class="form-group" id="dynamic">
                        <div class="field">
                            <input type="text" style="margin-right:5px" class="form-control"  placeholder="Allowance" name="allowance[]">
                            <input type="text" style="margin-right:5px" class="form-control"  placeholder="Value" name="val[]">
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
                    <small><?php
                        if(isset($_GET['msg']))
                        {
                            echo $_GET['msg'];
                        }
                    ?></small>
                </div>
            </div>
        </div>
    </div>

<script src="JS/main.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>