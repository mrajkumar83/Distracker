$().ready(function() {
$( "#top-navigation li" ).bind( "click", function() {
	$("li.active").removeClass("active");
	$(this).addClass("active");
});
});