<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$_SESSION['sc']=1;
?>
<html>
<head>
<title><?php
echo($name);
?></title>
<style>
	input[type=text],input[type=password],select{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
.img{
	max-width: 250px;
}
</style>
<script>
function A()
{
	document.f.pass1.type="password";
}
function B()
{
	if(toString(document.f.name.value).length>100)
	{
		alert("Name's lenght should be less than or equal to 100");
		return;
	}
	if(document.f.pass.value!=document.f.pass1.value)
	{
		alert("Passwords does'nt match");
		document.f.pass.value="";
		document.f.pass1.value="";
		return;
	}
	var x=0;
		var i;
		var j;
		var s=document.f.pass.value;
		if(s.lenght<8)
			{x=0;}
		else
		{
			for(i=0;i<s.length;i++)
			{
				j=s.charAt(i);
				if(j=="!"||j=="@"||j=="#"||j=="$"||j=="%"||j=="^"||j=="&"||j=="*"||j=="("||j==")"||j=="|"||j=="\\"||j=="/"||j==".")
					{x=1;break;}
			}
		}

		if(x==0&&s.length!=0)
		{
			alert("Password not safe! Password lenght should be at least 8 and should have at least one special character");
			document.f.pass.value="";
			document.f.pass1.value="";
			return;
		}
		document.f.submit();
}
</script>
</head>
<body>
<center><a href="home.php"><img src="logo.png"></a>
<br>
<div style="display:inline-block;background-color:#F7F7F7;border-radius:5px;padding:12px 20px;">
<form method="post" action="setting_changes.php" name="f"><table><tr><td>Name </td><td>
<input type="text" name="name" value="<?php
echo($name);
?>" autocomplete="off"></td></tr>
<tr><td>
Password </td><td><input type="password" name="pass" onfocusout="A()"></td></tr>
<tr><td></td><td><input type="hidden" placeholder="Password again" name="pass1"></td></tr>
<?php
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT * FROM account WHERE id=\"$id\"";
$r=$conn->query($sql);
while($r1=$r->fetch_assoc())
{
	$whocansee=$r1['whocansee'];
}
?>
<tr><td>Who can see my posts</td><td><select name="who">
<option value="1" <?php
	if($whocansee==1)
		echo("selected");
?>>All</option>
<option value="2" <?php
	if($whocansee==2)
		echo("selected");
?>>My Friends only</option>
<option value="3"<?php
	if($whocansee==3)
		echo("selected");
?>>Nobody</option>
</select></td></tr>
<tr>
	<td>Profile photo</td><td>
		<?php
			$conn=new mysqli("localhost","root","","pranpal");
			$sql="SELECT photo FROM about WHERE id=\"$id\"";
			$r=$conn->query($sql);
			while($r1=$r->fetch_assoc()){
				if($r1['photo']!=NULL)
				{
					$photo="uploads/".$r1['photo'];
					echo("<img src=\"$photo\" class=\"img\"><br><div style=\"background-color:#00f90c;color:white;border:none;padding:12px 20px;display:inline-block;cursor:pointer\" id=\"b\" onchange=\"changeimg()\"><center>Change profile picture</center></div>");
				}
				else
				{
					echo("No profile picture<br><div style=\"background-color:#00f90c;color:white;border:none;padding:12px 20px;display:inline-block;cursor:pointer\" id=\"b\" onchange=\"changeimg()\"><center>Choose profile picture</center></div>");
				}
			}
		?>

	</td>
</tr>
</table>
<input type="button" value="Change settings"  style="background-color:#8ABBF6;color:white;border:none;width:100%;padding:12px 20px;" onclick="B()">
</div>