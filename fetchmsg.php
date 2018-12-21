<?php
session_start();
if(!isset($_SESSION['id']))
{header("location:login.php");}
if(!isset($_POST['i'])||!isset($_POST['pal2']))
{die($_POST['i']." ".$_POST['pal2']);}
$id=$_SESSION['id'];
$pal=$_POST['pal2'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT * FROM chat WHERE ((f=\"$id\" AND t=\"$pal\")OR(f=\"$pal\" AND t=\"$id\"))";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	while($r1=$r->fetch_assoc())
	{
		
		//
		if($r1['seen']!=$id){
		$msg=$r1['msg'];
		if($r1['f']==$id)
		{
			echo("<p style=\"position:relative;left:45%;width:50%;color:white;background-color:#8ABBF6;padding:5px;border-radius: 4px;z-index:-1\">$msg</p>");
		}
		else
		{
			echo("<p style=\"position:relative;left:0;color:white;width:50%;background-color:#8ABBF6;padding:5px;border-radius: 4px;z-index:-1\">$msg</p>");
		}
		//
		$f=$r1['f'];
		$t=$r1['t'];
		$sql2="INSERT INTO $pal VALUES(\"$f\",\"$t\",\"$msg\")";
		$conn1=new mysqli("localhost","root","","$id");
		$conn1->query($sql2);
		$seen=$r1['seen'];
		if($seen=="$pal")
		{
			$sql2="DELETE FROM chat WHERE f=\"$f\" AND t=\"$t\" AND msg=\"$msg\"";
			$conn->query($sql2);
		}
	}
	}
}
else
{echo("");
}?>