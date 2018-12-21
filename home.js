//document.getElementById("myDropdown21").innerHTML=document.getElementById("myDropdown2").innerHTML;
var uploadimg=[];
var uploadimageindex=0;
$("#uploadimgbtn").hide();
var close_menu=0;
var postdownclicked=0;

function closemenu(){
if(postdownclicked==0){
  if(close_menu==0)
    document.getElementById("postdown").style.display="none";
  else
    close_menu=0;
  }
  else
    postdownclicked=0;
}
function postdown(){
  postdownclicked=1;
}

function A() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function B()
{
  var d=document.getElementById("myDropdown2");
  if(d.style.display!="block"){
  d.style="display:block;";}
  else
  {
    d.style.display="none";
  }
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
if (!event.target.matches('.dropbtn1')) {  
  document.getElementById("myDropdown2").style.display="none";
  }
  if(!event.target.matches('.search')){
    document.getElementById("t").innerHTML="";
    document.getElementById("myDropdown1").innerHTML="";
      document.getElementById("myDropdown1").hide();
  }
}



var x;
var y=0;
  $(document).ready(function(){
    //$(".header2").hide();
    $("#t").keyup(function(){
      x=document.f.t.value;
      if(x!="")
        {$.post("search.php",
        {
            id:x,
        },
        function(data, status){
            var y=document.getElementById("myDropdown1");
            //y.style.display="block";
            y.classList.toggle("show1");
            y.innerHTML=data;
        });}
      else{
      document.getElementById("myDropdown1").innerHTML="";
      document.getElementById("myDropdown1").hide();}
    });

    /*$("#accept").click(function(){
        document.write(document.f1.h.value);
    });*/

    var CurrentScroll = 0;
    var hidden =0;

  $(window).scroll(function(event){
      var NextScroll = $(this).scrollTop();

      if (NextScroll > CurrentScroll){
         //write the codes related to down-ward scrolling here
         //alert("down");
         if(hidden==0)
         {//$(".search").hide();
         $(".header").hide();
         hidden=1;
       }
      }
      else {
         //write the codes related to upward-scrolling here
         if(hidden==1&&NextScroll==0){
         //$(".search").show();
         $(".header").show();
         hidden=0;
       }
       
      }

      CurrentScroll = NextScroll;  //Updates current scroll position
  });

  });

var ctr1=-1;
  function accept(y,notno,ctr)
{
      $.post("accept.php",
        {
            id:y,
        },
        function(data, status){
            if(data==1)
              {notno="#"+notno;$(notno).hide();
            if(ctr1==-1)
              ctr1=ctr;
            ctr1--;
            if(ctr1>0)
              document.getElementById("notificationtext").innerHTML=ctr1;
            else
              document.getElementById("notificationtext").innerHTML="";}
            else
            {
              alert(data);
            }}
        );
}

  function seen(y,z,notno,ctr)
  { $.post("seen.php",
        {
            type:y,
            who:z,
        },
        function(data, status){
            if(data==1)
              {notno="#"+notno;$(notno).hide();
            if(ctr1==-1)
              ctr1=ctr;
            ctr1--;
            if(ctr1>0)
              document.getElementById("notificationtext").innerHTML=ctr1;
            else
              document.getElementById("notificationtext").innerHTML="";
          }
            else
            {
              alert(data);
            }}
        );
  }

  function decline(y,notno,ctr)
  {
    $.post("decline.php",
        {
            id:y,
        },
        function(data, status){
            if(data==1)
              {notno="#"+notno;$(notno).hide();
            if(ctr1==-1)
              ctr1=ctr;
            ctr1--;
            if(ctr1>0)
              document.getElementById("notificationtext").innerHTML=ctr1;
            else
              document.getElementById("notificationtext").innerHTML="";
          }
            else
            {
              alert(data);
            }
        }); 
  }


function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}

function closeNav1() {
    document.getElementById("myNav1").style.height = "0%";
    document.getElementById("overlay-content1").innerHTML="";
}

window.ondblclick=function(){
  document.getElementById("myNav").style.height = "100%";
  $.post("online.php",
        {
            id:1,
        },
        function(data, status){
            document.getElementById("overlay-content").innerHTML=data;
        }); 
}
function openNav1()
{
  document.getElementById("myNav1").style.height="100%";
  document.getElementById("overlay-content1").focus();
}

var fmsg,ch=0;
var pal;
function chat1(id,name)
  { 
    pal=id;
    document.getElementById("chat_name").innerHTML=name;
    document.chat.chat.placeholder="Message to "+name;
    document.getElementById("chatbody").innerHTML="";
    document.getElementById("myNav").style.height="0%";
    document.getElementById("chat").style.height="70%";
    document.getElementById("chat").style.border="1px solid #ccc";
    if(ch==1)
      {document.getElementById("chatbody").innerHTML="";
       clearInterval(fmsg);
      }
    ch=1;
    $.post("fetchmsg1.php",
        {
            pal2:id,
            i:1,
        },
        function(data,status){
            document.getElementById("chatbody").innerHTML=data;
            //document.getElementById("chatbody").scrollIntoView(false);
            //document.getElementById("chatbody").scrollTo(0,document.getElementById("chatbody").scrollHeight);
            //document.getElementById("chatbody").scrollIntoView(false);
            document.getElementById("chatbody").scrollTop = document.getElementById("chatbody").scrollHeight;
        });
    fmsg=setInterval(function(){fetchmsg(id,name)},1000);
    //fetchmsg(id,name);
  }
