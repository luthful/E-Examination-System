<?php
session_start();
include_once '../database.php';
$question_id;
$questions;

if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}


if(isset($_POST["submit_button"]))
{
  $question_id=$_POST["question_id"];
  executeQuery("delete from viva_ques where question_id=$question_id;");
  header('location:viva_voce_admin.php');
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
<title>DiREX::Home</title>
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
     </div>
    </div>
    <a href="logout.php" >Logout</a>
</div>  

<div align="center">
<form id="update_question" method="POST" action="delete_questions_viva.php">
<!-- <h3 style="color:white">Question Id: </h3><br>-->
<!--<input type="number" name="question_id" value="<?php echo $question_id ?>"> <br><br> -->

      <h3 style="color:white">Enter Question ID: </h3><br>
      <input type="number" name="question_id"> <br><br>
      <br><br>
     <input type="submit" name="submit_button" value="Update">


</form>

</div>
  

</body>
</html>