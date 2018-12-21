<?php
session_start();
if(!isset($_SESSION['id']))
{header("location:login.php");}
if(!isset($_POST['i'])||!isset($_POST['pal2']))
{die($_POST['i']." ".$_POST['pal2']);}
$id=$_SESSION['id'];
$pal=$_POST['pal2'];
$conn=new mysqli("localhost","root","","$id");
$sql="SELECT * FROM $pal";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	while($r1=$r->fetch_assoc())
	{
		
		//
		$msg=$r1['msg'];
		if($r1['f']==$id)
		{
			echo("<p style=\"position:relative;left:45%;color:white;width:50%;background-color:#8ABBF6;padding:5px;border-radius: 4px;z-index:-1\">$msg</p>");
		}
		else
		{
			echo("<p style=\"position:relative;left:0;width:50%;color:white;background-color:#8ABBF6;padding:5px;border-radius: 4px;z-index:-1\">$msg</p>");
		}
		//
	}
}
else
{echo("No message");
}?>