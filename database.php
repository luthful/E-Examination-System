<?php
include 'db_setting.php';

function executeQuery($sql)
{
	
	global $conn;
    //echo "<script>alert('$sql')</script>";
	$result=$conn->query($sql);
	if(!$result)
	{

		echo "Sorry error again";
		echo $sql;
		$_GLOBAL['message']="Error executing query";
	}
	else
	{
	   return $result;
    }
}
function closeDB()
{
	global $conn;
	$conn->close();
}

?>