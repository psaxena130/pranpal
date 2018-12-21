<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
if((!isset($_POST['type']))&&(!isset($_POST['who'])))
{
	header("location:home.php");
}
$id=$_SESSION['id'];
$y=$_POST['type'];
$z=$_POST['who'];
$conn=new mysqli("localhost","root","","$id");
$sql="DELETE FROM notification WHERE type=$y AND who=\"$z\"";
if($conn->query($sql))
{
	echo(1);
}
else
{
	echo($conn->error);
}
?>