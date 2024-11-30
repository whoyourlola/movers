<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
if($_SESSION['ROLE']!=1){
	header('location:h3add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}

$date='';
$time_in='';
$time_out='';
$Overtime='';

if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$res=mysqli_query($con,"select * from attendance where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$timeIn=$row['time_in'];
    $timeOUT=$row['time_out'];
    $overTIME=$row['Overtime'];
}

if(isset($_POST['submit'])){
	$leave_type=mysqli_real_escape_string($con,$_POST['leave_type']);
	if($id>0){
		$sql="update leave_type set leave_type='$leave_type' where id='$id'";
	}else{
		$sql="insert into leave_type(leave_type) values('$leave_type')";
	}
	mysqli_query($con,$sql);
	header('location:h3leave_type.php');
	die();
}

?>

        <!--Main-->
    <main>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="h3settings.php" class="h3active">Edit Employees Timesheet</a></li>
        </ul>

        <div class="card">
						
                        <div class="card-header">Edit Employee Time</div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
								<label for="leave_type" class=" form-control-label">Edit Time IN</label>
								<input type="time" value="<?php echo $time_in?>" name="timeIN" placeholder="Edit time" class="form-control" required>
							   
                                <label for="leave_type" class=" form-control-label">Edit Time Out</label>
								<input type="time" value="<?php echo $time_out?>" name="timeOUT" placeholder="Edit time" class="form-control" required>

                                <label for="leave_type" class=" form-control-label">Edit Overtime</label>
								<input type="time" value="<?php echo $Overtime?>" name="overTIME" placeholder="Edit time" class="form-control" required>
							   <button  type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  </form>
                        </div>
                     </div>

    </main>
        <!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>