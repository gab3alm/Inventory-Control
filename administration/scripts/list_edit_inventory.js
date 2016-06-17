$(document).ready(function(){
	$('.collapsible').collapsible();
	activate_buttons();
});

function activate_buttons(){
	$(".list-item-container").hover(function(){
		$('.tooltipped').tooltip({delay: 50});
		$(this).find(".action-btn-holder").fadeIn();
	}, function(){
		$(this).find(".action-btn-holder").fadeOut(400, function(){
			$('.tooltipped').tooltip('remove');
		});
		$(this).find(".action-btn-holder").finish();
	});

	$(".update-btn").click(function(){
		var item = $(this).parents("li:first");
		$(item).find(".collapsible-header").removeClass("active");	
		create_editable_item(item);
	});

	$(".delete-btn").click(function(){
		var item = $(this).parents("li:first");
		$(item).find(".collapsible-header").removeClass("active");	
	});

	$(".submit-btn").click(function(){
		var item = $(this).parents("li:first");
		replace_action_buttons(item, "show-update-delete");
		$(item).find(".collapsible-header").removeClass("active");	
	});

	$(".cancel-btn").click(function(){
		var item = $(this).parents("li:first");
		replace_action_buttons(item, "show-update-delete");
		$(item).find(".collapsible-header").addClass("active");	
	});
}

function replace_action_buttons(item, phase){
	if(phase == "show-submit-cancel"){
		$(item).find(".update-btn").hide(400, function(){
			$(item).find(".submit-btn").fadeIn();
		});
		$(item).find(".delete-btn").hide(400, function(){
			$(item).find(".cancel-btn").fadeIn();
		});
	}else if(phase == "show-update-delete"){
		$(item).find(".submit-btn").hide(400, function(){
			$(item).find(".update-btn").fadeIn();
		});
		$(item).find(".cancel-btn").hide(400, function(){
			$(item).find(".delete-btn").fadeIn();
		});
	}
}


function create_editable_item(item){
	$(item).find(".collapsible-header").removeClass("active");	
	replace_action_buttons(item, "show-submit-cancel");
	// GET CURRENT DATA IN ITEM - SEE list_inventory.php for item structure
	var curr_name = $(item).find(".editable-name").html(); 
	var curr_category = $(item).find(".editable-category").html(); 
	// var image = $(item).find(".editable-image").html(); 
	var curr_description = $(item).find(".editable-description").html(); 
	var curr_quantity = $(item).find(".editable-quantity").html();
	var curr_available = $(item).find(".editable-available").html(); 
	var curr_lost = $(item).find(".editable-lost").html(); 
	var curr_broken = $(item).find(".editable-broken").html();


	//||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATING EDITABLE NAME FIELD -- SEE list_inventory.php to understand structure
    //||||||||||||||||||||||||||||||||||||||||||||||
    $(item).find(".editable-name").hide();
    var name_field = `
    <div class="input-field col s12">
    <input value="` + curr_name + `" name="ITEM-NAME" type="text" class="validate">
    </div>`;
    $(item).find(".name-field").append(name_field);


	//||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE CATEGORY FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    $(item).find(".editable-category").hide();
    $.ajax({
    	url: "scripts/get_categories.php",
    	type: "POST",
    	data: {
    		"CURRENT-CATEGORY": curr_category,
    	},
    	success: function (response) {
    		var start = '<div class="input-field col s12"><select id="editable-category">';
    		var options = response;
    		var end = '</select></div>';
    		var box = start + options + end;
    		$(item).find(".category-field").append(box);
    		$('select').material_select();
    	}
    });

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE DESCRIPTION FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||




}