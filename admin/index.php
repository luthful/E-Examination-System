<?php
session_start();
include_once '../database.php';
if(isset($_POST["admin_login_button"]))
{
	$username=$_POST["admin"];
	$password=$_POST["admin_password"];
	$sql="SELECT * FROM admin_login WHERE username='$username' and password='$password';";
	$result=executeQuery($sql);
	closeDB();
	if($result->num_rows>0)
	{

		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		header('location:admin_home.php');
	}
	else
	{
		echo "<script>alert('Invalid Username or Password')</script>";
	}
}





?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>::Admin Login</title>
<link rel="stylesheet" href="../index.css">

<script>
function login_validate()
{
	if(document.forms["admin_login_form"]["admin"].value.length==0)
	{
		alert("Please enter user name");
		document.forms["admin_login_form"]["admin"].focus();
		return false;
	}
	if(document.forms["admin_login_form"]["admin_password"].value.length==0)
	{
		alert("Password can't be empty");
		document.forms["admin_login_form"]["admin_password"].focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<!--<div class="header">
	<img id="headerimage" src="../images/header.gif" alt="DiREX">
</div>-->
<h1 style="color:red;text-align: center">Please Login to continue</h1>
<div align="center" style="background-color: #1d2547; color:white;padding:15px;">
<form id="admin_login_form" method="POST" onsubmit="return login_validate()" action="index.php">
<table cellspacing="10">
<tr><td><h3>Username</h3></td></tr>
<tr><td><input type="text" name="admin"></td></tr>
<tr><td><h3>Password</h3></td></tr>
<tr><td><input type="password" name="admin_password"></td></tr>
<tr><td><input type="submit" name="admin_login_button" value="Login"></td> <td><input type="reset" value="Reset"></td> </tr>
</table>
</form>
</div>
</body>
</html>