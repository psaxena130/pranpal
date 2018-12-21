<?php
session_start();
$conn=new mysqli("localhost","root","","pranpal");
$id=$_POST['h'];
$pass=$_POST['t'];
$sql="SELECT * FROM account WHERE id=\"$id\" AND pass=\"$pass\"";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	$_SESSION['id']=$id;
	$_SESSION['pass']=$pass;
	if($_POST['h1']=="1")
	{
		setcookie("id","$id",time()+86400*365,"/","",0);
		setcookie("pass","$pass",time()+86400*365,"/","",0);
	}
	$conn=new mysqli("localhost","root","","pranpal");
	$sql1="SELECT * FROM online WHERE id=\"$id\"";
	$r1=$conn->query($sql1);
	if($r1->num_rows>0){
		header("location:home.php");
	}
	else
	{
	$sql="INSERT INTO online VALUES(\"$id\")";
	if($conn->query($sql))
	{header("location:home.php");}
	else
	{
		echo($conn->error);
	}
}
	
}
else
{
	$_SESSION['wrong']=1;
	header("location:login.php");
}
?>