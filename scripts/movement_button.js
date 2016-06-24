$(document).ready(function () {
	next();
	previous();
});

function next() {
	$('.next-custom').click(function () {
		$(".application-wrapper").animate({
			left: "-100%"
		}, 800, function(){
			$(".next-custom-stage2").css("position","fixed");
			$(".prev-custom-stage2").css("position","fixed");
		});
	});

	$('.next-custom-stage2').click(function () {
		$(".application-wrapper").animate({
			left: "-100%"
		}, 800);
	});
}

function previous() {
	$('.prev-custom-stage2').click(function () {
		$(".next-custom-stage2").css("position","absolute");
		$(".prev-custom-stage2").css("position","absolute");
		$(".application-wrapper").animate({
			left: "0%"
		}, 800);
	});

	$('.prev-custom-stage3').click(function () {
		$(".application-wrapper").animate({
			left: "0%"
		}, 800);
	});
}