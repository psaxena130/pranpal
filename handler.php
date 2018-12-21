<?php
$conn=new mysqli("localhost","root","","pranpal");
$sql="SELECT id FROM account";
$r=$conn->query($sql);
if($r->num_rows>0)
{
	while($r1=$r->fetch_assoc())
	{
		$id=$r1['id'];
		$conn1=new mysqli("localhost","root","","$id");
		$sql1="SELECT friend_id FROM pals";
		$rr=$conn1->query($sql1);
		if($rr->num_rows>0)
		{
			while($rr1=$rr->fetch_assoc())
			{
				$pal=$rr1['friend_id'];
				$sql2="CREATE TABLE $pal(
					f VARCHAR(100),
					t VARCHAR(100),
					msg VARCHAR(300)
				);";
				if(!$conn1->query($sql2))
				{
					echo($conn1->error."<br>");
				}
			}
		}
	}
}
?>