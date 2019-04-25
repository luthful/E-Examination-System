<?php
include_once 'database.php';

if(isset($_POST["register_button"]))
{
  $name=test_input($_POST["std_name"]);
  $reg_no=test_input($_POST["reg_no"]);
  $password=test_input($_POST["password"]);
  $email=test_input($_POST["std_email"]);
  $department=test_input($_POST["department"]);
  $semester=test_input($_POST["semester"]);
  $session=test_input($_POST["session"]);
  
  
  $sql_exist="SELECT * FROM student where reg_no=$reg_no";
  $result=executeQuery($sql_exist);
  if($result->num_rows>0)
  {
  	echo "<script>alert('Sorry! this registration no. already registered')</script>";
  }

  else{

  $sql_insert="INSERT INTO student VALUES('$name',$reg_no,'$password','$email','$department','$semester','$session');";
  executeQuery($sql_insert);

  closeDB();
  header("location:index.php");
  }



}






function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>::Register</title>
<link rel="stylesheet" href="index.css">
<script src="reg_validate.js"> </script><head>
<style>
ul {
    list-style-type: none;
    position: -webkit-sticky; /* Safari */
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

<div>

<div align="center">
	<form id="reg_form" onsubmit="return validate()" method="POST" action="register.php">
<table style="padding:20px;border: 1x solid red; background: DarkSlateGray; color:white;">
<tr>
<tr width="500" height="50"><td><center><b>Please fill up the form</b></center</td></tr>
<tr><td>Name</td></tr>
<tr><td><input type="text" name="std_name"></td></tr>
<tr><td>Reg. no</td></tr>
<tr><td><input type="number" name="reg_no" ></td></tr>
<tr><td>Password</td></tr>
<tr><td><input type="password" name="password" ></td></tr>
<tr><td>Email</td></tr>
<tr><td><input type="email" name="std_email" ></td></tr>
<tr><td>Department</td></tr>
<tr><td><input type="text" name="department" list="dept_list">
<datalist id="dept_list">
<option value="PHY">
<option value="CHE">
<option value="GEE">
<option value="MAT">
<option value="OCE">
<option value="STAT">
<option value="GEB">
<option value="CSE">
<option value="EEE">
<option value="IPE">
</datalist>
</td></tr>
<tr><td>Semester</td></tr>
<tr><td><input type="text" name="semester" list="sem_list"></td></tr>
<datalist id="sem_list">
<option value="1/1">
<option value="1/2">
<option value="2/1">
<option value="2/2">
<option value="3/1">
<option value="3/2">
<option value="4/1">
<option value="4/2">
</datalist>
<tr><td>Session</td></tr>
<tr><td><input type="text" name="session" list="session_list"></td></tr>
<datalist id="session_list">
<option value="2010-2011">
<option value="2011-2012">
<option value="2012-2013">
<option value="2013-2014">
<option value="2014-2015">
<option value="2015-2016">
<option value="2016-2017">
<option value="2017-2018">
</datalist>
<tr><td><input type="submit" name="register_button" value="Sign Up"></td><td><input type="reset" ></td></tr>

</table>
</form>
</div>

<div>

</body>
</html>