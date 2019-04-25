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

if(isset($_POST["submit_button"]))
{
  $no_of_ques=0;
  $result=executeQuery("SELECT COUNT(question_id) as sum FROM  viva_ques");
  
  if($result->num_rows>0)
    {
      if($row=$result->fetch_assoc()){
        $no_of_ques= $row["sum"];
        }
    }


    for($i=1;$i<=$no_of_ques;$i++){
    $question_id=test_input($_POST["no_$i"]);
    $question=test_input($_POST["question_$i"]);
    executeQuery("UPDATE viva_ques SET question='$question' where question_id=$question_id;"); }
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
     </div>
    </div>
    <a href="logout.php" >Logout</a>
</div>  

<div align="center">
<form id="update_question" method="POST" action="view_questions_viva.php">
<!-- <h3 style="color:white">Question Id: </h3><br>-->
<!--<input type="number" name="question_id" value="<?php echo $question_id ?>"> <br><br> -->

<?php
      
      $result=executeQuery("SELECT * FROM viva_ques;");
      
      
      if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
    ?>
       <h3 style="color:white">Question ID: </h3><br>
      <input type="number" name="no_<?php echo $row['question_id'] ?>" value="<?php echo $row['question_id'] ?>"> <br><br>
      <h3 style="color:white">Question: </h3><br>
      <textarea name="question_<?php echo $row['question_id'] ?>" rows="5" cols="50"> <?php echo $row['question'] ?> </textarea>
      <br><br>

    <?php }?>
      
      
     
     <input type="submit" name="submit_button" value="Update">
     <?php } closeDB(); ?>

</form>

</div>
  

</body>
</html>