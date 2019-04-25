<?php
session_start();
include_once '../database.php';
$reg_no=0;
$exam_id=0;
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(null!==($_GET["reg_no"] && $_GET["exam_id"]))
{
	$reg_no=$_GET["reg_no"];
	$exam_id=$_GET["exam_id"];
}

if(isset($_POST["remark_button"]))
{
	$total=$_POST["total"];
	$reg_no=$_POST["reg_no"];
	$exam_id=$_POST["exam_id"];
	$question_id=$_POST["question_id"];

	for($i=1;$i<=$total;$i++)
	{
		$mark=$_POST["mark_$i"];
		$sql="INSERT INTO marks VALUES ($reg_no,$exam_id,$question_id,$i,$mark);";
		executeQuery($sql);
	}
	$sql="INSERT INTO reg_complete VALUES($exam_id,$reg_no,'yes');";
	executeQuery($sql);
	header('location:make_result.php?exam_id=$exam_id');
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
    <a href="logout.php" >Logout</a>
</div>  

<div align="center" style="color: white">
<h2><?php echo $reg_no ?> </h2>

<form method="POST" action="view_paper.php">
<?php
$sql="SELECT * FROM answer natural join questions where exam_id=$exam_id and reg_no=$reg_no";
$result=executeQuery($sql);
$total_no_questions=$result->num_rows;
if($result->num_rows>0)
{
	while($row=$result->fetch_assoc())
	{
	$question_id=$row["question_id"];
		?>

	<h3>Question no: <?php echo $row["question_no"]?> </h3><br>
	<h3>Question: <?php echo $row["question"]?> </h3><br>
	<h3>Total Marks: <?php echo $row["total_marks"]?> </h3><br>
	<h3>Answer: <?php echo $row["answer"]?> </h3><br>
	<h3>Marks: </h3>
	<input type="number" name="mark_<?php echo $row["question_no"] ?>" step="0.5" min="0" max="<?php echo $row["total_marks"]?>" placeholder="Remark">

    	


<?php }} ?>
<input type="hidden" name="total" value="<?php echo $total_no_questions ?>">
<input type="hidden" name="reg_no" value="<?php echo $reg_no ?>">
<input type="hidden" name="exam_id" value="<?php echo $exam_id ?>">
<input type="hidden" name="question_id" value="<?php echo $question_id ?>">

<br>
<input type="submit" name="remark_button"  value="Done">

</form>
 </div>

</body>
</html>