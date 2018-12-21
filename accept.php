<?php
session_start();
if(!isset($_SESSION['id']))
{header("location:login.php");}
if(!isset($_POST['id']))
{header("location:home.php");}
$x=$_POST['id'];
$y=$_SESSION['id'];
$conn=new mysqli("localhost","root","","$x");
$sql="INSERT INTO pals(friend_id) VALUES(\"$y\")";
$conn1=new mysqli("localhost","root","","$y");
$sql1="INSERT INTO pals(friend_id) VALUES(\"$x\")";
$sql01="DELETE FROM notification WHERE type=0 AND who=\"$x\"";
$sql001="INSERT INTO notification VALUES(2,\"$y\")";
$sql111="DELETE FROM request WHERE id=\"$x\"";
if($conn->query($sql))
{
	if($conn1->query($sql1))
	{
		if($conn1->query($sql01))
		{
			if($conn->query($sql001))
			{
				if($conn1->query($sql111))
				{
					$sql2="CREATE TABLE $x(
					f VARCHAR(100),
					t VARCHAR(100),
					msg VARCHAR(300)
				);";
					echo(1);
					$conn1->query($sql2);
				}
				else
				{
					echo($conn1->error."00");
				}
			}
			else
				{echo($conn->error."01");}
		}
		else
			{echo($conn1->error."1");}

	}
	else
	{
		echo($conn1->error."2");
	}
}
else
{
	echo($conn->error."3");
}
?>