$(document).ready(function () {
	// $("#application_area").load("main_load.php");
	ajax_call("main_load", "");
	admin_operations();
	animate_avatar();
});

function animate_avatar(){
	$(".admin_avatar").addClass("animated bounce");
	setTimeout(function(){
		$(".admin_avatar").removeClass("animated bounce");
	}, 1500);
}

function admin_operations() {
	$(".brand").click(function () {
		// $("#application_area").load("main_load.php");
		ajax_call("main_load", "");
		$("#inventory_views").fadeOut();		
		return false;
	});

	$("#user_logout").click(function(){
		$.ajax({
			url: "../scripts/logout.php",
			success: function(response){
				window.location.replace("../public");
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(errorThrown);
			}
		});
	});

	$(".current").click(function () {
		$(".current").css("border-bottom","1px solid rgba(255,255,255,.75)");
		$(".reports").css("border-bottom","1px solid rgba(255,255,255,0)");
		$(".inventory").css("border-bottom","1px solid rgba(255,255,255,0)");
		ajax_call("current|report_load", "current");	
		$("#inventory_views").fadeOut();		
		return false;
	});

	$(".reports").click(function () {
		$(".current").css("border-bottom","1px solid rgba(255,255,255,0)");
		$(".reports").css("border-bottom","1px solid rgba(255,255,255,1)");
		$(".inventory").css("border-bottom","1px solid rgba(255,255,255,0)");
		ajax_call("current|report_load", "report");		
		$("#inventory_views").fadeOut();		
		return false;
	});

	$(".inventory").click(function () {
		$(".current").css("border-bottom","1px solid rgba(255,255,255,0)");
		$(".reports").css("border-bottom","1px solid rgba(255,255,255,0)");
		$(".inventory").css("border-bottom","1px solid rgba(255,255,255,1)");

		ajax_call("card_inventory_load", "");
		$("#inventory_views").fadeIn(1000);
		$(".card_view").css("border-bottom","1px solid rgba(255,255,255,.5)");	

		$(".card_view").click(function(){
			$(".card_view").css("border-bottom","1px solid rgba(255,255,255,.5)");
			$(".list_view").css("border-bottom","1px solid rgba(255,255,255,0)");			
			ajax_call("card_inventory_load", "");
		});

		$(".list_view").click(function(){
			$(".card_view").css("border-bottom","1px solid rgba(255,255,255,0)");
			$(".list_view").css("border-bottom","1px solid rgba(255,255,255,.5)");			
			ajax_call("list_inventory_load", "");
		});

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