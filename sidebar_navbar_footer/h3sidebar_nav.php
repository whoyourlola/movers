<?php
require('db connection/db.connection.php');
if(!isset($_SESSION['ROLE'])){
	header('location:h3login.php');
	die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/h3style.css">
    <link rel="stylesheet" href="css/h3health.css">
    <link rel="stylesheet" href="css/h3tablesformsdesign.css">
    <link rel="stylesheet" href="css/h3attenddesign.css">
    <title>Dashboard</title>
</head>
<body>
    <!-- Sidebar -->
    <section id="h3sidebar">
         <a href="h3dashboard.php" class="h3logo"><img src="images/logo1.1.png" alt class="h3logo-img"></a>
        <ul class="h3side-menu">
            <?php if($_SESSION['ROLE']==1){ ?>
                <li><a href="h3dashboard.php" class="h3side-active"><i class='bx bxs-dashboard h3icon'></i> Dashboard</a></li>
                <li class="h3side-divider">Main</li>
            <li><a href="h3department.php" class="h3side"><i class='bx bxs-buildings h3icon'></i> Department Admin</a></li>
             
            <li><a href="h3timesheet.php" class="h3side"><i class='bx bx-buildings h3icon'></i> Attendance Admin</a></li>
                <li>
                    <a href="#"><i class='bx bx-log-out-circle h3icon'></i> Leave Admin<i class='bx bx-chevron-right h3icon-right' ></i></a>
                    <ul class="h3side-dropdown">
                        <li><a href="h3leave_type.php">Leave Type</a></li>
                        <li><a href="h3leave.php">Leave Requests</a></li>
                    </ul>
                </li> 
                <li>
                    <a href="#"><i class='bx bxs-user-check h3icon'></i> Manage Employee<i class='bx bx-chevron-right h3icon-right' ></i></a>
                    <ul class="h3side-dropdown">
                        <li><a href="h3employee.php">Employees</a></li>
                        <li><a href="h3add_employee.php">Add Employee</a></li>
                    </ul>
                </li>
            <?php } else { ?>
                <li><a href="h3dashboard.php" class="h3side-active"><i class='bx bxs-dashboard h3icon'></i> Dashboard</a></li>
                <li class="h3side-divider">Main</li>
                <li>
                    <a href="#"><i class='bx bxs-calendar h3icon'></i> Attendance <i class='bx bx-chevron-right h3icon-right' ></i></a>
                    <ul class="h3side-dropdown">
                        <li><a href="h3time.php?id=<?php echo $_SESSION['USER_ID']?>">Time IN/OUT</a></li>
                        <li><a href="h3timesheet.php?id=<?php echo $_SESSION['USER_ID']?>">Timesheet</a></li>
                       
                    </ul>
                </li> 
                <li><a href="h3leave.php" class="h3side"><i class='bx bx-buildings h3icon'></i>Leave Request</a></li>
                <li>
                    <a href="#"><i class='bx bxs-shield h3icon' ></i> Health and Safety <i class='bx bx-chevron-right h3icon-right' ></i></a>
                    <ul class="h3side-dropdown">
                        
                        <li><a href="h3safety.php">Safety Protocols</a></li>
                        <li><a href="h3medical.php">Medical Submission</a></li>
                    </ul>
                </li> 
                <li class="h3side-divider">OTHER</li>
            <li> 
                <a href="#"><i class='bx bx-signal-5 h3icon'></i> Other Services <i class='bx bx-chevron-right h3icon-right' ></i></a>
                <ul class="h3side-dropdown">
                    <li><a href="#">CORE</a></li>
                    <li><a href="#">HR1</a></li>
                    <li><a href="#">HR2</a></li>
                    <li><a href="#">HR3</a></li>
                    <li><a href="#">HR4</a></li>
                </ul>
            </li> 
            <?php } ?>
        </ul>
    </section>
    <!-- Sidebar -->


    <!--NavBar-->
    <section id="h3content">
        <nav>
            <i class='bx bx-menu h3toggle-sidebar'></i>
            <form action="#">
                <div class="h3form-group">
                    <input type="text"  placeholder="Search...">
                    <i class='bx bx-search h3nav-icon' ></i>
                </div>
            </form>
            <?php if($_SESSION['ROLE']==1){ ?>
            <a href="h3notification.php" class="h3nav-link">
                <i class='bx bxs-bell h3nav-icon' ></i>
                <span class="h3badge">0</span>
            </a>
            
            <span class="h3nav-divider"></span>
            <div class="h3profile">
                <img src="images/default profile pic.jpg" alt="">
                <ul class="h3profile-link">
                
                    <li><a href="h3settings.php"><i class='bx bxs-cog h3profile-icon' > Settings</i></a></li>
                    <li><a href="h3logout.php"><i class='bx bx-log-out h3profile-icon' > Logout</i></a></li>
                </ul>
            </div>
            </a>
            <?php } else { ?>

                <a href="h3notification.php" class="h3nav-link">
                <i class='bx bxs-bell h3nav-icon' ></i>
                <span class="h3badge">0</span>
            </a>
            
            <span class="h3nav-divider"></span>
            <div class="h3profile">
                <img src="images/default profile pic.jpg" alt="">
                <ul class="h3profile-link">
                    <li><a href="h3add_employee.php?id=<?php echo $_SESSION['USER_ID']?>" ><i class='bx bx-user-circle Profile h3profile-icon'> Profile</i></a></li>
                    <li><a href="h3settings.php"><i class='bx bxs-cog h3profile-icon' > Settings</i></a></li>
                    <li><a href="h3logout.php"><i class='bx bx-log-out h3profile-icon' > Logout</i></a></li>
                </ul>
            </div>
            </a>
            <?php } ?>
        </nav>
    <!--NavBar-->
    
   
        