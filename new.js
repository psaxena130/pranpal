var x;
	$(document).ready(function(){
		$("#id").change(function(){
			x=document.f.t.value;
			$.post("check_user.php",
    		{
        		id:x,
    		},
    		function(data, status){
    				if(data==0){
        			document.f.t.style="color:green;";
        		}
        		else
        			{
        				alert("Already used!");
        				document.f.t.style="";
        				document.f.t.value="";
        				document.f.t.focus();
        		}
    		});
		});
	});
function A()
	{
		document.f.t.value="";
	}
	function B()
	{
		document.f.n.value="";
	}
	function D(){
	document.f.p1.value="";
	document.f.p1.type="password";
	}
	function E()
	{
		document.f.p2.value="";
		document.f.p2.type="password";
	}
	function C()
	{var x=0;
		var i;
		var j;
		var s=document.f.p1.value;
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

		if(x==0)
		{
			alert("Password not safe!");
			document.f.p1.value="";
			document.f.p1.style="";
		}
		else
		{
			document.f.p1.style="background-color:green";
		}
	}
	function F()
	{
		if((document.f.p1.value==document.f.p2.value)&&(document.f.t.value!="")&&(document.f.n.value!="")&&(document.f.p1.value!=""))
		{
			f.submit();
		}
		else
		{
			if(document.f.p1.value!=document.f.p2.value){
			alert("Password didn't match!");
			document.f.p1.value="";
			document.f.p2.value="";}
			else
			{
				alert("Fields not filled")
			}
		}
	}