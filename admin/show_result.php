<?php
session_start();
include_once '../database.php';

$show_result=false;

if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(isset($_GET["exam_id"])){
    $exam_id=$_GET["exam_id"];
    $show_result=true;
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

<div align="center" id="show_div" style="color: white">
<?php
$sql="SELECT * FROM published_result NATURAL JOIN exam WHERE is_published='yes'";
$result=executeQuery($sql);
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {?>
    <h3>Exam Id: <?php echo $row["exam_id"] ?> </h3> <h3>Exam Title: <?php echo $row["exam_title"] ?> </h3>
    <a href="show_result.php?exam_id= <?php echo $row["exam_id"] ?>">View Result</a>
    <a href="../result_pdf/result_pdf.php?exam_id= <?php echo $row["exam_id"] ?>">PDF Download</a>


<?php }}?>



</div>

<div align="center" id="view_div" style="color: white;display: none;">
<?php
$sql="SELECT * FROM result WHERE exam_id=$exam_id";
$result=executeQuery($sql);
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    { ?>

    <h3>Exam Id: <?php echo $row["exam_id"] ?> </h3>
    <h3>Reg no: <?php echo $row["reg_no"] ?> </h3>
    <h3>Marks: <?php echo $row["marks"] ?> </h3>


<?php }} ?> 


</div>

<script>
    <?php if($show_result==true){ ?>
  document.getElementById("show_div").style.display="none";
  document.getElementById("view_div").style.display="block"; 
<?php } ?>
</script>
</body>
</html>
