<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
if(!isset($_GET['id']))
{
	header("location:home.php");
}
$x1=$_GET['id'];
$session_id=$_SESSION['id'];
$_SESSION['profile']=$x1;
?>
<!DOCTYPE html>
<head>
<title>
	<?php
	$conn=new mysqli("localhost","root","","pranpal");
	$sql="SELECT name FROM about WHERE id=\"$x1\"";
	$r=$conn->query($sql);
	while($r1=$r->fetch_assoc())
	{
		$x=$r1['name'];
		echo($r1['name']);
	}
	?>
</title>
<script src="jquery.js"></script>
<script src="profile.js"></script>
<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>

<div id="myNav" class="overlay" style="overflow:scroll;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" id="closebtn">&times;</a>
  <div class="overlay-content">
  <center>
  	<table>
    <?php
    	$conn=new mysqli("localhost","root","","pranpal");
    	$sql="SELECT * FROM about WHERE id=\"$x1\"";
    	$r=$conn->query($sql);
    	while($r1=$r->fetch_assoc())
    	{
    		echo("<tr><td>Name:</td><td>".$r1['name']."</td></tr>");
    		echo("<tr><td>Sex:</td><td>".$r1['sex']."</td></tr>");
    		echo("<tr><td>Date of birth:</td><td>".$r1['dob']."</td></tr>");
    		if($r1['relationship']==0){
    			echo("<tr><td>Relationship:</td><td>Single</td></tr>");	
    		}
    		else
    		{
    			echo("<tr><td>Relationship:</td><td>Taken. Better luck next time...</td></tr>");
    		}
    		if($r1['phone']!=NULL)
    			{echo("<tr><td>Phone:</td><td>".$r1['phone']."</td></tr>");}
    	}	
    	echo("</table></center>");
    	$conn=new mysqli("localhost","root","","$x1");
    	$sql="SELECT * FROM pals";
    	$r=$conn->query($sql);
    	if($r->num_rows>0){echo("<table>");
    	while($r1=$r->fetch_assoc())
    	{echo("<tr><td>");
    		/*echo("
    				<div style=\"height:50px;width:50px;position:relative\">");*/
    							$mf=0;
    							$f=$r1['friend_id'];
    							if($f!=$session_id){
    							$connmf=new mysqli("localhost","root","","$session_id");
    							$connmf1=new mysqli("localhost","root","","$f");
    							$sqlmf1="SELECT friend_id FROM pals";
    							$rmf1=$connmf1->query($sqlmf1);
    							if($rmf1->num_rows>0)
    							{
    								while($rmf11=$rmf1->fetch_assoc())
    								{
    									$ff=$rmf11['friend_id'];
    									$sqlmf="SELECT friend_id FROM pals WHERE friend_id=\"$ff\"";
    									$rmf=$connmf->query($sqlmf);
    									if($rmf->num_rows>0)
    									{
    										$mf++;
    									}
    								}
    							}}
    							if($mf==0)
    							{
    								$mf="";
    							}

    					echo("<img src=\"default.jpg\"</td><td>
    					<font color=\"#f1f1f1\">
    			");
    		$r11=$r1['friend_id'];
    		$conn1=new mysqli("localhost","root","","pranpal");
    		$sql1="SELECT * FROM about WHERE id=\"$r11\"";
    		$r11=$conn1->query($sql1);
    		while($r112=$r11->fetch_assoc())
    		{
    			$r1121=$r112['id'];
    			if($r1121!=$session_id){
    			echo("<a href=\"profile.php?id=$r1121\" style=\"text-decoration:none;color:#f1f1f1\">".$r112['name']." "."</font></td><td>$mf</td></tr>");}

    			else
    			{
    				echo($r112['name']." "."</font></td><td>$mf</td></tr>");
    			}
    		}
    	}
    	echo("</table>");
    }
    	else
    	{
    		$conn11=new mysqli("localhost","root","","pranpal");
    		$sql="SELECT sex FROM about WHERE id=\"$x1\"";
    		$r=$conn11->query($sql);
    		while($r1=$r->fetch_assoc())
    		{
    			if($r1['sex']=="Female")
    			{
    				$y="her";
    			}
    			else
    			{
    				$y="his";
    			}
    		}
    		echo("<font color=#f1f1f1>Be $y first friend</font>");
    	}
    ?>
    
  </div>
</div>

<div>
	<center><a href="home.php"><img src="logo.png"></a></center>
	<div class="dropdown">
		<div style="background-color:#8ABBF6;color:white;border:none;padding:12px 20px; float:right;cursor:pointer" onclick=A() class="dropbtn"><?php
				echo($_SESSION['name']);
				?>
		</div>
		<br><br>
		<div id="myDropdown" class="dropdown-content" style="right:0">
    		<a href="my_posts.php">My posts</a>
            <a href="liked.php">What I liked</a>
            <a href="about.php">About me</a>
            <a href="settings.php">Settings</a>
            <a href="signout.php">Sign Out</a>
  		</div>
	</div>
</div><br><br><br>
<center>
<div class="search">
    <form name="f">
    <input type="text" autocomplete="off" class="t" placeholder="Search Your friends..." id="t"  name="t"></center>
    <div id="myDropdown1" class="search-content">   </div>
    </form>
    </div>

<div style="background-color:#8ABBF6;color:white;border:none;padding:12px 20px;cursor:pointer;display:inline-block;" onclick="openNav()">About 
<?php
echo($x);
?>
</div>
&nbsp;
<?php
$conn=new mysqli("localhost","root","","$x1");
$sql="SELECT friend_id FROM pals WHERE friend_id=\"$session_id\"";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	echo("<div style=\"background-color:#00f90c;color:white;border:none;width:10%;padding:12px 20px;display:inline-block;cursor:pointer\" id=\"b\"><center>Friends</center></div>");
}
else
{
	$sql="SELECT id FROM request WHERE id=\"$session_id\"";
	$r=$conn->query($sql);
	if($r->num_rows>0)
	{
		echo("<div style=\"background-color:#8ABBF6;color:white;border:none;width:15%;padding:12px 20px;display:inline-block;cursor:pointer\" id=\"c\"><center>Friend request sent</center></div>");	
	}
	else
	{
		echo("<div style=\"background-color:#f90000;color:white;border:none;width:10%;padding:12px 20px;display:inline-block;cursor:pointer\" id=\"d\"><center>Not Friends</center></div>");
	}

}
?>
<br><br>
<?php
    $conn=new mysqli("localhost","root","","pranpal");
    $sql="SELECT whocansee FROM account WHERE id=\"$x1\"";
    $r=$conn->query($sql);
    while($r1=$r->fetch_assoc())
    {
        $whocansee=$r1['whocansee'];
    }
    if($whocansee==3)
    {;}
    else
    {
        if($whocansee==1)
        {
            $conn1=new mysqli("localhost","root","","$x1");
            $sql1="SELECT * FROM posts ORDER BY post_id DESC";
            $r=$conn1->query($sql1);
            if($r->num_rows>0){
            while($r1=$r->fetch_assoc())
            {
                if($r1['whocansee']==1)
                {
                    $post=$r1['post_id'];
                    $post_id=$post."p";                
                    $conn=new mysqli("localhost","root","","$post_id");
                    $sql="SELECT * FROM post";
                    $rr=$conn->query($sql);
                    while($rr1=$rr->fetch_assoc())
                    {
                        echo("<br><div class=\"posts\">");
                        echo($rr1['post']);
                    }
                    if($r1['whocaninteract']==1)
                    {
                        echo("<br><div class=\"postinteract\"><a class=\"like\" id=\"like\" onclick=\"like('$post','$session_id','$x1')\">Like</a>\t<a class=\"dislike\" id=\"dislike\" onclick=\"dislike('$post','$session_id','$x1')\">Dislike</a></div></div>");
                    }
                    else
                        {echo("</div>");}
                }
            }}
        }
    }
?>