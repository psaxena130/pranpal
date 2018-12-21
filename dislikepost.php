<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i'])||!isset($_POST['post'])||!isset($_POST['id'])||!isset($_POST['to']))
	header("location:home.php");
$post=$_POST['post'];
$id=$_POST['id'];
$to=$_POST['to'];
$post1=$post."p";

$conn=new mysqli("localhost","root","","$post1");
$sql="SELECT * FROM likes WHERE id=\"$id\"";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	$sql1="DELETE FROM likes WHERE id=\"$id\"";
	$conn->query($sql1);
	$conn1=new mysqli("localhost","root","","$to");
	$sql1="DELETE FROM notification WHERE who=\"$id\" AND type=\"3\"";
	$conn1->query($sql1);
	$conn1=new mysqli("localhost","root","","$to");
	$sql1="UPDATE posts SET likes=likes-1 WHERE post_id=\"$post\"";
	$conn1->query($sql1);
	$conn1=new mysqli("localhost","root","","$id");
	$sql1="DELETE FROM liked WHERE post_id=\"$post\"";
	$conn1->query($sql1);
}

$conn=new mysqli("localhost","root","","$post1");
$sql="SELECT * FROM dislikes WHERE id=\"$id\"";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	/*$sql1="DELETE FROM dislikes WHERE id=\"$id\"";
	$conn->query($sql1);
	$conn1=new mysqli("localhost","root","","$to");
	$sql1="DELETE FROM notification WHERE who=\"$id\" AND type=\"4\"";
	$conn1->query($sql1);
	$conn1=new mysqli("localhost","root","","$to");
	$sql1="UPDATE posts SET dislike=dislike-1 WHERE post_id=\"$post\"";
	$conn1->query($sql1);*/
}
else{
$conn=new mysqli("localhost","root","","$post1");
$sql="INSERT INTO dislikes VALUES(\"$id\")";
if(!$conn->query($sql))
	echo($conn->error);
$conn=new mysqli("localhost","root","","$to");
$sql="UPDATE posts SET dislike=dislike+1 WHERE post_id=\"$post\"";
if(!$conn->query($sql))
	echo($conn->error);
$sql="INSERT INTO notification VALUES(\"4\",\"$id\")";
if(!$conn->query($sql))
	echo($conn->error);}
?>