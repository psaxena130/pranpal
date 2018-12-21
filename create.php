<?php
session_start();
if(!isset($_POST['id'])&&!isset($_POST['n'])&&!isset($_POST['p1'])&&!isset($_POST['r'])&&!isset($_POST['c']))
{
	header("location:login.php");
}
$id=$_POST['t'];
$name=$_POST['n'];
$pass=$_POST['p1'];
$sex=$_POST['r'];
$dob=$_POST['c'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="INSERT INTO account VALUES(\"$id\",\"$pass\")";
$conn->query($sql);
$sql="INSERT INTO about(id,name,sex,dob) VALUES(\"$id\",\"$name\",\"$sex\",\"$dob\")";
$conn->query($sql);
$conn=new mysqli("localhost","root","");
$sql="CREATE DATABASE $id";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$conn=new mysqli("localhost","root","","$id");
$sql="
CREATE TABLE pals
 ( `friend_id` VARCHAR(100) NOT NULL PRIMARY KEY, `online` BOOLEAN NOT NULL DEFAULT FALSE , `chat` TEXT NULL , `block` BOOLEAN NOT NULL DEFAULT FALSE , `ff` BOOLEAN NOT NULL DEFAULT TRUE ) ENGINE = InnoDB;
";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$sql="
CREATE TABLE posts(
	post_id BIGINT PRIMARY KEY,
	likes BIGINT NULL,
	dislike BIGINT NULL,
	comment text NULL,
	whocansee INT,
	whocaninteract int
)
";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$sql="
CREATE TABLE palpost(
	friend_id VARCHAR(100) NOT NULL,
	post_id BIGINT PRIMARY KEY,
	rank INTEGER
);
";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$sql="
CREATE TABLE request(
	id VARCHAR(100) PRIMARY KEY
)
";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$sql="
CREATE TABLE notification(
	type INTEGER(11) NOT NULL,
	who VARCHAR(100)
)
";
if(!$conn->query($sql))
{
	echo($conn->error);
}
$conn=new mysqli("localhost","root","","pranpal");
$sql="INSERT INTO online VALUES (\"$id\")";
$conn->query($sql);


$conn1=new mysqli("localhost","root","","$id");
	$sql1="CREATE TABLE media(
		med BIGINT(20),
		type TEXT
	);";
	$conn1->query($sql1);

$sql1="CREATE TABLE liked(
		post_id BIGINT(20),
		who VARCHAR(100)
	);";
	$conn1->query($sql1);


$_SESSION['id']=$id;
$_SESSION['pass']=$pass;
header("location:home.php");
//header("location:customize.php");
?>