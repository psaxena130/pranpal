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
?>
<!DOCTYPE html>
<head>
<title><?php
while($r=$name->fetch_assoc())
	{	$r1=$r['name'];
		$_SESSION['name']=$r1;
		echo($r['name']);}
?>
</title>
<script src="jquery.js"></script>
<script src="home.js"></script>
<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>

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

<div id="myNav" class="overlay" style="overflow:scroll;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" id="closebtn">&times;</a>
  <div class="overlay-content" id="overlay-content">
  </div>
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
  		<div style="background-color:#8ABBF6;color:white;border:none;padding:12px 20px;float:right;cursor:pointer;position:relative" onclick="B()" class="dropbtn1" id="dropbtn1">Notification
  		<?php
	$ctr=0;
	$conn=new mysqli("localhost","root","","$id");
	$sql="SELECT * FROM notification";
	$rx=$conn->query($sql);
	if($rx->num_rows>0)
	{
		while($rx1=$rx->fetch_assoc())
		{
			$ctr++;
		}
	}
	if($ctr>0){
	echo("<span id=\"notificationtext\">$ctr</span>");}
	?>
	<div id="myDropdown2" class="dropdown-content2">
    <?php
    $rx=$conn->query($sql);
    $notno=0;
    if($rx->num_rows>0)
    {
    	while($rx1=$rx->fetch_assoc())
    	{
            $notno++;
    		if($rx1['type']==0)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has sent a friendship request<center><table><tr><td><div style=\"background-color:#00f90c;color:white;border:none;width:50px;padding:12px 20px;\" id=\"accept\" onclick=\"accept("."'".$who."',$notno)\"><center>Accept</center></div></td><td><div style=\"background-color:#f90000;color:white;border:none;width:50px;padding:12px 20px;\" id=\"decline\" onclick=\"decline("."'".$who."',$notno,$ctr)\"><center>Decline</center></div></td></tr></table></center></div>");
    			}
    		}
    		if($rx1['type']==2)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\" onclick=\"seen(".$rx1['type'].",'$who',$notno,$ctr)\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has accepted your friendship</div>");
    			}
    		}   
    		if($rx1['type']==6)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\" onclick=\"seen(".$rx1['type'].",'$who',$notno,$ctr)\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has declined your friendship</div>");
    			}
    		}
    		if($rx1['type']==1)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\" onclick=\"seen(".$rx1['type'].",'$who',$notno,$ctr)\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has ended friendship with you!</div>");
    			}
    		}
			if($rx1['type']==3)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\" onclick=\"seen(".$rx1['type'].",'$who',$notno,$ctr)\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has liked your post</div>");
    			}
    		}
    		if($rx1['type']==4)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\" onclick=\"seen(".$rx1['type'].",'$who',$notno,$ctr)\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has disliked your post</div>");
    			}
    		}
    		if($rx1['type']==5)
    		{
    			$who=$rx1['who'];
    			$conn1=new mysqli("localhost","root","","pranpal");
    			$sql1="SELECT name FROM about WHERE id=\"$who\"";
    			$wr=$conn1->query($sql1);
    			while($wr1=$wr->fetch_assoc())
    			{
    				echo("<div class=\"not\" id=\"$notno\" onclick=\"seen(".$rx1['type'].",'$who',$notno,$ctr)\"><a href=\"profile.php?id=$who\">".$wr1['name']."</a> has commented on your post</div>");
    			}
    		} 	 	
    	}
    }
    ?>
  	</div>
	</div>
	</div>
</div><br><br><br><form name="f1"><input type="hidden" name="h"></form>
<center>
<div class="search">
	<form name="f">
	<input type="text" autocomplete="off" class="t" placeholder="Search Your friends..." id="t"  name="t"></center>
	<div id="myDropdown1" class="search-content">  	</div>
    </form>
	</div></div>
<div class="chat" id="chat">
	<div class="chat_head" id="chat_head">
		<div class="chat_name" id="chat_name" onclick="close_chat()"></div>
	</div>
	<div class="chatbody" id="chatbody"></div>
	<div class="chatmsg" id="chatmsg"><form name="chat"><input type="text" autocomplete="off" name="chat" style="width:82%"><input type="button" style="position:absolute;right:0;width:18%" value="send" name="chtbtn" onclick="send()"></form></div>
</div>
<input type="text"  placeholder="Share what you are feeling..." class="t1" onclick="openNav1()">
<?php
for($i=0;$i<200;$i++)
    echo("<br>");
?>