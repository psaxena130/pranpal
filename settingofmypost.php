<?php
session_start();
if(!isset($_SESSION['id']))
	header("location:login.php");
if(!isset($_POST['i'])||!isset($_POST['post']))
	header("location:home.php");
$pid=$_POST['post'];
$id=$_SESSION['id'];
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT whocansee FROM account WHERE id=\"$id\"";
$r=$conn->query($sql);
while($r1=$r->fetch_assoc())
{
	if($r1['whocansee']==3)
	{
		echo("According to your profile settings, nobody except can see your posts. You can always change settings.");
	}
	else
	{
		echo("<table>");
		echo("<tr><td>Who can see this post</td><td><select id=\"changesee\" onchange=\"changesee('$pid')\">");
		$conn1=new mysqli("localhost","root","","$id");
		$sql1="SELECT * FROM posts WHERE post_id=\"$pid\"";
		$rr=$conn1->query($sql1);
		while($rr1=$rr->fetch_assoc())
		{
			$whocansee=$rr1['whocansee'];
			$whocaninteract=$rr1['whocaninteract'];
			$whocanseetext="All";
			if($whocansee==1)
				$whocantsee=2;
			else
				$whocantsee=1;

			if($whocaninteract==1)
				$whocantinteract=2;
			else
				$whocantinteract=1;
			$whocantseetext="Nobody";
			$whocantinteracttext="Nobody";

			if($whocantsee==1)
				$whocantseetext="All";
			if($whocantinteract==1)
				$whocantinteracttext="All";

			$whocaninteracttext="All";
			if($whocansee==2)
				$whocanseetext="Nobody";
			if($whocaninteract==2)
				$whocaninteracttext="Nobody";
			echo("<option value=\"$whocansee\" selected>$whocanseetext</option><option value=\"$whocantsee\">$whocantseetext</option></select></td></tr>");
			echo("<tr><td>Who can interact with this post</td><td><select id=\"changeinteract\" onchange =\"changeinteract('$pid')\">");
			echo("<option value=\"$whocaninteract\" selected>$whocaninteracttext</option><option value=\"$whocantinteract\">$whocantinteracttext</option></select></td></tr></table>");
		}

	}
}
?>