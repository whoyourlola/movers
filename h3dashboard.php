<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
?>

    <main>
        <h1 class="h3title">Welcome! <?Php echo $_SESSION['USER_NAME']?></h1></h1> 
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="h3dashboard.php" class="h3active">Dashboard</a></li>
        </ul>
        
    </main>

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>