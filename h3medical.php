<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
?>

    <main>
        <h1 class="h3title">Medical Submission</h1>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="h3health.php" class="h3active">Medical Submission</a></li>
        </ul>

        <div class="card">
                        <div class="card-header"><strong>Submit Medical Files</strong></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
								
								<input type="file"  name="file" class="form-control" required></div>
							   <div id="fileinfo" class="file-info"></div>
							   <button  type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  </form>

                        </div>
                     </div>
       
        
<?php
require('sidebar_navbar_footer/h3continuation.php');
?>