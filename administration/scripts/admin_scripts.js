$(document).ready(function () {
	// $("#application_area").load("main_load.php");
	ajax_call("main_load", "");
	admin_operations();
});

function admin_operations() {
	$(".brand").click(function () {
		// $("#application_area").load("main_load.php");
		ajax_call("main_load", "");
		return false;
	});

	$(".current").click(function () {
		ajax_call("current|report_load", "current");	
		return false;
	});

	$(".reports").click(function () {
		ajax_call("current|report_load", "report");		
		return false;
	});

	$(".inventory").click(function () {
		ajax_call("inventory_load", "");		
		return false;
	});
}

function activate_return(){
	$(".return-button-container").click(function(){
		alert("This feature will be implemented soon!");
	});
}

function ajax_call(filename, action){
	$.ajax({
		url: "./"+filename+".php",
		type: "POST",
		data: { 'ACTION': action},
		success: function(response){
			$("#application_area").empty().append(response).hide().fadeIn(800);
			$('.tooltipped').tooltip({delay: 50});
			$(".collapsible").collapsible();
			if(action == "current"){
				activate_return();		
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert(errorThrown);
		}
	});
}