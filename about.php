<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(isset($_COOKIE['ph']))
{
	echo("<script>alert(\"Phone number is not 10 digits\");</script>");
	setcookie("ph","",time()-1,"/","",0);
}
$id=$_SESSION['id'];
?>
<html>
<head>
<title><?php
echo($_SESSION['name']);
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
</style>

</head><body>
<center>
	<a href="home.php"><img src="logo.png"></a>
	<br>
	<div style="display:inline-block;background-color:#F7F7F7;border-radius:5px;padding:12px 20px;">
	<?php
		$conn=new mysqli("localhost","root","","pranpal");
		$sql="SELECT * FROM about WHERE id=\"$id\"";
		$info=$conn->query($sql);
		while($r=$info->fetch_assoc())
		{
			$relation=$r['relationship'];
			$ph=$r['phone'];
		}
	?>
	<form method="post" action="about_changes.php">
	<table><tr><td>
	Relationship </td><td><select name="rel">
		<?php
			if($relation==0)
			{
		?>
		<option value="Single" selected>Single</option>
		<option value="Relation">In Relationship</option>
		<?php
		}
		else
		{
		?>
		<option value="Single">Single</option>
		<option value="Relation" selected>In Relationship</option>
		<?php
		}?>
	</select></td></tr><tr><td>
	Phone: </td><td><input type="text" autocomplete="off" <?php
		if($ph==NULL)
			echo" placeholder=\"Please share your phone number\"";
		else
			echo("value=".$ph);
	?> name="ph">
	</div></td></tr></table><br>
	<input type="submit" value="Do Changes" name="btn" style="background-color:#8ABBF6;color:white;border:none;width:100%;padding:12px 20px;">
</center>
</form></div></center></body></html>