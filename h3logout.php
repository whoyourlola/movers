<?php
session_start();
unset($_SESSION['ROLE']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
header('location:h3login.php');
die();
?>