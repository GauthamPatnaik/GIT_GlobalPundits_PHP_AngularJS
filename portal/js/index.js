function prepareDynamicDates() {
  $('time.loaded').attr("datetime", new Date().toISOString());
}
function empStatusTime() {
  $('#empStatusTime').attr("datetime", new Date().toISOString());
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
var userid = getCookie("userid");
var session_key = getCookie("session_key");

if (userid == "" || session_key == "") {
  window.location.replace('https://login.globalpundits.com/login.php');
}

$(document).ready(function(e) {
  
  function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
              c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return false;
  }
  function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

	var side_pane_var = 0;
  if (getCookie('smenu')) {
    side_pane_var = getCookie('smenu');
  } else {
    setCookie('smenu', side_pane_var, 30);
  }
  
  if (side_pane_var == 1) {
    $(".side-pane").css('width', '0px');
    $(".side-pane-fixed").css('margin-left', '-220px');
  } else {
    $(".side-pane").css('width', '220px');
    $(".side-pane-fixed").css('margin-left', '0px');
  }
  
	$("#side-pane-button").click(function(){
    side_pane_var == getCookie('smenu');
		if (side_pane_var == 0) {
			$(".side-pane").css('width', '0px');
			$(".side-pane-fixed").css('margin-left', '-220px');
			
			side_pane_var = 1;
      setCookie('smenu', side_pane_var, 30);
		} else {
			$(".side-pane").css('width', '220px');
			$(".side-pane-fixed").css('margin-left', '0px');
			
			side_pane_var = 0;
      setCookie('smenu', side_pane_var, 30);
		}
	});
});