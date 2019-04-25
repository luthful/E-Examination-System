<?php
session_start();
include_once 'database.php';
if(isset($_POST["login_button"]))
{
  $reg_no=$_POST["reg_no"];
  $password=$_POST["password"];
  $sql="SELECT * FROM student where reg_no=$reg_no and password='$password';";
  $result=executeQuery($sql);
  closeDB();
  if($result->num_rows>0)
  {
  	$row=$result->fetch_assoc();
  	$_SESSION['reg_no']=$reg_no;
  	$_SESSION['std_name']=$row["fullname"];
  	header('location:user_home.php');
  }
  else
  {
      echo "<script>alert('Invalid Reg no. or Password')</script>";
  }



}


?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>::Login</title>
<link rel="stylesheet" href="index.css">
<script src="login_validate.js"></script><head>
<style>
ul {
    list-style-type: none;
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: DarkSlateGray;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    /*font-size: 25px;*/
    /*font-style: cursive;*/
    text-align: justify;
    padding:12px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: black;
}
</style>
</head>
<body>

<ul>
  <li style="font-family: Abel; font-size: 25px; border-right: 2px solid #bbb"><a class="active" href="index.php">Online Examination</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="https://www.sust.edu/about/notice-board">News</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="https://www.quora.com/">Forum</a></li>
  <li style="float:right; font-family:Book Antiqua ; font-size: 15px; border-left: 2px solid #bbb"><a href="about.php">About</a></li>

</ul>

</body>
</head>
<body >

<div style="background-color: DarkSlateGray; color:white;padding:15px;" class="content_class">
<form id="login_form"  onsubmit="return login_validate()" method="POST" action="index.php">
<div class="login_class" align="center">
	
    

	<table >
		<tr>
			<td width="160" height="155">
				<img src="images/login_image.jpg" alt="" width="160" height="155">
			</td>
		<td>
		<table >
			<table cellspacing="10">
				<tr><td style="color:White"><b>Please Login to continue!<b></td></tr>
					<tr><td>Reg. no</td></tr>
					<tr><td><input type="number" name="reg_no" value="" size="40" ></td></tr>
					<tr><td>Password</td></tr>
					<tr><td><input type="password" name="password" size="40"></td></tr>
					<tr><td style="width:50px;"><input type="submit" name="login_button" value="Login"></td></tr>
					<tr><td ><a href="forgot_password.php" style="color: silver;">Forgot Password</a></td><td>
	<a href="register.php" style="color: silver;">Register</a>
	</td></tr>

			</table>
			
		</table>

        </td>
     
</tr>

	</table>



</div>
</form>
</div>

<div align="center" class="footer_class">
<i>©&nbsp; EExam - 2019,&nbsp;&nbsp;&nbsp;&nbsp; Developed by : Luthful Hasan and Tanvir Alif</i>
</div>


    </div>
</body>
</html>