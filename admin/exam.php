<?php
include_once '../database.php';
session_start();
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(isset($_POST["submit_button"]))
{
	$question_id=$_POST["question_id"];
	$exam_title=$_POST["exam_title"];
	$exam_password=$_POST["exam_password"];
	$sql="INSERT INTO exam (question_id,exam_title,exam_password) VALUES($question_id,'$exam_title','$exam_password');";
	executeQuery($sql);
	closeDB();
	header('location:admin_home.php');
}


?>

<!DOCTYPE html>
<html>
<head>
<title>::Home</title>
<link rel="stylesheet" href="admin_home.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div align="left" id="header" style="font-size:18pt;">
    <a href="admin_home.php" style="word-spacing: 2px;">Home</a>
    <div class="dropdown">
     <p style="font-size:18pt;color:#53238c;">Question</p>
     <div class="dropdown_content" >
     <a href="show_all_questions.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Show All Questions</a> 
     <a href="question_make.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Make New Question</a> 
     </div>
    </div>

    <a href="admin_home.php" style="word-spacing: 2px;">Examination</a>
    <a href="admin_home.php" style="word-spacing: 2px;">Result</a>
    <!--<a href="admin_home.php" style="word-spacing: 2px;">Discussion Forum</a>-->
    <a href="logout.php" >Logout</a>
</div>

<div align="center">
<form method="POST" action="exam.php">

<h3 style="color:white">Enter Question ID</h3>
<input type="number" name="question_id">
<h3 style="color:white">Exam Title</h3>
<textarea name="exam_title" rows="5" cols="50" placeholder="ex: Term Test 1 (session: 2014-2015)"></textarea>
<h3 style="color:white">Exam password</h3>
<input type="password" name="exam_password">
<br><br>
<input type="submit" name="submit_button" value="Done">

</form>
</div>
</body>
</html>