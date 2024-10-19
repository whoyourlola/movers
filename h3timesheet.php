<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
$name='';
$email='';
$mobile='';
$department_id='';
$address='';
$birthday='';
$id='';

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
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$department_id=mysqli_real_escape_string($con,$_POST['department_id']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$birthday=mysqli_real_escape_string($con,$_POST['birthday']);
	if($id>0){
		$sql="update employee set name='$name',email='$email',mobile='$mobile',password='$password',department_id='$department_id',address='$address',birthday='$birthday' where id='$id'";
	}else{
		$sql="insert into employee(name,email,mobile,password,department_id,address,birthday,role) values('$name','$email','$mobile','$password','$department_id','$address','$birthday','2')";
	}
	mysqli_query($con,$sql);
	header('location:h3timesheet.php');
	die();
}
?>

        <!--Main-->
    <main>
        <h1 class="h3title">Timesheet</h1>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Attendance</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Timesheet</a></li>
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

                <div class="time2-container">					
						<div class="card2">
							<div class="card-body2">
							<h4 class="box-title2">Timesheet </h4>
								<?php if($_SESSION['ROLE']==2){ ?>
							
							<?php } ?>
							</div>
							<div class="card-body-2">
							<div class="table-stats order-table ov-h">
								<table class="table2 ">
									<thead>
										<tr>
										<th >S.No</th>
										<th >ID</th>
										<th >Employee Name</th>
										<th >Time IN</th>
										<th >Time OUT</th>
										<th ></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1;
										while($row=mysqli_fetch_assoc($res)){?>
										<tr>
										<td><?php echo $i?></td>
										<td><?php echo $row['id']?></td>
										<td><?php echo $row['name'].' ('.$row['eid'].')'?></td>
										<!--<td><?php echo $row['leave_from']?></td>
										<td><?php echo $row['leave_to']?></td>
										<td><?php echo $row['leave_description']?></td>-->

										</tr>
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