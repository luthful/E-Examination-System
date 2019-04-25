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
     <p style="font-size:18pt;color:#53238c;">Questions</p>
     <div class="dropdown_content" >
     <a href="add_questions_viva.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Add Questions</a> 
     <a href="view_questions_viva.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">View Questions</a> 
     <a href="delete_questions_viva.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Delete Questions</a> 
     </div>
    </div>

    <a href="viva_take.php" style="word-spacing: 2px">Take Viva</a>
    <a href="viva_previous.php" style="word-spacing: 2px">View Previous Viva Voce</a>
    <a href="viva_current.php" style="word-spacing: 2px">Currently Running Viva</a>
    

    <a href="logout.php" >Logout</a>
</div>  


<div align="center">
<h1 style="color:yellow;">Hello! Welcome Admin!<br> Online Examination</h1>


</div>
  

</body>
</html>