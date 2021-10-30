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
                    <span> Admin Name</span>
                    <span><a href="#">Log-Out</a></span>
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
                <div class="table-item">
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Basic(30%)</th>
                        <th scope="col">House Rent(27%)</th>
                        <th scope="col">Covence(13%)</th>
                        <th scope="col">Mobile Allowance(30%)</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Nahid Hossain</td>
                        <td>10,000 BDT</td>
                        <td>2700 BDT</td>
                        <td>1700 BDT</td>
                        <td>1300 BDT</td>
                        <td>3000 BDT</td>
                        <td><a href="#" class="btn btn-primary py-1 px-3">Accept</a></td>
                        </tr>
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