$(document).ready(function(){
	$("#btnCreatePost").on("click", function(e){

var update = $("#post").val();

// AJAX CALL NAAR ajax/save_tweet.php
var request = $.ajax({
  url: "ajax/save_tweet.php",
  type: "POST",
  data: {update : update}, //$_POST['update'] 
  dataType: "json"
});
 
request.done(function(msg) {
  if(msg.status == "success")
  {
  var li = '<li style="display:none;" class="clearfix">'+
'<img class="avatar" src="images/avatar.jpg">'+
'<p>'+update+' <span>just now</span></p>'+
'</li>';

$("#tweets ul").prepend(li);
$("#tweets ul li").first().slideDown();
  }
  else
  {

  }
});
 
request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
});

console.log(update);
e.preventDefault(); //return false
});
});