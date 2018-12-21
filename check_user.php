<?php
session_start();
$conn=new mysqli("localhost","root","","pranpal");
$id=$_POST['id'];
$sql="SELECT * FROM account WHERE id=\"$id\"";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	echo(1);
}
else
{
	echo(0);
}
?>