function fetchmsg(id,name)
{
  $.post("fetchmsg.php",
        {
            pal2:id,
            i:1,
        },
        function(data,status){
            //document.getElementById("chatbody").innerHTML=data;
            if(document.getElementById("chatbody").innerHTML=="No message"&&data!="")
              document.getElementById("chatbody").innerHTML="";
            $("#chatbody").append(data);
            if(data!="")
              document.getElementById("chatbody").scrollTop = document.getElementById("chatbody").scrollHeight;
              //document.getElementById("chatbody").scrollTo(0,document.getElementById("chatbody").scrollHeight);
              //document.getElementById("chatbody").scrollIntoView(false);
              
            //document.getElementById("chatbody").scrollIntoView(false);
        });
}
function close_chat()
{
  document.getElementById("chat").style.height="0%";
  document.getElementById("chat").style.border="0px";
  clearInterval(fmsg); 
}
function send()
{
  var msg=document.chat.chat.value;
  //clearInterval(fmsg
  $.post("sendmsg.php",
        {
            i:1,
            pal1:pal,
            msg1:msg,
        },
        function(data,status){
          //document.getElementById("chatbody").innerHTML=data;
          if(document.getElementById("chatbody").innerHTML=="No message"&&data!="")
              document.getElementById("chatbody").innerHTML="";
          $("#chatbody").append(data);
          document.chat.chat.value="";
          document.getElementById("chatbody").scrollTop = document.getElementById("chatbody").scrollHeight;
          //document.getElementById("chatbody").scrollTo(0,document.getElementById("chatbody").scrollHeight);
          //document.getElementById("chatbody").scrollIntoView(false);
          //window.scrollTo(0,document.body.scrollHeight);
        }
        );
  //fmsg=setInterval(function(){fetchmsg(id,name)},1000);
}

function sharepost()
{
  var posts=document.getElementById("overlay-content1").innerHTML;
  var p=document.getElementById("postdownsee").selectedIndex;
  var q=document.getElementsByTagName("option")[p].value;
  var a=document.getElementById("postdowninteract").selectedIndex;
  var b=document.getElementsByTagName("option")[a].value;
  $.post("sharepost.php",
        {
            i:1,
            post:posts,
            optionsee:q,
            optioninteract:b,
        },
        function(data,status){
          document.getElementById("myNav1").style.height="0%";
          document.getElementById("overlay-content1").innerHTML="";
          //alert(data);
        }
        );
}
function addimage()
{
  //document.getElementById("file").click();
  document.getElementById("myModal").style.height="100%";
  document.getElementById("uploadimgbtn").style.visibility="hidden";
}
function closemodal()
{
  document.getElementById("myModal").style.height="0%";
  document.getElementById("uploadimg").innerHTML="";
  uploadimageindex=0;
  uploadimg=[];
}
function addimage1()
{ 
  document.getElementById("myModal").style.height="0%";
  document.getElementById("uploadimg").innerHTML="";
  document.getElementById("file").click();
}


function fileselect()
{
  var form=$('#form_img')[0];
  var image=document.getElementById("file").value;
  $.ajax({
url: "upload.php", 
type: "POST",             
data: new FormData(form), 
contentType: false,       
cache: false,             
processData:false,        
success: function(data)   
{
//alert(data);
$("#overlay-content1").append(data);
document.getElementById("overlay-content1").focus();
}

});
}

function fromupload()
{
  $.post("fromupload.php",
        {
            i:1,
        },
        function(data,status){
          document.getElementById("uploadimg").innerHTML=data;
          if(data!="")
          {
            document.getElementById("uploadimgbtn").style.visibility="visible";
          }
        }
        );
}

function uploadimg1(img)
{
    uploadimg[uploadimageindex++]=img;
}
function imginpost()
{
  var ind;
  document.getElementById("myModal").style.height="0%";
  document.getElementById("uploadimg").innerHTML="";
  for(ind=0;ind<uploadimageindex;ind++)
  {
    $(".overlay-content1").append("<img src=\""+uploadimg[ind]+"\"><br>");
  }
  uploadimageindex=0;
  uploadimg=[];
}

function down1(){
  document.getElementById("postdown").style.display="block";
  close_menu=1;
}
function postdownseechange(){
  var x=document.getElementById("postdownsee").selectedIndex;
  var y=document.getElementsByTagName("option")[x].value;
  if(y==2)
    document.getElementById("postdowninteract").style.display="hidden";
  if(y==1&&document.getElementById("postdowninteract").style.display=="hidden")
  {
    document.getElementById("postdowninteract").style.display="inline-block";
  }
}