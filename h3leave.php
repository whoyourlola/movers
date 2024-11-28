<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from `leave` where id='$id'");
}
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$status=mysqli_real_escape_string($con,$_GET['status']);
	mysqli_query($con,"update `leave` set leave_status='$status' where id='$id'");
}
if($_SESSION['ROLE']==1){ 
	$sql="select `leave`.*, employee.name,employee.id as eid from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
}else{
	$eid=$_SESSION['USER_ID'];
	$sql="select `leave`.*, employee.name ,employee.id as eid from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$res=mysqli_query($con,$sql);
?>

        <!--Main-->
    <main>
      
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Leave Request</a></li>
        </ul>

        
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Leave Requests </h4>
						    <?php if($_SESSION['ROLE']==2){ ?>
						   <h4 class="box_title_link"><a href="h3add_leave.php">Add Leave</a> </h4>
						   <?php } ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
									   <th width="15%">Employee Name</th>
                                       <th width="14%">From</th>
									   <th width="14%">To</th>
									   <th width="15%">Description</th>
									   <th width="18%">Leave Status</th>
									   <th width="10%"></th>
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
                                       <td><?php echo $row['leave_from']?></td>
									   <td><?php echo $row['leave_to']?></td>
									   <td><?php echo $row['leave_description']?></td>
									   <td>
										   <?php
											if($row['leave_status']==1){
												echo "Pending";
											}if($row['leave_status']==2){
												echo "Approved";
											}if($row['leave_status']==3){
												echo "Rejected";
											}
										   ?>
										</td>
										<td>
										   <?php if($_SESSION['ROLE']==1){ ?>
										   <select class="form-control" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
											<option value="">Update Status</option>
											<option value="2">Approved</option>
											<option value="3">Rejected</option>
										   </select>
										   <?php } ?>
									   
									   <?php
									   if($row['leave_status']==1){ ?>
									   <a href="h3leave.php?id=<?php echo $row['id']?>&type=delete">Delete</a>
									   <?php } ?>
									   
									   
									   </td>
									   
                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                 
         <script>
		 function update_leave_status(id,select_value){
			window.location.href='h3leave.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>
    </main>
        <!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>