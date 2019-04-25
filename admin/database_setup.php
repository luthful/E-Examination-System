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

$sql1="CREATE TABLE IF NOT EXISTS student(
fullname varchar(80),
reg_no int,
password varchar(80),
email varchar(80),
department varchar(80),
semester varchar(80),
session varchar(80)
);" ;
$sql2="CREATE TABLE IF NOT EXISTS admin_login(
username varchar(80),
password varchar(80)
);";

$sql3="INSERT INTO admin_login VALUES('admin','admin');";
$sql4="CREATE TABLE IF NOT EXISTS question_title(
question_id int NOT NULL AUTO_INCREMENT,
question_title TEXT,
PRIMARY KEY (question_id)
);" ;
$sql5="CREATE TABLE IF NOT EXISTS questions(
question_id int,
question_no int,
total_marks int,
question TEXT
);" ;
$sql6="CREATE TABLE IF NOT EXISTS exam(
exam_id int NOT NULL AUTO_INCREMENT,
question_id int,
exam_title TEXT,
exam_password varchar(80),
PRIMARY KEY (exam_id)
);" ;
$sql7="CREATE TABLE IF NOT EXISTS exam_participants(
exam_id int,
reg_no int
);" ;
/*$sql8="CREATE TABLE IF NOT EXISTS taken_exam(
exam_id int,
exam_date varchar(20),
start_time varchar(20),
end_time varchar(20)
);" ;*/
$sql9="CREATE TABLE IF NOT EXISTS marks(
reg_no int,
exam_id int,
question_id int,
question_no int,
marks_obtained float
);" ;
$sql10="CREATE TABLE IF NOT EXISTS result(
exam_id int,
reg_no int,
marks float
);" ;
$sql11="CREATE TABLE IF NOT EXISTS published_result(
exam_id int,
is_published varchar(20)
);" ;
$sql12="CREATE TABLE IF NOT EXISTS answer(
reg_no int,
exam_id int,
question_id int,
question_no int,
answer TEXT
);";

$sql13="CREATE TABLE reg_complete(
exam_id int,
reg_no int,
is_complete varchar(20)
);";

$sql14="CREATE TABLE IF NOT EXISTS viva_ques(
question_id int,
question TEXT,
PRIMARY KEY (question_id)
);";


$sql15="CREATE TABLE IF NOT EXISTS viva_take(
viva_id int,
viva_status int,
reg_no int,
viva_password int,
PRIMARY KEY (viva_id)
);";


$sql16="CREATE TABLE IF NOT EXISTS viva_details(
viva_id int,
question_id int,
answer TEXT,
viva_rating int,
PRIMARY KEY (viva_id)
);";









$conn->query($sql1);
$conn->query($sql2);
$conn->query($sql3);
$conn->query($sql4);
$conn->query($sql5);
$conn->query($sql6);
$conn->query($sql7);
//$conn->query($sql8);
$conn->query($sql9);
$conn->query($sql10);
$conn->query($sql11);
$conn->query($sql12);
$conn->query($sql13);
$conn->query($sql14);
$conn->query($sql15);
$conn->query($sql16);

$conn->close();

echo "Successfully setup database";


?>