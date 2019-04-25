<?php
session_start();
include_once '../database.php';
$view_participants=false;
$exam_id=0;

if(!isset($_SESSION['password']))
{
    echo "<script>alert('Session timeout ReLogin')</script>";
    header('location:index.php');
}

if(isset($_GET["exam_id"]))
{
	$exam_id=$_GET["exam_id"];
	$view_participants=true;
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

<div id="make_div" align="center" style="color: white;">
	<h3>Result to be made</h3>

	<?php 
	$sql="SELECT * FROM published_result natural join exam WHERE is_published='no';";
	$result=executeQuery($sql);
	if($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{?>

	<h4>Exam Id: <?php echo $row["exam_id"];echo" "; echo $row["exam_title"] ?> </h4>

	<?php $exam_id=$row["exam_id"];	?>
	
	<a href="make_result.php?exam_id=<?php echo $exam_id ?>">Make Result</a>

<?php	}} 
else {
$view_participants=true;
}
 ?>

</div>
<div id="view_div" align="center" style="color:white;display: none;">
<?php
$sql="SELECT reg_no FROM exam_participants where exam_id=$exam_id and reg_no NOT IN (SELECT reg_no FROM reg_complete WHERE exam_id=$exam_id)";
$result= executeQuery($sql);
if($result->num_rows>0)
{
	while ($row=$result->fetch_assoc()) { ?>
     
    <h3> <?php echo $row["reg_no"] ; echo "    ";?> </h3> <a href="view_paper.php?reg_no= <?php echo $row["reg_no"]; ?>&exam_id=<?php echo $exam_id; ?>">View Paper</a>


<?php }}
else
{
	// finally preparing result after viewing all paper
	$reg_array=array();
	$sql_array=array();

	$sql="UPDATE published_result SET is_published='yes' WHERE exam_id=$exam_id;";
	executeQuery($sql);


	

	$sql="SELECT * FROM marks natural join exam_participants WHERE exam_id=$exam_id";
	$result=executeQuery($sql);
	if($result->num_rows>0){
        $prev_regi=0;
    	while ($row=$result->fetch_assoc()) {
    		$regi_no=$row["reg_no"];
            if($regi_no!=$prev_regi){
    		array_push($reg_array,$regi_no);
            $prev_regi=$regi_no;

            }
    	}
    }


    $marks_obtained=0;

    $result=executeQuery($sql);
	if($result->num_rows>0){
		for($i=0;$i<count($reg_array);$i++)
    	{
    	while ($row=$result->fetch_assoc()) {
    	    		$regi_no=$row["reg_no"];
    	    		if($regi_no==$reg_array[$i]){
    	    			$marks_obtained+=$row["marks_obtained"];
    	    	}
    	  }

    	  $sql_final="INSERT INTO result VALUES($exam_id,$reg_array[$i],$marks_obtained);";
    	  array_push($sql_array,$sql_final);

    	}
    }

    for($j=0;$j<count($sql_array);$j++){
    	$sql_final=$sql_array[$j];
    	executeQuery($sql_final);
    }



	

}

?>


</div>

<script type="text/javascript">
	//alert('Hi entered here');
	<?php
	if($view_participants==true)
	{?>
		document.getElementById("view_div").style.display="block";
		document.getElementById("make_div").style.display="none";
	<?php } ?>
</script>

</body>
</html>