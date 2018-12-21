<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
$id=$_SESSION['id'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="DELETE FROM online WHERE id=\"$id\"";
if($conn->query($sql))
{
	session_destroy();
	header("location:login.php");
}
else
{
	echo($conn->error);
}
?>