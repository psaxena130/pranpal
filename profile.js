function A() {
    document.getElementById("myDropdown").classList.toggle("show");
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
  if(!event.target.matches('.search')){
    document.getElementById("t").innerHTML="";
    document.getElementById("myDropdown1").innerHTML="";
      document.getElementById("myDropdown1").hide();
  }
}
function openNav() {
    document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}

var x;
  $(document).ready(function(){
    $("#t").keyup(function(){
      x=document.f.t.value;
      if(x!="")
        {$.post("search.php",
        {
            id:x,
        },
        function(data, status){
            var y=document.getElementById("myDropdown1");
            y.classList.toggle("show1");
            y.innerHTML=data;
        });}
      else{
      document.getElementById("myDropdown1").innerHTML="";
      document.getElementById("myDropdown1").hide();}
    });
    $("#b").click(function(){
      
        $.post("end_friend.php",
        {
            end:0,
        },
        function(data, status){
           if(data=="y")
           {
              $("#b").attr("id","d");
              document.getElementById("d").style.width="10%";
              document.getElementById("d").style.backgroundColor="#f90000";
              document.getElementById("d").innerHTML="<center>Not Friends</center>";             
           }
        });
    });


     $("#d").click(function(){
      
        $.post("request_friend.php",
        {
            end:0,
        },
        function(data, status){
           if(data=="y")
           {
              $("#d").attr("id","c");
              document.getElementById("c").style.width="15%";
              document.getElementById("c").style.backgroundColor="#8ABBF6";
              document.getElementById("c").innerHTML="<center>Friend request sent</center>";             
           }
        });
    });

     $("#c").click(function(){
      
        $.post("end_request.php",
        {
            end:0,
        },
        function(data, status){
           if(data=="y")
           {
              $("#c").attr("id","d");
              document.getElementById("d").style.width="10%";
              document.getElementById("d").style.backgroundColor="#f90000";
              document.getElementById("d").innerHTML="<center>Not Friends</center>";             
           }
        });
    });
 });

function like(postid,id1,to1){
  $.post("likepost.php",
        {
            i:1,
            post:postid,
            id:id1,
            to:to1,
        },
        function(data,status){
          //alert(data);
          document.getElementById("dislike").innerHTML="Dislike";
          document.getElementById("like").innerHTML="Liked";
        }
        );
}

function dislike(postid,id1,to1){
  $.post("dislikepost.php",
        {
            i:1,
            post:postid,
            id:id1,
            to:to1,
        },
        function(data,status){
         // alert(data);
         document.getElementById("dislike").innerHTML="Disliked";
          document.getElementById("like").innerHTML="Like";
        }
        );
}