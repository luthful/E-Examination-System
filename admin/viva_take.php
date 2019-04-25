<?php
session_start();
include_once '../database.php';
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}
if(isset($_POST["final_done"]))
{

    $viva_id=test_input($_POST["viva_id"]);
    $reg_no=test_input($_POST["reg_no"]);
    $viva_password=test_input($_POST["viva_password"]);

    $sql_final="INSERT INTO viva_take VALUES($viva_id,1,$reg_no,$viva_password);";
    executeQuery($sql_final);
    closeDB();
    echo "<script> alert('Successfully created Viva Process'); </script>";
    header('location:viva_current.php');
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

    <a href="viva_previous.php" style="word-spacing: 2px">View Previous Viva Voce</a>
    <a href="logout.php" >Logout</a>

</div>  


<div align="center" style="color:white;">

<form id="question_make2" action="viva_take.php" method="POST" >

<div id="next_hide" style="display: block;">

    <h3>Viva ID</h3>
    <input type="number" name="viva_id" >

    <h3>Registration no.</h3>
    <input type="number" name="reg_no" >

    <h3>Password</h3>
    <input type="password" name="viva_password">


<br><br>
<input type="submit" name="final_done" value="Done">

</div>
</form>

</div>
  



</body>
</html>