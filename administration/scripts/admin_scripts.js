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
	$(".btn").click(function(){
		var max = $(this).attr('class').split(" ")[0];
		var request_num = $(this).attr("id");
		var form_id = "#item_return_"+request_num;
		var form_data = $(form_id).serialize();
		console.log(form_data);
		$.ajax({
			type: "POST",
			url: "./scripts/return_items_db.php",
			data: {'encoded_items': form_data, "items_max": max, "borrower_id":request_num},
			success: function(response){
				console.log(response);
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(errorThrown);
			}
		});
		return false;
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