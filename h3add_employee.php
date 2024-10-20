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
	header('location:h3employee.php');
	die();
}//ssssss
?>

<!--Main-->
    <main>
              
					 <?php if($_SESSION['ROLE']==1){?>
						<ul class="h3breadcrumbs">
            				<li><a href="h3dashboard.php">Home</a></li>
            				<li class="h3divider">/</a></li>
            				<li><a href="#" class="h3active">Add Employee</a></li>

        				</ul>
                        <div class="card-header">Add Employee</div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter employee name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter employee password" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Department</label>
									<select name="department_id" required class="form-control">
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
									</select>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Birthday</label>
									<input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter employee birthday" class="form-control" required>
								</div>
							   
							   <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   

							   <?php } else { ?>
							<ul class="h3breadcrumbs">
            					<li><a href="h3dashboard.php">Home</a></li>
            					<li class="h3divider">/</a></li>
            					<li><a href="#" class="h3active">My Profile</a></li>

        					</ul>
								<div class="card-header">Edit Profile</div>
							<div class="card-body card-block">
							<form method="post">
								<div class="form-group">
										<label class=" form-control-label">Name</label>
										<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter employee name" class="form-control" required>
									</div>
									<div class="form-group">
										<label class=" form-control-label">Email</label>
										<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
									</div>
									<div class="form-group">
										<label class=" form-control-label">Mobile</label>
										<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee mobile" class="form-control" required>
									</div>
									<div class="form-group">
										<label class=" form-control-label">Password</label>
										<input type="password"  name="password" placeholder="Enter employee password" class="form-control" required>
									</div>
									<div class="form-group">
										<label class=" form-control-label">Department</label>
										<select name="department_id" required class="form-control">
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
										</select>
									</div>
									<div class="form-group">
										<label class=" form-control-label">Address</label>
										<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
									</div>
									<div class="form-group">
										<label class=" form-control-label">Birthday</label>
										<input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter employee birthday" class="form-control" required>
									</div>
								
								<button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
								<span id="payment-button-amount">Submit</span>
								</button>
								<?php } ?>
								</form>
							</div>
						</div>
				
                  
    </main>
<!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>