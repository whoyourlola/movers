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
	<?php if($_SESSION['ROLE']==1){?>
		<h1 class="h3title">Attendance Admin</h1>
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Attendance Admin</a></li>

        </ul>

                <div class="time2-container">					
						<div class="card2">
							<div class="card-body2">
							<h4 class="box-title2">Employees Attendance </h4>
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
										<th >Date</th>
										<th >Time IN</th>
										<th >Time OUT</th>
										<th >Overtime</th>
										<th ></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1;
										while($row=mysqli_fetch_assoc($res2)){?>
										<tr>
										<td><?php echo $i?></td>
										<td><?php echo $row['id']?></td>
										<td><?php echo $row['name'].' ('.$row['e_attendance_id'].')'?></td>
										<td><?php echo $row['date']?></td>
                                      	<td><?php echo $row['time_in']?></td>
									   	<td><?php echo $row['time_out']?></td>
										<td><?php echo $row['Overtime']?></td>
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
		<?php } else { ?>
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
										<th >Date</th>
										<th >Time IN</th>
										<th >Time OUT</th>
										<th >Overtime</th>
										<th ></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1;
										while($row=mysqli_fetch_assoc($res2)){?>
										<tr>
										<td><?php echo $i?></td>
										<td><?php echo $row['id']?></td>
										<td><?php echo $row['name'].' ('.$row['e_attendance_id'].')'?></td>
										<td><?php echo $row['date']?></td>
                                      	<td><?php echo $row['time_in']?></td>
									   	<td><?php echo $row['time_out']?></td>
										<td><?php echo $row['Overtime']?></td>
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
					<?php } ?>					

    </main>
        <!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>