<?php
session_start();
include_once '../database.php';

if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}
if(isset($_GET['msg']))
{
   $question_id=$_GET['msg'];
}

if(isset($_POST["submit_button"]))
{
  $question_id=$_POST["question_id"];
	$result=executeQuery("SELECT COUNT(question_no) as sum FROM  questions where question_id=$question_id");
	$no_of_ques=0;
	if($result->num_rows>0)
    {
    	if($row=$result->fetch_assoc()){
        $no_of_ques= $row["sum"];
        }
    }
    for($i=1;$i<=$no_of_ques;$i++){
    $total_marks=$_POST["marks_$i"];
    $question=$_POST["question_$i"];
    executeQuery("UPDATE questions SET total_marks=$total_marks and question='$question' where question_id=$question_id and question_no=$i;"); }


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

<div align="center">
<form id="update_question" method="POST" action="show_ques_detail.php">
  <h3 style="color:white">Question Id: </h3><br>
<input type="number" name="question_id" value="<?php echo $question_id ?>" readonly> <br><br>

<?php
      
      $result=executeQuery("SELECT * FROM questions where question_id=$question_id;");
      
      
      if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
    ?>
       <h3 style="color:white">Question No: </h3><br>
      <input type="number" name="no_<?php echo $row['question_no'] ?>" value="<?php echo $row['question_no'] ?>"> <br><br>
      <h3 style="color:white">Marks: </h3><br>
      <input type="number" name="marks_<?php echo $row['question_no'] ?>" value="<?php echo $row['total_marks'] ?>"> <br><br>
      <textarea name="question_<?php echo $row['question_no'] ?>" rows="5" cols="50"> <?php echo $row['question'] ?> </textarea>
      <br><br>

    <?php }?>
      
      
     <?php } closeDB(); ?>
     <input type="submit" name="submit_button" value="Update">


</form>

</div>

</body>
</html>