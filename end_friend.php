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
$x=$_SESSION['id'];
$y=$_SESSION['profile'];
$conn=new mysqli("localhost","root","","$x");
$sql="DELETE FROM pals WHERE friend_id=\"$y\"";
$conn1=new mysqli("localhost","root","","$y");
$sql1="DELETE FROM pals WHERE friend_id=\"$x\"";
$sql2="INSERT INTO notification VALUES(1,\"$x\")";
if(!$conn->query($sql))
{
	echo("n");
}
else
{
	if(!$conn1->query($sql1))
	{
		$conn=new mysqli("localhost","root","","$x");
		$sql="INSERT INTO pals(friend_id) VALUES(\"$y\")";
		$conn->query($sql);
		echo("n");
	}
	else
	{
		if($conn1->query($sql2))
		{
			$sql3="DROP TABLE $y";
			$sql4="DROP TABLE $x";
			if($conn->query($sql3)&&$conn1->query($sql4))
				echo("y");
	
		}
	}
}
?>