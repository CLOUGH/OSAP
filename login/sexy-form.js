$(function(){

	$(".sky-ninja, .kill-yourself").click(function(){
		$(".sky-ninja, .kill-yourself").removeClass("selected");
		$(this).addClass("selected");
	})
});