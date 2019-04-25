<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="our_project";

$conn=new mysqli($servername,$username,$password);
if($conn->connect_error)
{
	echo "failed to connect".$conn->connect_error;
}
$sql="CREATE DATABASE IF NOT EXISTS our_project";
$conn->query($sql);
$conn->select_db($dbname);





$sql1="CREATE TABLE IF NOT EXISTS forum_question(
forum_question_id int NOT NULL AUTO_INCREMENT,
reg_no int,
forum_question TEXT,
topic varchar(20),
question_time DATE,
PRIMARY KEY (forum_question_id)
);" ;

$sql2="DROP TABLE viva_ques";

if($conn->query($sql2))
{
	echo "Successful";
}
else
{
	echo "Error";
}

$result=$conn->query("SELECT * FROM student");


if($result->num_rows>0)
{
	echo "<table>";
	while($row=$result->fetch_assoc())
	{
           echo "<tr><td>". $row["reg_no"]."</td><td>".$row["fullname"]."</td></tr>";
	}
	echo "</table>";
}
else
{
	echo "No result found";
}

$conn->close();

?>
</body>
</html>