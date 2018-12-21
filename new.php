<?php
session_start();
if(isset($_SESSION['id']))
{
	header("location:login.php");
}
?>
<!DOCTYPEhtml>
<head>
<title>Welcome...</title>
<script src="jquery.js"></script>
<script src="new.js"></script>
<style>
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
<a href="login.php">
<img src="logo.png"></a>
<br>
<div style="display:inline-block;background-color:#F7F7F7;border-radius:5px;padding:12px 20px;">
<form name="f" method="post" action="create.php">
<input type="text" id="id" value="Username" name="t" onclick="A()" required><p id="possible"></p>
<input type="text" name="n" value="Name" onclick="B()" required>
<div style="right:0px;postion:relative">
<tt>When Earth was gifted by you:</tt><input type="date" name="c" max="<?php
	echo((date("Y")-18)."-01-01");
?>"></div>
<input type="text" name="p1" value="Password" id="p1" onchange="C()" onclick="D()">
<input type="text" name="p2" value="Password again" onclick="E()">
<div style="right:0px;position:relative">
<input type="radio" name="r" value="Male">Male	<input type="radio" name="r" value="Female" checked="true">Female</div>
<input type="button" value="Create account" name="btn" style="background-color:#8ABBF6;color:white;border:none;width:100%;padding:12px 20px;" onclick="F()">
</div>
</form>