<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
if(!isset($_POST['t']))
{
	header("home.php");
}
$x=$_POST['id'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT * FROM about WHERE name LIKE \"$x%\"";
if(!$conn->query($sql))
{
	die($conn->error);
}
$r=$conn->query($sql);
if($r->num_rows==0)
{
	echo("<a style=\"text-decoration:none;display:block;\">No match found!</a>");
}
else
{
	while($r1=$r->fetch_assoc())
	{
		if($r1['id']!=$_SESSION['id'])
		{$z=$r1['id'];echo("<a href=\"profile.php?id=$z\" style=\"text-decoration:none;display:block;\">".$r1['name']."</a>");}
	}
}
?>