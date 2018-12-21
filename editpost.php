<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i'])||!isset($_POST['pid']))
	header("location:home.php");
$id=$_SESSION['id'];
$pid=$_POST['pid'];
$post=$_POST['post'];
$conn=new mysqli("localhost","root","","$pid");
$sql="DELETE FROM post;";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$sql="INSERT INTO post VALUES('$post')";
if(!$conn->query($sql))
{
	echo($conn->error);
}
?>