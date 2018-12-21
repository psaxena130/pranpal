<?php
session_start();
if(!isset($_SESSION['id'])||!isset($_SESSION['profile'])||!isset($_POST['end']))
{
	if(!isset($_SESSION['id']))
	{
		header("location:login.php");
	}
	else
	{
		header("location:home.php");
	}
}
$x=$_SESSION['profile'];
$y=$_SESSION['id'];
$conn=new mysqli("localhost","root","","$x");
$sql="INSERT INTO request VALUES(\"$y\")";
$conn1=new mysqli("localhost","root","","$x");
$sql1="INSERT INTO notification VALUES(0,\"$y\")";
if($conn->query($sql)&&$conn1->query($sql1))
{
	echo("y");
}
else
{
	echo("n");
}