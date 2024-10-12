<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/h3style.css">
    <title>Dashboard</title>
</head>
<body>
    <!-- Sidebar -->
    <section id="h3sidebar">
         <a href="h3dashboard.php" class="h3logo"><img src="images/logo.png" alt class="h3logo-img"></a>
        <ul class="h3side-menu">
            <li><a href="h3dashboard.php" class="h3side-active"><i class='bx bxs-dashboard h3icon'></i> Dashboard</a></li>
            <li class="h3side-divider">Main</li> 
                <li>
                    <a href="#"><i class='bx bxs-calendar h3icon'></i> Attendance <i class='bx bx-chevron-right h3icon-right' ></i></a>
                    <ul class="h3side-dropdown">
                        <li><a href="h3time.php">Time IN/OUT</a></li>
                        <li><a href="h3timesheet.php">Timesheet</a></li>
                        <li><a href="h3leaveReq.php">Leave Request</a></li>
                    </ul>
                </li> 
            <li><a href="h3healthAndSafety.php"><i class='bx bxs-shield h3icon' ></i> Health and Safety</a></li>
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
        </ul>
    </section>
    <!-- Sidebar -->


    <!--NavBar-->
    <section id="h3content">
        <nav>
            <i class='bx bx-menu h3toggle-sidebar'></i>
            <form action="#">
                <div class="h3form-group">
                    <input type="text"  placeholder="Search bitch">
                    <i class='bx bx-search h3nav-icon' ></i>
                </div>
            </form>
            <a href="h3notification.php" class="h3nav-link">
                <i class='bx bxs-bell h3nav-icon' ></i>
                <span class="h3badge">0</span>
            </a>
            <a href="#" class="h3nav-link">
                <i class='bx bxs-message-square-dots h3nav-icon' ></i>
                <span class="h3badge">0</span>
            </a>
            <span class="h3nav-divider"></span>
            <div class="h3profile">
                <img src="images/default profile pic.jpg" alt="">
                <ul class="h3profile-link">
                    <li><a href="h3profile.php"><i class='bx bxs-user-circle h3profile-icon' > Profile</i></a></li>
                    <li><a href="h3settings.php"><i class='bx bxs-cog h3profile-icon' > Settings</i></a></li>
                    <li><a href="h3login.php"><i class='bx bx-log-out h3profile-icon' > Logout</i></a></li>
                </ul>
            </div>
            </a>
        </nav>
    <!--NavBar-->
        
        <!--Main-->
    <main>
        <h1 class="h3title">Settings</h1>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="h3settings.php" class="h3active">Settings</a></li>
        </ul>
    </main>
        <!--Main-->
    </section>
    <!--NavBar-->
    <script src="js/h3script.js"></script>
</body>
</html>