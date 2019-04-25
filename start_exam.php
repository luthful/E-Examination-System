<?php
session_start();
include_once 'database.php';
$start_exam=false;
$reg_no;
$std_name;
if(!isset($_SESSION['reg_no']))
{
    $_GLOBALS['message']="Session timeout please relogin";
    echo "<script>Session timeout Relogin please</script>";
    header('location:index.php');
}
else
{
   $reg_no=$_SESSION['reg_no'];
   $std_name=$_SESSION['std_name'];
   echo "<script>alert successful</script>";
}
if(isset($_GET["exam_id"]))
{
    $exam_id=$_GET["exam_id"];
}

if(isset($_POST["pass_val"]))
{
    $exam_id=$_POST["exam_id"];
    $password=$_POST["exam_pass"];
    $result=executeQuery("SELECT * FROM exam where exam_id=$exam_id and exam_password=$password");
    if($result->num_rows>0)
    {
        $start_exam=true;
    }
    else
    {
        echo "<script> alert('Invalid password'); </script>";
    }

}

if(isset($_POST["done_exam"]))
{
    $exam_id=$_POST["exam_id"];
    $question_id=$_POST["question_id"];
    $no_of_questions=0;

    $sql="SELECT SUM(question_no) as sum FROM questions where question_id=$question_id";
    $result=executeQuery($sql);
    if($result->num_rows>0)
    {
        $row=$result->fetch_assoc();
        $no_of_questions=$row["sum"];
    }

echo "<script>alert('here is $no_of_questions')</script>";
    for($i=1;$i<=$no_of_questions-1;$i++)
    {
        $answer=$_POST["answer_$i"];
        $sql="INSERT INTO answer VALUES($reg_no,$exam_id,$question_id,$i,'$answer');";
        executeQuery($sql);
    }

    $sql="INSERT INTO exam_participants VALUES($exam_id,$reg_no);";
    executeQuery($sql);
    $sql="INSERT INTO published_result VALUES($exam_id,'no');";
        //echo "<script>alert('Here is your $sql')</script>";
    executeQuery($sql);


    header('location:user_home.php');

}


?>

<!DOCTYPE html>
<html>
<head>
<title>::Examination</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="user_home.css">
<style>
body{
background-image:url("images/Exam.jpg") ;
        background-repeat: no-repeat;
background-size: 1366px 768px;
}

ul {
    list-style-type: none;
    position: -webkit-sticky; /* Safari */
    position: sticky;
    top: 0;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: DarkSlateGrey;
}
li {
    float: left;
}
li a {
    display: block;
    color: white;
    /*font-size: 25px;*/
    /*font-style: cursive;*/
    text-align: justify;
    padding:12px 16px;
    text-decoration: none;
}
li a:hover {
    background-color: black;
}

#Profile :hover #content {
display:block;
}
</style>
</head>
<body>
<ul>
  <li style="font-family: impact; font-size: 25px; border-right: 2px solid #bbb;"><a class="active" href="user_home.php">Online Examination</a></li>
     <li style="font-family: Book Antiqua; font-size:15px">
   <div id="Profile" >
<a href="profile.php"> Profile</a>
<div id = "content" style="display:none">
 <!-- <a href="#">Show Profile</a>
  <a href="#">Update Profile</a>-->
</div>
</div>
</li>
     
<li style="font-family:Book Antiqua ; font-size: 15px"><a href="examination.php">Examination</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="result.php">Result</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="https://www.quora.com/">Forum</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="about.php">About</a></li>
  <li style="float:right; font-family:Book Antiqua; font-size: 20px; border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>


<div align="center" id="pass_div">
<form id="pass_validation_form" method="POST" action="start_exam.php">
    <h3 style="color: green;">Exam Id </h3> <br>
    <input type="number" name="exam_id" value="<?php echo $exam_id ;?>" readonly><br>

<h3 style="color: green;">Please enter <b>Exam Password</b> to continue </h3> <br>
<input type="password" name="exam_pass" > <br>
<input type="submit" name="pass_val" value="Join">
</form>
</div>



<div align="center" id="exam_div" style="color:green;display: none">

<h3 style="color: green">Examination starts </h3>

<?php
$result=executeQuery("SELECT * FROM exam where exam_id=$exam_id");

if($row=$result->fetch_assoc())
{
$question_id=$row["question_id"];
}
else 
{
    echo "<script> alert('Question Id not found'); </script>";
}
?>


<form name="take_exam" method="POST" action="start_exam.php">
    <h3>Exam Id: </h3>
    <input type="number" name="exam_id" value="<?php echo $exam_id ?>" readonly> <br>
    <h3>question Id: </h3>
    <input type="number" name="question_id" value="<?php echo $question_id ?>" readonly> <br>
    
    <?php
    $result=executeQuery("SELECT * FROM questions where question_id=$question_id");
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {?>
    <h4>Question no: <?php echo $row["question_no"]?></h4><h4>Total marks: <?php echo $row["total_marks"]?></h4><br><br>
    <h4>Question:  <?php echo $row["question"]?></h4><br><br>
    <textarea name="answer_<?php echo $row["question_no"]?>" rows="5" cols="65" placeholder="write your answer here"></textarea>
    <br><br>




<?php }}
    else {
        echo "<script> alert('No question found'); </script>";
    }
    ?>



<input type="submit" name="done_exam" value="Submit Answer">
</form>
</div>


<script type="text/javascript">
    <?php if($start_exam==true) {?>
        document.getElementById("pass_div").style.display="none";
        document.getElementById("exam_div").style.display="block";
    <?php } else {?>


        <?php } ?>

</script>

</body>
</html>