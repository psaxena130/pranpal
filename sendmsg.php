<?php
session_start();
if(!isset($_SESSION['id']))
{header("location:login.php");}
if(!isset($_POST['i'])||!isset($_POST['pal1'])||!isset($_POST['msg1']))
{header("location:home.php");}
$id=$_SESSION['id'];
$pal=$_POST['pal1'];
$msg=$_POST['msg1'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="INSERT INTO chat VALUES(\"$id\",\"$pal\",\"$msg\",\"$id\")";
if($conn->query($sql))
	{echo("<p style=\"position:relative;width:50%;left:45%;color:white;background-color:#8ABBF6;padding:5px;border-radius: 4px;z-index:-1\">$msg</p>");
	$conn1=new mysqli("localhost","root","","$id");
	$sql1="INSERT INTO $pal VALUES(\"$id\",\"$pal\",\"$msg\")";
	$conn1->query($sql1);
}
else
	echo($conn->error);
?>