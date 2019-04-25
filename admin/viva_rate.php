<?php
session_start();
include_once '../database.php';
$viva_id=0;

if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(isset($_GET["viva_id"]))
{
    $viva_id=$_GET["viva_id"];
}

if(isset($_POST["remark_button"]))
{
	$viva_id=test_input($_POST["viva_id"]);
	$total=test_input($_POST["total"]);

	for($i=1;$i<=$total;$i++)
	{
		$question_id=$i;
		$mark=$_POST["$i"];
		$sql="UPDATE viva_details SET viva_rating=$mark where viva_id=$viva_id and question_id=$question_id;";
		executeQuery($sql);
	}
  $sql="UPDATE viva_take SET viva_status=0 where viva_id=$viva_id;";
    executeQuery($sql);
	header('location:viva_current.php');
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
     <a href="delete_questions_viva.php" style="font-size:13pt;color:#53238c;word-spacing: 2px">Delete Questions</a> 
     </div>
    </div>


    <a href="logout.php" >Logout</a>

</div>

</div>



    <div id="make_div" align="center" style="color: white;">

<form method="POST" action="viva_rate.php">

    <h3> Viva ID </h3>
    <input type="number" name="viva_id" value=$viva_id read only>
    <?php
    $sql="SELECT * FROM viva_details NATURAL JOIN viva_ques where viva_id=$viva_id";
    $result=executeQuery($sql);
    
    $total=$result->num_rows;
    
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {?>

    <h4>Question ID: <?php echo $row["question_id"];echo"<br><br>"; ?> </h4>
    <h4>Question   : <?php echo $row["question"];echo"<br><br>"; ?> </h4>
    <h4>Answer   : <?php echo $row["answer"];echo"<br><br>"; ?> </h4>
    <input type="number" name="<?php echo $row["question_id"] ?>" step="0.25" min="0" max="4" placeholder="Rate">


<?php   }}  ?>

<br>
<input type="submit" name="remark_button"  value="Done">
<input type="hidden" name="total" value="<?php echo $total ?>">

</form>
  
</div>
  

</body>
</html>