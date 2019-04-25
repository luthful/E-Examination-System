<?php
session_start();
include_once '../database.php';
$lets_go=false;

if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}
if($lets_go==true)
{
	header('location:show_ques_detail.php');
}

if(isset($_POST["update_all"]))
{
	$res=executeQuery("SELECT COUNT(question_id) as sum FROM  question_title");
	$no_of_questions=0;
    if($row=$res->fetch_assoc())
    {
    	$no_of_questions=$row["sum"];
    }

	for($i=1;$i<=$no_of_questions;$i++){
	$question_title=test_input($_POST["title_$i"]);
    executeQuery("UPDATE question_title SET question_title='$question_title' where question_id=$i");
    }
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
<style>
#show_questions_table 
{
	color:white;
}
#show_questions_table:hover
{
	color:red;
}


</style>
</head>
<body>

<div align="left" id="header" style="font-size:18pt;">
    <a href="admin_home.php" style="word-spacing: 2px;">Home</a>
    <div class="dropdown">
     <p style="font-size:18pt;color:#53238c;">Question</p>
     <div class="dropdown_content" >
     <a href="show_all_questions.php" style="word-spacing: 2px;">Show All Made Questions</a>
     <a href="question_make.php" style="word-spacing: 2px">Make New Question</a> 
     </div>
    </div>

    <a href="admin_home.php" style="word-spacing: 2px;">Examination</a>
    <a href="admin_home.php" style="word-spacing: 2px;">Result</a>
   <!-- <a href="admin_home.php" style="word-spacing: 2px;">Discussion Forum</a>-->
    <a href="logout.php" >Logout</a>
</div>

<div align="center">
<?php
$result=executeQuery("SELECT * FROM question_title");
?>
<?php if($result->num_rows>0){?>

<form id="edit_question_title" method="POST" action="show_all_questions.php">
<?php
while($row=$result->fetch_assoc())
{?>
	<br>
    <h3 style="color:red">Question ID: <?php echo $row["question_id"] ?> </h3>;
    <textarea name="title_<?php echo $row['question_id'] ?>" rows="5" cols="50"><?php echo $row['question_title'] ?> </textarea>
    <br>
    <?php $q_id=$row["question_id"]?>
    <a href="show_ques_detail.php?msg=<?php echo $q_id; ?>"> View Questions </a>
    <br>
    

    <br><br>


<?php } 

closeDB();

?>

<input type="submit" name="update_all" value="Update">


</form>
<!-- <script>
	function test($str)
	{
		alert($str);
    localStorage.setItem("question_id",$str);
	}
</script> -->


<?php }
else
{
	echo '<h1 style="color:red">Sorry No Questions Found</h1>';
}
?>
</div>





</body>
</html>

