<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
$id=$_SESSION['id'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT name FROM about WHERE id=\"$id\"";
$name=$conn->query($sql);
while($r=$name->fetch_assoc())
	{	$r1=$r['name'];
		$_SESSION['name']=$r1;
	}
?>
<html>
<head>
	<title><?php
	echo($_SESSION['name']);
	?></title>
	<script src="jquery.js"></script>
	<script src="my_posts.js"></script>
	<script type="text/javascript" src="home.js"></script>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="my_posts.css">
</head>
<body onclick="body1()">

<div id ="myModal" class="modal">
        <a href="javascript:void(0)" onclick="closemodal()" class="closebtn">&times;</a>
    <div id="modalContent" class="modalContent">
        <div class="modalButton">
            <input type="button" value="From your computer" onclick="addimage1()"> <input type="button" value="From your uploaded images" onclick="fromupload()">
        </div>
        <div class="uploadimg" id="uploadimg"></div>
    </div>
    <input type="button" value="Use them in the post" id="uploadimgbtn" onclick="imginpost()">
</div>
<div id="myNav1" class="overlay" style="overflow:scroll;" onclick="closemenu()">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()" id="closebtn">&times;</a>
  <form enctype="multipart/form-data" id="form_img" style="visibility: hidden;">
  <input type="file" name="fileToUpload" id="file" style="height: 0px" onchange="fileselect()"><input type="submit" id="sub_img" onsubmit="sub_img()"></form>
  <input type="button" value="Add Image..." name="btn" style="position:relative;top:27%;background-color:#8ABBF6;color:white;border:none;width:50%;left:25%;padding:12px 20px;" onclick="addimage()">

  <div class="menu" style="right:20%">
<div class="down" onclick="down1()"></div>
<div class="dropdown-content0" id="postdown" onclick="postdown()">
<a>Who can see my post<select style="right:0;position: absolute;" id="postdownsee" onchange="postdownseechange()"><option value="1">All</option><option value="2">Nobody</option></select></a>
<a>Who can interact with my post<select style="right:0;position: absolute;" id="postdowninteract"><option value="1">All</option><option value="2">Nobody</option></select></a>
</div>
</div>

  <div class="overlay-content1" id="overlay-content1" contenteditable="true">
  </div>        
  <input type="button" value="Post" name="btn" style="position:relative;top:23%;background-color:#8ABBF6;color:white;border:none;width:50%;left:25%;padding:12px 20px;" onclick="sharepost()">
</div>

<div id="myNav" class="overlay" style="overflow:scroll;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" id="closebtn">&times;</a>
  <div class="overlay-content" id="overlay-content">
  </div>
</div>


<div id ="myModal1" class="modal">
        <a href="javascript:void(0)" onclick="closemodal1()" class="closebtn">&times;</a>
    <div id="modalContent" class="modalContent">
        <div class="modalButton">
            <input type="button" value="From your computer" onclick="addimage2()"> <input type="button" value="From your uploaded images" onclick="fromupload2()">
        </div>
        <div class="uploadimg" id="uploadimg2"></div>
    </div>
    <input type="button" value="Use them in the post" id="uploadimgbtn2" onclick="imginpost2()">
</div>

<div id="myNav2" class="overlay" style="overflow:scroll;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()" id="closebtn">&times;</a>
  <form enctype="multipart/form-data" id="form_img1" style="visibility: hidden;">
  <input type="file" name="fileToUpload1" id="file2" style="height: 0px" onchange="fileselect1()"><input type="submit" id="sub_img" onsubmit="sub_img()"></form>
  <input type="button" value="Add Image..." name="btn" style="position:relative;top:27%;background-color:#8ABBF6;color:white;border:none;width:50%;left:25%;padding:12px 20px;" onclick="addimage3()">
  <div class="overlay-content1" id="overlay-content2" contenteditable="true">
  </div>        
  <input type="button" value="Edit Post" name="btn" style="position:relative;top:23%;background-color:#8ABBF6;color:white;border:none;width:50%;left:25%;padding:12px 20px;" onclick="editpost()">
</div>



<div class="header">
    <div>
	<center><a href="home.php"><img src="logo.png"></a></center>
	<div class="dropdown">
	
		<div style="background-color:#8ABBF6;color:white;border:none;padding:12px 20px;float:right;cursor:pointer;position:relative" onclick=A() class="dropbtn"><?php
				echo($r1);
				?>
		<!--</div>-->
		<!--<br><br>-->
		<div id="myDropdown" class="dropdown-content">
            <a href="my_posts.php">My posts</a>
            <a href="liked.php">What I liked</a>
    		<a href="about.php">About me</a>
    		<a href="settings.php">Settings</a>
    		<a href="signout.php">Sign Out</a>
  		</div>
  		</div>
  		
	</div>
</div>
</div>
<div class="chat" id="chat">
	<div class="chat_head" id="chat_head">
		<div class="chat_name" id="chat_name" onclick="close_chat()"></div>
	</div>
	<div class="chatbody" id="chatbody"></div>
	<div class="chatmsg" id="chatmsg"><form name="chat"><input type="text" autocomplete="off" name="chat" style="width:82%"><input type="button" style="position:absolute;right:0;width:18%" value="send" name="chtbtn" onclick="send()"></form></div>
</div>
<input type="text"  placeholder="Share what you are feeling..." class="t1" onclick="openNav1()">
<br><br>
<?php
	$conn=new mysqli("localhost","root","","$id");
	$sql="SELECT * FROM posts ORDER BY post_id DESC";
	$r=$conn->query($sql);
	while($r1=$r->fetch_assoc())
	{
		$pid=$r1['post_id'];
		$pidx=$pid;
		$pid=$pid."p";
		$pida=$pid."p";
		echo("<br><div class=\"posts\" id=\"$pid\">");
		echo("<div class=\"menu\">");
		echo("<div class=\"down\" onclick=\"down('$pida')\"></div>");
		echo("<div class=\"dropdown-content0\" id=\"$pida\">");
		echo("<a onclick=\"edit1('$pid')\">Edit</a><a onclick=\"delete1('$pid')\">Delete</a><a onclick=\"setting('$pidx')\">Setting</a>");
		echo("</div></div>");
		$conn1=new mysqli("localhost","root","","$pid");
		$sql1="SELECT * FROM post";
		$rr=$conn1->query($sql1);
		$pidaa=$pida."p";
		echo("<div id=\"$pidaa\">");
		while($rr1=$rr->fetch_assoc())
		{
			echo($rr1['post']."</div>");
		}
		echo("</div>");
	}
?>
<div class="modal" id="settingmodal">
	<a href="javascript:void(0)" onclick="closesetting()" class="closebtn">&times;</a>
	<div class="modalContent" id="settingContent">
	</div>
</div>