<?php
session_start();
include_once 'database.php';
$reg_no;
$std_name;
$viva_id=0;
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
   echo "<script>alert ('successful')</script>";
}

if(isset($_POST["pass_val"]))
{
    $viva_id=$_POST["viva_id"];
    $password=$_POST["viva_pass"];
    $result=executeQuery("SELECT * FROM viva_take where viva_id=$viva_id and viva_password=$password");
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

    $question_array=array();
    $viva_id=$_POST["viva_id"];

    $sql="SELECT * FROM viva_details NATURAL JOIN viva_ques where viva_id=$viva_id;";
    $result=executeQuery($sql);
    $no_of_questions=$result->num_rows;


    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
           array_push($question_array,$row[question_id]);
        }
    }

    for($i=0;$i<$no_of_questions;$i++)
    {
        $question_id=$question_array[$i];
        $answer=$_POST["answer_$question_id"];
        $sql="UPDATE viva_details SET answer='$answer' where viva_id=$viva_id and question_id=$question_id ;";
        executeQuery($sql);
    }

    echo "Done Viva";
    header('location:user_home.php');

}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>::Home</title>
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
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="viva_current.php">Currently Running Viva</a></li>
  <li style="float:right; font-family:Book Antiqua; font-size: 20px; border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>



<div align="center" id="pass_div">
<form id="pass_validation_form" method="POST" action="join_viva.php">
    <h3 style="color: green;">Viva Id </h3> <br>
    <input type="number" name="viva_id"><br>

<h3 style="color: green;">Please enter <b>Viva Password</b> to continue </h3> <br>
<input type="password" name="viva_pass" > <br>
<input type="submit" name="pass_val" value="Join">
</form>
</div>



<div align="center" id="exam_div" style="color:green;display: none">

<h3 style="color: green">Viva starts </h3>




<form name="take_exam" method="POST" action="join_viva.php">
    <h3>Viva Id: </h3>
    <input type="number" name="viva_id" value="<?php echo $viva_id ?>" readonly> <br>
    

    <!--<h3>question Id: </h3>
    <input type="number" name="question_id" value="<?php echo $question_id ?>" readonly> <br>-->
    
    <?php
    $result=executeQuery("SELECT * FROM viva_details NATURAL JOIN viva_ques where viva_id=$viva_id");

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {?>
    <h4>Question ID: <?php echo $row["question_id"]?></h4><br>
    <h4>Question:  <?php echo $row["question"]?></h4><br><br>
    <textarea name="answer_<?php echo $row["question_id"]?>" rows="5" cols="65" placeholder="write your answer here"></textarea>
    <br><br>




<?php }}
    else {
        echo "<script> alert('Some errors have occured'); </script>";
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