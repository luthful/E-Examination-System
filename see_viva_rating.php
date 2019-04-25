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
   echo "<script>alert ('successful')</script>";
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
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="join_viva.php">Join Viva</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="viva_current.php">Currently Running Viva</a></li>
  <li style="font-family:Book Antiqua ; font-size: 15px"><a href="see_viva_rating.php">See Viva Rating</a></li>
  <li style="float:right; font-family:Book Antiqua; font-size: 20px; border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>



<div id="make_div" align="center" style="color: white;">
    <h3 style="color: green">Previously Taken Viva</h3>

    <?php 
    $sql="SELECT * FROM viva_take NATURAL JOIN viva_details NATURAL JOIN viva_ques WHERE viva_status=0;";
    $result=executeQuery($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {?>
   
    <h4 style="color: green">Viva ID: <?php echo $row["viva_id"];echo"  "; ?> </h4>
    <h4 style="color: green">Reg. no: <?php echo $row["reg_no"];echo"  "; ?> </h4>
    <h4 style="color: green">Question ID: <?php echo $row["question_id"];echo"<br><br>"; ?> </h4>
    <h4 style="color: green">Question: <?php echo $row["question"];echo"<br><br>"; ?> </h4>
    <h4 style="color: green">Answer: <?php echo $row["answer"];echo"<br><br>"; ?> </h4>
    <h4 style="color: green">Rating: <?php echo $row["viva_rating"]; echo"<br><br>"; ?> </h4>



<?php   }} 
 ?>

</div>

</body>
</html>