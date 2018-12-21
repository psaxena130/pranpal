<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
if(!isset($_POST['id']))
{
	header("location:home.php");
}
$id=$_SESSION['id'];
$x=$_POST['id'];
$conn=new mysqli("localhost","root","","$id");
$sql="DELETE FROM notification WHERE type=0  AND who=\"$x\"";
$sql0="DELETE FROM request WHERE id=\"$x\"";
$conn1=new mysqli("localhost","root","","$x");
$sql1="INSERT INTO notification VALUES(6,\"$id\")";
if($conn->query($sql))
{
	if($conn1->query($sql1))
	{
		if($conn->query($sql0))
		{
			echo(1);
		}
		else
		{
			echo($conn->error."0");
		}
	}
	else
	{
		echo($conn1->error."1");
	}
}
else
{
	echo($conn->error."2");
}
?>