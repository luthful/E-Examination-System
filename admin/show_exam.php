<?php
include_once '../database.php';
session_start();
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(isset($_POST["update_all"]))
{
    $exam_id=$_POST["exam_id"];
    $question_id=$_POST["question_id"];
    $exam_title=$_POST["exam_title"];
    $exam_password=$_POST["exam_password"];
    $sql="UPDATE exam set question_id=$question_id, exam_title='$exam_title',exam_password='$exam_password' where exam_id=$exam_id;";
    executeQuery($sql);
    closeDB();
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
     <a href="show_all_questions.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Show Examination</a> 
     <a href="exam.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Take Examination</a> 
     </div>
    </div>

    <a href="admin_home.php" style="word-spacing: 2px;">Result</a>
    <!--<a href="admin_home.php" style="word-spacing: 2px;">Discussion Forum</a>-->
    <a href="logout.php" >Logout</a>
</div>  


<div align="center">
<?php
$result=executeQuery("SELECT * FROM exam");
?>
<?php if($result->num_rows>0){?>

<form id="show_exam" method="POST" action="show_exam.php">
<?php
while($row=$result->fetch_assoc())
{?>
    <br>
    <h3 style="color:red">Exam Id</h3> <br>
    <input type="number" name="exam_id" value="<?php echo $row['exam_id'] ?>" readonly> <br><br>
    <h3 style="color:white">Question Id: </h3> <br>
    <input type="number" name="question_id" value="<?php echo $row['question_id'] ?>"> <br><br>
    <h3 style="color:white">Exam title</h3> <br>
    <textarea name="exam_title" rows="5" cols="50"> <?php echo $row['exam_title'] ?> </textarea>
    <h3 style="color:white">Exam Password</h3> <br>
    <input type="text" name="exam_password" value="<?php echo $row['exam_password'] ?>"> <br><br>
    <br><br>

<?php } 

closeDB();

?>

<input type="submit" name="update_all" value="Update">


</form>


<?php }
else
{
    echo '<h1 style="color:red">Sorry No Examination Found</h1>';
}
?>
</div>



</body>
</html>