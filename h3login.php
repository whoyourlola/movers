<?php
require('db connection/db.connection.php');
$msg="";
if(isset($_POST['email']) && isset($_POST['password'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$res=mysqli_query($con,"select * from employee where email='$email' and password='$password'");
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['ROLE']=$row['role'];
		$_SESSION['USER_ID']=$row['id'];
		$_SESSION['USER_NAME']=$row['name'];
		header('location:h3dashboard.php');
		die();
	}else{
		$msg="Please enter correct login details";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/h3logdesign.css">
	<link rel="stylesheet" href="css/h3style.css">
    <title>Login</title>
</head>

         
<body>         
	
			
               <div class="form-container">
                  <form method="post">
					<img src="images/logo1.1.png" alt="" class="login_img">
                    <h3>Login</h3>

                     
                    
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                     
                     
                       
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     
                        <button type="submit" class="btn">Sign in</button>
					      <div class="result_msg"><?php echo $msg?></div>
					  </form>
               </div>
         
         
      
</body>
</html>