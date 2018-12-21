<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
$id=$_SESSION['id'];
$ph=$_POST['ph'];
$rel=$_POST['rel'];
if(strlen($ph)!=10&&strlen($ph)!=0)
{
	setcookie("ph","1",time()+3600,"/","",0);
	header("location:about.php");
	die();
}
if($ph==""||$ph==" ")
	$ph=NULL;
if($rel=="Single")
	$rel=0;
else
	$rel=1;
$conn=new mysqli("localhost","root","","pranpal");
$sql="UPDATE about
SET relationship=\"$rel\", phone=$ph
WHERE id=\"$id\"
";
$conn->query($sql);
header("location:home.php");
?>