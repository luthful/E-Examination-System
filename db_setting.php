<?php
$servername="localhost";
$username="root";
$password="";
$dbname="our_project";

global $conn;
$conn=new mysqli($servername,$username,$password);

if($conn->connect_error)
{
	$_GLOBAL['message']="successful connection";
}
else
{
	$_GLOBAL['message']="Connection failed". $conn->connect_error;
}
$sql="CREATE DATABASE IF NOT EXISTS our_project";
$conn->query($sql);
$conn->select_db($dbname);



?>