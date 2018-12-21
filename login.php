<?php
session_start();
$x=0;
if(isset($_SESSION['wrong']))
{
	if($_SESSION['wrong']==1){
	echo("
			<script>
			alert(\"Password wrong!\");
			</script>
		");
	$_SESSION['wrong']=0;
	session_destroy();
	session_start();
	}
}
?>
<?php
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
	$id=$_SESSION['id'];
	$pass=$_SESSION['pass'];
	$x=1;
}
else
{
	if(isset($_COOKIE['id'])&&isset($_COOKIE['pass']))
	{
		$id=$_COOKIE['id'];
		$pass=$_COOKIE['pass'];
		$x=1;
	}
}
?>
<html>
<head>
<title>Welcome to PranPal</title>
<script src="jquery.js"></script>
<script type="text/javascript">
	var x=0,y=0,z=0;
	function A()
	{
		if(x==0)
		{
			document.f.t.value="";
			<?php
				if($x==1)
				{
					echo("document.f.t.value=\"$id\";");
				}
			?>
			x=1;
			document.f.btn.type="button";
		}
		if(y==1)
		{
			document.f.t.value="";
			document.f.t.type="password";
			<?php
				if($x==1)
				{
					echo("document.f.t.value=\"$pass\";");
				}
			?>
			document.f.btn.type="submit";
			document.f.b.type="button";
		}
	}
	function B()
	{
		if(document.f.t.value!=""&&document.f.t.value!="Username"&&y==0)
		{
			document.f.h.value=document.f.t.value;
			document.f.t.value="Password";
			document.f.btn.type="hidden";
			//document.f.t.onclick="C()";
			y=1;
		}
		else
		{
			if(y==0){
			alert("Username not given");}
		}
	}
	function C()
	{
		if(z==0)
		{
			document.f.h1.value="1";
			z=1;
			document.f.b.style=style="background-color:#f90000;color:white;border:none;width:100%;padding:12px 20px;";
			document.f.b.value="Don't remember me!";
		}
		else
		{
			document.f.h1.value="0";
			<?php
				if(isset($_COOKIE['id']))
				{
					setcookie('id',"",time()-10,"/","",0);
					setcookie('pass',"",time()-10,"/","",0);
				}			
			?>
			z=0;
			document.f.b.style="background-color:#00f90c;color:white;border:none;width:100%;padding:12px 20px;";
			document.f.b.value="Keep me signed in!";
		}
	}
	function D()
	{
		window.location="new.php";
	}
	function E()
	{
		var ahr=document.getElementById("ahr");
		ahr.style="cursor:pointer;text-decoration:underline;";
	}
	function F()
	{
		var ahr=document.getElementById("ahr");
		ahr.style="";
	}
</script>
<style type="text/css">
	input[type=text],input[type=password]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
</style>
</head>
<body>
<center>
<br>
<br>
<img src="logo.png">
<br>
<div style="display:inline-block;background-color:#F7F7F7;border-radius:5px;padding:12px 20px;">
<br>
<form name="f" method="post" action="check.php">
<input type="text" autocomplete="off" name="t" value="Username" onclick="A()" id="user"><br>
<input type="hidden" style="background-color:#8ABBF6;color:white;border:none;width:100%;padding:12px 20px;" value="Next" name="btn" onclick="B()"><br>
<input type="hidden" style="background-color:#00f90c;color:white;border:none;width:100%;padding:12px 20px;" value="Keep me signed in!" name="b" onclick="C()">
</div><br>
<font color="#8ABBF6">
<i id="ahr" onclick="D()" onmouseover="E()" onmouseout="F()">Create account</i></font>
<input type="hidden" name="h">
<input type="hidden" name="h1" value="0">