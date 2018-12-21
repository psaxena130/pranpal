<?php
session_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
if(!isset($_POST['id']))
{header("location:home.php");}
$ptr=0;
$id=$_SESSION['id'];
echo("<center><table>");
$conn=new mysqli("localhost","root","","$id");
  	$sql="SELECT friend_id FROM pals";
  	$rx=$conn->query($sql);
  	if($rx->num_rows>0)
  	{
  		while($rx1=$rx->fetch_assoc())
  		{
  			$rx11=$rx1['friend_id'];
  			$conn1=new mysqli("localhost","root","","pranpal");
  			$sql1="SELECT * FROM online WHERE id=\"$rx11\"";
  			$rx12=$conn1->query($sql1);
  			if($rx12->num_rows>0)
  			{
  				$sql1="SELECT name FROM about WHERE id=\"$rx11\"";
  				$rx122=$conn1->query($sql1);
  				if($rx122->num_rows>0)
  				{
  					while($rx121=$rx122->fetch_assoc())
  					{
  						$rx1211=$rx121['name'];
  						echo("<tr><td onclick=\"chat1("."'".$rx11."','".$rx1211."')\">$rx1211</td></tr>");
  						$ptr++;
  						/* */
  					}
  				}
  			}
  		}
  	}
  	if($ptr==0)
	{
		echo("<tr><td>No friend online</tr></td>");
	}
  	echo("</center></table>")
?>