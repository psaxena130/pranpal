<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i'])||!isset($_POST['post'])||!isset($_POST['option']))
	header("location:home.php");
$id=$_SESSION['id'];
$post=$_POST['post'];
$option=$_POST['option'];
$conn=new mysqli("localhost","root","","$id");
$sql="UPDATE posts SET whocansee=\"$option\" WHERE post_id=\"$post\"";
if(!$conn->query($sql))
	echo($conn->error);
?>