<?php
session_start();
include_once '../database.php';
$viva_id=0;
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
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
     <a href="delete_questions_viva.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Delete Questions</a>
     </div>
    </div>
    <a href="logout.php" >Logout</a> 
</div>
<div id="make_div" align="center" style="color: white;">
    <h3>Currently Runnning Viva</h3>

    <?php 
    $sql="SELECT * FROM viva_take WHERE viva_status=1;";
    $result=executeQuery($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {?>

    <h4 style="word-spacing: 2px">Viva ID: <?php echo $row["viva_id"];echo" "; ?> </h4>

    <h4 style="word-spacing: 2px">Reg. no: <?php echo $row["reg_no"];echo" "; ?> </h4>
    
    <!-- <?php $exam_id=$row["exam_id"]; ?> -->
    
    <a href="viva_face.php?viva_id=<?php echo $row["viva_id"] ?>" style="font-size:13pt;word-spacing: 1px" >Publish Question</a>
    <a href="viva_rate.php?viva_id=<?php echo $row["viva_id"] ?>" style="font-size:13pt;word-spacing: 1px">Rate Question</a>

<?php   }} 
else {
$view_participants=true;
}
 ?>

</div>
  

</body>
</html>