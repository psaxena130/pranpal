<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i']))
	header("location:home.php");
$id=$_SESSION['id'];
$conn=new mysqli("localhost","root","","$id");
$sql="SELECT * FROM media";
$r=$conn->query($sql);
if($r->num_rows>0){
	echo("Just click on the image you want to use...<br>");
while($r1=$r->fetch_assoc())
{
	$med=$r1['med'];
	$type=$r1['type'];
	$med="uploads/".$med.".".$type;
		echo("<img src=\""."uploads/".$r1['med'].".".$r1['type']."\" onclick=\"uploadimg2('$med')\">");
}}
?>