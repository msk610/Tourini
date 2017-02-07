$("#username").focus(function(){
	$("#icon-person").css({"background-color":"#2a2a2a"});
});

$("#password").focus(function(){
	$("#icon-key").css({"background-color":"#2a2a2a"});
});

$("#username").focusout(function(){
	$("#icon-person").css({"background-color":"#4c4c4c"});
});

$("#password").focusout(function(){
	$("#icon-key").css({"background-color":"#4c4c4c"});
});

$("#signupButton").click(function(){
	$("body").addClass("fadeOutLeft");
	$("body").addClass("animated");
	$("body").css({
		"-webkit-animation-delay": "0s", 
		"animation-delay": "0s"
	});

	setTimeout(function(){
		window.location.href = "signup.html";
	},500);
});