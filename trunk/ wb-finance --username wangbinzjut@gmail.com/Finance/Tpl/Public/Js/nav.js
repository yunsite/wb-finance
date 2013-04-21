$(document).ready(function() {
	
	$("dd span").click(function() {
		$("dd span").each(function(index, element) {
			//$(this).children("a").css("box-shadow", "none");
			$(this).children("a").css("background", "none");
		});
		//$(this).children("a").css("box-shadow", "0 0 3px #06C");
		$(this).children("a").css("background", "#E0EEEE");
	});
	
});
