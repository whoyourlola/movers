<?php
require('sidebar_navbar_footer/h3sidebar_nav.php');
if($_SESSION['ROLE']!=1){
	header('location:h3add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from leave_type where id='$id'");
}
$res=mysqli_query($con,"select * from leave_type order by id desc");
?>

<!--Main-->
    <main>
        
        <ul class="h3breadcrumbs">
            <li><a href="h3dashboard.php">Home</a></li>
            <li class="h3divider">/</a></li>
            <li><a href="#" class="h3active">Leave Type</a></li>
        </ul>

        
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Leave Type Admin </h4>
						         <h4 class="box_title_link"><a href="h3add_leave_type.php">Add Leave Type</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="80%">Leave Type</th>
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
                                       <td><?php echo $row['leave_type']?></td>
									   <td><a href="h3add_leave_type.php?id=<?php echo $row['id']?>">Edit</a> <a href="h3leave_type.php?id=<?php echo $row['id']?>&type=delete">Delete</a></td>
                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  
         
    </main>
<!--Main-->

<?php
require('sidebar_navbar_footer/h3continuation.php');
?>