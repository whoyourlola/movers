<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
?>

    <main>
        <h1 class="h3title">Health and Safety</h1>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="h3healthAndSafety.php" class="h3active">Health and Safety</a></li>
        </ul>

        <!--------Info Data---------->
        <div class="h3info-data">
            <div class="h3card">
                <div class="h3head">
                    <div>
                        <h2>15</h2>
                        <p>Completed Rides</p>
                    </div>
                    <i class='bx bxs-up-arrow bx-flashing bx-flip-horizontal h3icon' ></i>
                </div>
                <span class="h3progress" data-value="100%"></span>
                <span class="label">100%</span>
            </div>
            <div class="h3card">
                <div class="h3head">
                    <div>
                        <h2>0</h2>
                        <p>Accidents</p>
                    </div>
                    <i class='bx bxs-down-arrow bx-flashing bx-flip-horizontal h3icon down' ></i>
                </div>
                <span class="h3progress" data-value="0%"></span>
                <span class="label">0%</span>
            </div>
            <div class="h3card">
                <div class="h3head">
                    <div>
                        <h2>1</h2>
                        <p>Delays</p>
                    </div>
                    <i class='bx bxs-up-arrow bx-flashing bx-flip-horizontal h3icon' ></i>
                </div>
                <span class="h3progress" data-value="6.25%"></span>
                <span class="label">6.25%</span>
            </div>
        </div>
        <!--------Info Data---------->
        
<?php
require('sidebar_navbar_footer/h3continuation.php');
?>