<?php
session_start();
include_once '../database.php';
$test=0;
$viva_id=0;
$question_id=0;
$no_of_questions=0;
if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(isset($_GET["viva_id"]))
{
    $viva_id=$_GET["viva_id"];
}

if(isset($_POST['initial_done']))
{
    $viva_id=test_input($_POST["viva_id"]);
    $no_of_questions=test_input($_POST["no_of_questions"]);
    $_SESSION['question_id']=$question_id;
    $_SESSION['viva_id']=$viva_id;
    $test=1;
    closeDB();

}

if(isset($_POST["final_done"]))
{

  $viva_id=$_SESSION['viva_id'];
  $no_of_questions=$_SESSION['no_of_questions'];

    for($i=1;$i<=$no_of_questions;$i++)
{
    $question_id=test_input($_POST["question_$i"]);
    
    $sql_final="INSERT INTO viva_details VALUES($viva_id,$question_id,'',0);";
    executeQuery($sql_final);
}
     closeDB();
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
<div align="center">
</div>
<div align="center" style="color:white">
<form id="question_make1" action="viva_face.php"  method="POST">
<div id="should_hide">
<h3>Viva ID:</h3>
<input type="number" name="viva_id" value=$viva_id>
<br><br>
<h3>How many questions?</h3>
<input type="number" name="no_of_questions">
<br><br>
<input type="submit" name="initial_done" value="Ok">
</div>
</form>
</div>

<div id="next_hide" align="center" style="display: none; color:white">
<form id="question_make2" action="viva_face.php" method="POST" >

<?php
for($i=1;$i<=$no_of_questions;$i++)
{
    echo "<h3>Question no $i</h3>";
    echo '<br><br>';
    echo "Question ID: "?>
    <input type="number" name="question_<?php echo $i?>" >;
    <?php echo '<br><br>';?>
<?php } ?>


<br><br>
<input type="submit" name="final_done" value="Done">

</form>
</div>
  

</body>
</html>

<?php
if($test==1)
{
   echo "<script>document.getElementById('should_hide').style.display='none';</script>";
    echo "<script>document.getElementById('next_hide').style.display='block';</script>";
}


?>