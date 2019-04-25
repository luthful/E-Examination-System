<?php
session_start();
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
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

    <div class="dropdown">
     <p style="font-size:18pt;color:#53238c;">Examination</p>
     <div class="dropdown_content" >
     <a href="show_exam.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Show Examination</a> 
     <a href="exam.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Take Examination</a> 
     </div>
    </div>


    <div class="dropdown">
     <p style="font-size:18pt;color:#53238c;">Result</p>
     <div class="dropdown_content" >
     <a href="show_result.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Show Result</a> 
     <a href="make_result.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Make Result</a> 
     </div>
    </div>

    <!--<a href="admin_home.php" style="word-spacing: 2px;">Discussion Forum</a>-->
    <a href="viva_voce_admin.php" style="word-spacing: 2px;">Viva Voce</a>
    <a href="logout.php" >Logout</a>
</div>  


<div align="center">
<h1 style="color:yellow;">Hello! Welcome Admin!<br> Online Examination</h1>


</div>
  

</body>
</html>