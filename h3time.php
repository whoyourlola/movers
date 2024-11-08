<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
$name='';
$email='';
$mobile='';
$department_id='';
$address='';
$birthday='';
$id='';
$e_attendance_id='';

if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from employee where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$department_id=$row['department_id'];
	$address=$row['address'];
	$birthday=$row['birthday'];
}

if(isset($_POST['timeIN'])){
	$time_in=mysqli_real_escape_string($con,$_POST['time_in']);
	$time_out=mysqli_real_escape_string($con,$_POST['time_out']);
	$e_attendance_id=$_SESSION['USER_ID'];
	$sql="insert into `attendance`(e_attendance_id, date, time_in) values('$e_attendance_id', NOW(), NOW())";
	mysqli_query($con,$sql);
	header('location:h3time.php?id='.$_SESSION['USER_ID']);
	die();
}

if($_SESSION['ROLE']==1){ 
	$sql="select `attendance`.*, employee.name,employee.id as e_attendance_id from `attendance`,employee where `attendance`.e_attendance_id=employee.id order by `attendance`.id desc";
	
}else{
	$e_attendance_id=$_SESSION['USER_ID'];
	$sql="select `attendance`.*, employee.name ,employee.id as e_attendance_id from `attendance`,employee where `attendance`.e_attendance_id='$e_attendance_id' and `attendance`.e_attendance_id=employee.id order by `attendance`.id desc";
}
$res2=mysqli_query($con,$sql);
?>

        <!--Main-->
    <main>
        <h1 class="h3title">Time IN/OUT</h1>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Attendance</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Time IN/OUT</a></li>
        </ul>

			
			   <!-- Profile DETAILS -->
				<div class="time-container">
		 			<div class="card1">
                        <div class="card-body1">
                           <form method="post">
							   <div class="form-group1">
									<label class=" form-control-label1">Name: <span style="color:blue"><?php echo $name?></span></label>
									
								</div>
								<div class="form-group1">
									<label class=" form-control-label1">Email: <span style="color:blue"><?php echo $email?></span></label>
								</div>
								<div class="form-group1">
									<label class=" form-control-label1">Mobile: <span style="color:blue"><?php echo $mobile?></span></label>
								</div>
								<div class="form-group1">
									<label class=" form-control-label1">Department: <select name="department_id" required class="form-control-1">
										<option value="">Select Department</option>
										<?php
										$res=mysqli_query($con,"select * from department order by department desc");
										while($row=mysqli_fetch_assoc($res)){
											if($department_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['department']."</option>";
											}
										}
										?>
									</select></label>
								</div>
									
								<div class="form-group1">
									<label class=" form-control-label1">Address: <span style="color:blue"><?php echo $address?></span></label>
								</div>
								<div class="form-group1">
									<label class=" form-control-label1">Birthday: <span style="color:blue"><?php echo $birthday?></span></label>
								</div>

							  </form>
                        </div>
					</div>
				</div>





					<div class="clock-container">
						<!-- Digital Clock -->
						<div class="digital-clock" id="digital-clock">00:00:00</div>
						<div class="date" id="date">January 1, 1970</div>

					<form method="POST">	
						<button type="submit" name="timeIN" class="timebtn">Time IN</button>
						<button type="submit" name="timeOUT" class="timebtn">Time OUT</button>
					</div>
					</form>		
							   


                <!-- Time IN/OUT TABLE-->
					<div class="time2-container">					
						<div class="card2">
							<div class="card-body2">
							<h4 class="box-title2">Time In/OUT </h4>
							</div>
							<div class="card-body-2">
							<div class="table-stats order-table ov-h">
								<table class="table2 ">
									<thead>
										<tr>
		
										<th width="35%">Name</th>
										<th width="15%">Date</th>
										<th width="25%">Time IN</th>
										<th width="25%">Time OUT</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res2)){?>
										<tr>
									   <td><?php echo $row['name'].' ('.$row['e_attendance_id'].')'?></td>
									   <td><?php echo $row['time_in']?></td>
                                       <td><?php echo $row['time_in']?></td>
									   <td><?php echo $row['time_out']?></td>
									

									<?php 
									$i++;
									} ?>
									</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
			
    </main>
        <!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>