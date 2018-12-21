<?php
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
if(!isset($_POST['type'])||!isset($_POST['to']))
{
	header("location:home.php");
}
$x=$_POST['to'];
$y=$_POST['type']
$z=$_SESSION['id'];
$conn=new mysqli("localhost","root","","$x");
$sql="
INSERT INTO notification VALUES($y,\"$z\");
";
if(!$conn->query($sql))
{
	echo($conn->error);
}
?>