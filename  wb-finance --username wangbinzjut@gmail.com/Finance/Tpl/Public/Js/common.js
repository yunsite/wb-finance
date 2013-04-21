$(document).ready(function() {

	$(".input_large, .input_small").focus(function() {
		$(this).css("box-shadow", "0 0 3px #06C");
	});
	$(".input_large, .input_small").blur(function() {
		$(this).css("box-shadow", "1px 1px 3px rgba(200, 200, 200, 0.2) inset");
	});
	
	$(".button").mouseover(function() {
		$(this).css("box-shadow", "0 0 3px #06C");
	});
	$(".button").mouseout(function() {
		$(this).css("box-shadow", "none");
	});
	
});
