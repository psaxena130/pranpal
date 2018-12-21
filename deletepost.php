<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i'])||!isset($_POST['post']))
	header("location:home.php");
$id=$_SESSION['id'];
$post=$_POST['post'];
$conn=new mysqli("localhost","root","","$id");
$sql="DELETE FROM posts WHERE post_id=\"$post\"";
if(!$conn->query($sql))
	echo($conn->error);
else
	echo("1");
$conn=new mysqli("localhost","root","");
$sql="DROP DATABASE $post";
if(!$conn->query($sql))
	echo($conn->error);
else
	echo("2");
?>