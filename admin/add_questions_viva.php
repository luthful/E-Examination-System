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
if(isset($_POST["final_done"]))
{

    $question_id=test_input($_POST["question_id"]);
    $questions=test_input($_POST["Question"]);
    $sql_final="INSERT INTO viva_ques VALUES($question_id,'$questions');";
    executeQuery($sql_final);
    closeDB();
    echo "<script> alert('Successfully created question'); </script>";
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

<div align="center" style="color:white;">

<form id="question_make2" action="add_questions_viva.php" method="POST" >

<div id="next_hide" style="display: block;">

    <h3>Question ID</h3>

    <input type="number" name="question_id" >;
    <h3>Questions</h3>

    <textarea name="Question" rows="5" cols="50" placeholder="Write Question here" style="resize:none;"></textarea>;

<br><br>
<input type="submit" name="final_done" value="Done">

</div>
</form>

</div>
  

</body>
</html>