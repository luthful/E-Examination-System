<?php
session_start();
include_once 'database.php';
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


<div align="center">

<?php

$result=executeQuery("SELECT * FROM exam");
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
        $exam_id=$row["exam_id"];

        ?>

<h3 style="color:green;">Exam Id: <br> <?php echo $row["exam_id"] ?> </h3>

<h3 style="color:green;">Exam title:<br> <?php echo $row["exam_title"] ?> </h3> 
<a href="start_exam.php?exam_id=<?php echo $exam_id ;?>">Join</a>    

<?php }}?>


</div>

</body>
</html>