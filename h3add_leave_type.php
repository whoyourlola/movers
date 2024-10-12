<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
if($_SESSION['ROLE']!=1){
	header('location:h3add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
$leave_type='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$res=mysqli_query($con,"select * from leave_type where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$leave_type=$row['leave_type'];
}
if(isset($_POST['leave_type'])){
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
            <li><a href="#" class="h3active">Add Leave Type</a></li>
        </ul>

        <div class="content">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
								<label for="leave_type" class=" form-control-label">Leave Type</label>
								<input type="text" value="<?php echo $leave_type?>" name="leave_type" placeholder="Enter your leave type" class="form-control" required></div>
							   
							   <button  type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </main>
<!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>