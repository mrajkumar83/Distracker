$().ready(function() {
$( "#middle #left-column ul.nav li a" ).bind( "click", function() {
	$("li.leftMenuActive").removeClass("leftMenuActive");
	$(this).parent().addClass("leftMenuActive");
});
});