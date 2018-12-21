var uploadimg3=[];
var uploadimgindex2=0;
var pid1=null;
var pida2=null;
var x=0;
var pida1=null;
function body1(){
	if(pida1!=null)
	{
		if(x==0)
		{document.getElementById(pida1).style.display="none";
		pida1=null;}
		else
			x=0;
	}
}
function down(pida)
{
	//alert(pida);
	if(pida1!=null)
		document.getElementById(pida1).style.display="none";
	document.getElementById(pida).style.display="block";
	pida1=pida;
	x=1;
}
function delete1(pid)
{
  $.post("deletepost.php",
        {
            i:1,
            post:pid,
        },
        function(data,status){
        	var pida="#"+pid;
          $(pida).hide();
          //alert(data);
        }
        );
}
function edit1(pid)
{
	document.getElementById("myNav2").style.height="100%";
	pid1=pid;
	pida2=pid+"pp";
	document.getElementById("overlay-content2").innerHTML=document.getElementById(pida2).innerHTML;
}
function closeNav2()
{
	document.getElementById("myNav2").style.height="0%";
}
function fileselect1()
{
	var form=$('#form_img1')[0];
  //var image=document.getElementById("file").value;
  $.ajax({
url: "upload1.php", 
type: "POST",             
data: new FormData(form), 
contentType: false,       
cache: false,             
processData:false,        
success: function(data)   
{
//alert(data);
$("#overlay-content2").append(data);
document.getElementById("overlay-content2").focus();
}
});
}

function addimage3(){
	document.getElementById("myModal1").style.height="100%";
	document.getElementById("uploadimgbtn2").style.visibility="hidden";
}

function editpost(){
	var post1=document.getElementById("overlay-content2").innerHTML;
	$.post("editpost.php",
        {
            i:1,
            pid:pid1,
            post:post1,
        },
        function(data,status){
        	document.getElementById(pida2).innerHTML = post1;
        	document.getElementById("myNav2").style.height="0%";
        }
        );	
}

function closemodal1(){
	document.getElementById("myModal1").style.height="0%";
	document.getElementById("uploadimg2").innerHTML="";
	uploadimgindex2=0;
  uploadimg3=[];
}

function addimage2(){
	document.getElementById("myModal1").style.height="0%";
	document.getElementById("uploadimg2").innerHTML="";
	document.getElementById("file2").click();
}

function fromupload2(){
	$.post("fromupload1.php",
        {
            i:1,
        },
        function(data,status){
          document.getElementById("uploadimg2").innerHTML=data;
          if(data!="")
          {
            document.getElementById("uploadimgbtn2").style.visibility="visible";
          }
        }
        );
}
function uploadimg2(img)
{
	uploadimg3[uploadimgindex2++]=img;
}

function imginpost2(){
	var ind;
  document.getElementById("myModal1").style.height="0%";
  document.getElementById("uploadimg2").innerHTML="";
  for(ind=0;ind<uploadimgindex2;ind++)
  {
    $("#overlay-content2").append("<img src=\""+uploadimg3[ind]+"\"><br>");
  }
  uploadimgindex2=0;
  uploadimg3=[];
}

function setting(pid)
{
	$.post("settingofmypost.php",
        {
            i:1,
            post:pid,
        },
        function(data,status){
         	 document.getElementById("settingContent").innerHTML=data;
        }
        );
	document.getElementById("settingmodal").style.height="100%";

}
function closesetting(){
	document.getElementById("settingmodal").style.height="0%";
}

function changesee(pid)
{
	var x=document.getElementById("changesee").selectedIndex;
	var y=document.getElementsByTagName("option")[x].value;
	$.post("changesee.php",
        {
            i:1,
            post:pid,
            option:y,
        },
        function(data,status){
        }
        );
}

function changeinteract(pid)
{
	var x=document.getElementById("changeinteract").selectedIndex;
	var y=document.getElementsByTagName("option")[x].value;
	$.post("changeinteract.php",
        {
            i:1,
            post:pid,
            option:y,
        },
        function(data,status){
        }
        );
}

