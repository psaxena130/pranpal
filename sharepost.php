<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i'])||!isset($_POST['post']))
	header("location:home.php");
$id=$_SESSION['id'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT * FROM post";
$r=$conn->query($sql);
while($r1=$r->fetch_assoc())
{
	$pid=$r1['post_id'];
}
$pid++;
$optionsee=$_POST['optionsee'];
$optioninteract=$_POST['optioninteract'];
$sql="DELETE FROM post";
if(!$conn->query($sql))
	echo($conn->error."2<br>");
$sql="INSERT INTO post VALUES($pid)";
if(!$conn->query($sql))
	echo($conn->error."1<br>");
/*$sql="SELECT * FROM post";
$r=$conn->query($sql);
while($r1=$r->fetch_assoc())
{
	$pid=$r1['post_id'];
}*/
$pid=$pid."p";
/**/
if($optionsee==2)
	$optioninteract=2;
$conn=new mysqli("localhost","root","");
$sql="CREATE DATABASE $pid";
if(!$conn->query($sql))
	echo($conn->error."3<br>");
$conn=new mysqli("localhost","root","","$id");
$sql="INSERT INTO posts VALUES(\"$pid\",\"\",\"\",\"\",\"$optionsee\",\"$optioninteract\")";
if(!$conn->query($sql))
	echo($conn->error."4<br>");
$conn=new mysqli("localhost","root","","$pid");
$sql="CREATE TABLE post(
	post VARCHAR(10000)
);";
if(!$conn->query($sql))
	echo($conn->error."5<br>");
$sql="CREATE TABLE likes(
	id VARCHAR(100)
);";
if(!$conn->query($sql))
	echo($conn->error."6<br>");
$sql="CREATE TABLE dislikes(
	id VARCHAR(100)
);";
if(!$conn->query($sql))
	echo($conn->error."7<br>");
$sql="CREATE TABLE comments(
	comment VARCHAR(100),
	id VARCHAR(100),
	cid BIGINT(20)
);";
if(!$conn->query($sql))
	echo($conn->error."8<br>");
$sql="CREATE TABLE comment_creator(
	cid BIGINT(20) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(cid)
);";
if(!$conn->query($sql))
	echo($conn->error."9<br>");
$post=$_POST['post'];
$sql="INSERT INTO post VALUES('$post')";
if(!$conn->query($sql))
	echo($conn->error."10<br>");
?>