<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
$id=$_SESSION['id'];
if(!isset($_SESSION['sc']))
{
	header("location:home.php");
}
else
{
	if($_SESSION['sc']==0)
	{
		header("location:home.php");
	}
}
$_SESSION['sc']=0;
$name=$_POST['name'];
$pass=$_POST['pass'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="UPDATE about SET name=\"$name\" WHERE id=\"$id\"";
$conn->query($sql);
$_SESSION['name']=$name;
if(strlen($pass)!=0)
{
	$sql="UPDATE account SET pass=\"$pass\" WHERE id=\"$id\"";
	$conn->query($sql);
	$_SESSION['pass']=$pass;
	if(isset($_COOKIE['pass']))
	{
		setcookie("pass","$pass",time()+86400*365,"/","",0);
	}
}
$whocansee=$_POST['who'];
$sql="UPDATE account SET whocansee=\"$whocansee\" WHERE id=\"$id\"";
$conn->query($sql);
header("location:home.php");
?>