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
  <li style="font-family: Abel; font-size: 25px; border-right: 2px solid #bbb"><a class="active" href="user_home.php">DiReX(Discussion, Result and Examination)</a></li>
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

<h2>Please contact the administrator</h2>

</div>
</form>
</div>

<div align="center" class="footer_class">
<i>©&nbsp; EExam - 2019,&nbsp;&nbsp;&nbsp;&nbsp; Developed by : Luthful Hasan and Tanvir Alif</i>
</div>


    </div>
</body>
</html>