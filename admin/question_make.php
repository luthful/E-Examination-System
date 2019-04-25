<?php
session_start();
include_once '../database.php';
$test=0;
$question_title;
$no_of_questions=0;
$question_id;
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}
if(isset($_POST['initial_done']))
{
    $question_title=test_input($_POST["question_title"]);
    $no_of_questions=test_input($_POST["no_of_questions"]);

    $sql_initital="INSERT INTO question_title(question_title) VALUES('$question_title');";
    executeQuery($sql_initital);

    $question_id=$conn->insert_id;
    $_SESSION['question_id']=$question_id;
    $_SESSION['no_of_questions']=$no_of_questions;
    $test=1;


    closeDB();

}
if(isset($_POST["final_done"]))
{

  $question_id=$_SESSION['question_id'];
  $no_of_questions=$_SESSION['no_of_questions'];

    for($i=1;$i<=$no_of_questions;$i++)
{
    $question_no=$i;
    $total_marks=test_input($_POST["total_marks_$i"]);
    $question=test_input($_POST["question_$i"]);
    $sql_final="INSERT INTO questions VALUES($question_id,$question_no,$total_marks,'$question');";
    executeQuery($sql_final);
}
     closeDB();
    echo "<script> alert('Successfully created question'); </script>";
   header('location:admin_home.php');
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
     <p style="font-size:18pt;color:#53238c;">Question</p>
     <div class="dropdown_content" >
     <a href="show_all_questions.php" style="word-spacing: 2px;">Show All Made Questions</a>
     <a href="admin_home.php" style="word-spacing: 2px">Make New Question</a> 
     </div>
    </div>

    <a href="admin_home.php" style="word-spacing: 2px;">Examination</a>
    <a href="admin_home.php" style="word-spacing: 2px;">Result</a>
    <!--<a href="admin_home.php" style="word-spacing: 2px;">Discussion Forum</a>-->
    <a href="logout.php" >Logout</a>
</div>

<div align="center" style="color:white;">
<form id="question_make1" action="question_make.php"  method="POST">
<div id="should_hide">
<h3>Please enter Question title</h3>
<textarea class="before_question" name="question_title" rows="2" cols="55" placeholder="ex: Term Test 1" style="resize: none;"></textarea>
<h3>How many questions?</h3>
<input type="number" name="no_of_questions">
<br><br>
<input type="submit" name="initial_done" value="Ok">
</div>
</form>

<form id="question_make2" action="question_make.php" method="POST" >

<div id="next_hide" style="display: none;">
<?php
for($i=1;$i<=$no_of_questions;$i++)
{
    echo "<h3>Question no $i</h3>";
    echo '<br><br>';
    echo "Total Marks: ";?>
    <input type="number" name="total_marks_<?php echo $i?>" >;
    <?php echo '<br><br>';?>
    <textarea name="question_<?php echo $i?>" rows="5" cols="50" placeholder="Write Question here" style="resize:none;"></textarea>;
    <?php echo '<br><br>';?>
<?php } ?>


<br><br>
<input type="submit" name="final_done" value="Done">

</div>
</form>

</div>
</body>
</html>
<?php
if($test==1)
{
   echo "<script>document.getElementById('should_hide').style.display='none';</script>";
    echo "<script>document.getElementById('next_hide').style.display='block';</script>";
}


?>