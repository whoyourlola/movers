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
     
        <?php if($_SESSION['ROLE']==2){?>
    <!--------Info Data---------->
    <div class="h3info-data">
            <div class="h3card">
                
                    
                        <h2><a href="h3time.php?id=<?php echo $_SESSION['USER_ID']?>" class="h3active">Time IN/OUT</a></h2>
            </div>
            
            <div class="h3card">
                
                    
                        <h2><a href="h3leave.php?id=<?php echo $_SESSION['USER_ID']?>" class="h3active">Leave request</a></h2>
            </div>
            
            <div class="h3card">
                
                    
                        <h2><a href="h3healthandsafety.php?id=<?php echo $_SESSION['USER_ID']?>" class="h3active">Safety Protocols</a></h2>
            </div>


    </div>
        </main>
        <!--------Info Data---------->
        <?php } else { ?>
        <div class="h3info-data">
            <div class="h3card">
                
                    
                    <h2>
						
			
                    <h2><a href="h3timesheet.php?id=<?php echo $_SESSION['USER_ID']?>" class="h3active">Attendance Admin</a></h2>

					
					</h2>
            </div>
            <div class="h3card">
                
                    
                    <h2>
						
			
                    <h2><a href="h3leave.php?id=<?php echo $_SESSION['USER_ID']?>" class="h3active">Leave requests</a></h2>

					
					</h2>
            </div>


            
            <?php } ?>
      

    </main>

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>