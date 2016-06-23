//global element is used to store an element about to be deleted
var element = "";

$(document).ready(function(){
	$('.collapsible').collapsible();
	activate_buttons();
	toggle_category_sections();
});

function toggle_category_sections(){
	$(".dropdown-content li").click(function(){
		var category = $(this).find("span").text();
		category = category.replace(" ", "_").toUpperCase();
		$('#'+category).fadeToggle(400);
	});
}

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
		$('#deletion-warning').openModal();
		element = item;
	});

	$("#cancel-modal-deletion").click(function(){
		element = "";
	});	

	$("#commit-modal-deletion").click(function(){
		delete_item(element);
	});	

	$(".submit-btn").click(function(){
		var item = $(this).parents("li:first");
		replace_action_buttons(item, "show-update-delete");
		$(item).find(".collapsible-header").removeClass("active");	
		update_db(item);
	});

	$(".cancel-btn").click(function(){
		var item = $(this).parents("li:first");
		replace_action_buttons(item, "show-update-delete");
		$(item).find(".collapsible-header").addClass("active");
		list_item_default(item);	
	});
}

function delete_item(item){
	var row = $(item).attr("id");
	$.ajax({
		url: "scripts/delete_card.php",
		type: "POST",
		data: {
			"ITEM-ROW": row,
		},
		success: function (response) {
            // you will get response from your php page (what you echo or print)
            Materialize.toast(response, 4000);
            $(item).parents("div:first").remove();
            // loading again makes the script run twice every time you delete. 
            // The script call is duplicated every time you load (very bad)
            //$("#inventory_area").empty().load("scripts/list_inventory.php");
        },
        error: function (jqXHR, textStatus, errorThrown) {
        	console.log(textStatus, errorThrown);
        	Materialize.toast('Changes were not made', 4000);
        }
    });
	$('.tooltipped').tooltip('remove');
}

function update_db(item){
	var row = $(item).attr("id");
	var name = $(item).find("#editable-name").val();
	var category = $(item).find("#editable-category option:selected").text();
	var description = $(item).find("#editable-description").val();
	var quantity = $(item).find("#editable-quantity").val();
	var available = $(item).find("#editable-available").val();
	var lost = $(item).find("#editable-lost").val();
	var broken = $(item).find("#editable-broken").val();

	$.ajax({
		url: "scripts/edit_db.php",
		type: "POST",
		data: {
			"ITEM-ROW": row,
			"ITEM-NAME": name,
			"ITEM-CATEGORY": category,
			"ITEM-DESCRIPTION": description,
			"ITEM-QUANTITY": quantity,
			"ITEM-AVAILABLE": available,
			"ITEM-LOST": lost,
			"ITEM-BROKEN": broken,
		},
		success: function (response) {
            // you will get response from your php page (what you echo or print)
            Materialize.toast(response, 4000);
            list_item_update(item, name, category, description, quantity, available, lost, broken);
        },
        error: function (jqXHR, textStatus, errorThrown) {
        	console.log(textStatus, errorThrown);
        	Materialize.toast('Changes were not made', 4000);
        }
    });

	$('.tooltipped').tooltip('remove');
}

function list_item_update(item, name, category, description, quantity, available, lost, broken){
	$(item).find(".name-field").empty();
	$(item).find(".editable-name").empty().append(name).fadeIn(400);

	$(item).find(".category-field").empty();
	$(item).find(".editable-category").empty().append(category).fadeIn(400);

	$(item).find(".description-field").empty();
	$(item).find(".editable-description").empty().append(description).fadeIn(400);

	$(item).find(".quantity-field").empty();
	$(item).find(".editable-quantity").empty().append(quantity).fadeIn(400);

	$(item).find(".available-field").empty();
	$(item).find(".editable-available").empty().append(available).fadeIn(400);

	$(item).find(".lost-field").empty();
	$(item).find(".editable-lost").empty().append(lost).fadeIn(400);

	$(item).find(".broken-field").empty();
	$(item).find(".editable-broken").empty().append(broken).fadeIn(400);
}

function list_item_default(item){
	$(item).find(".name-field").empty();
	$(item).find(".editable-name").fadeIn(400);

	$(item).find(".category-field").empty();
	$(item).find(".editable-category").fadeIn(400);

	$(item).find(".description-field").empty();
	$(item).find(".editable-description").fadeIn(400);

	$(item).find(".quantity-field").empty();
	$(item).find(".editable-quantity").fadeIn(400);

	$(item).find(".available-field").empty();
	$(item).find(".editable-available").fadeIn(400);

	$(item).find(".lost-field").empty();
	$(item).find(".editable-lost").fadeIn(400);

	$(item).find(".broken-field").empty();
	$(item).find(".editable-broken").fadeIn(400);
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
    <input id="editable-name" value="` + curr_name + `" type="text" class="validate">
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
    $(item).find(".editable-description").hide();
    var description_field = `
    <div class="input-field col s12">
    <textarea id="editable-description" class="materialize-textarea" length="500">`+curr_description+`</textarea>
    </div>`;
    $(item).find(".description-field").append(description_field);
    $('textarea#editable-category').characterCounter();



    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE QUANTITY FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||	
    $(item).find(".editable-quantity").hide();
    var quantity_field = `
    <div class="input-field col s12">
    <input id="editable-quantity" value="`+curr_quantity+`" type="number" min="0" class="validate">
    </div>`;
    $(item).find(".quantity-field").append(quantity_field);


    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE AVAILABLE FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||	
    $(item).find(".editable-available").hide();
    var available_field = `
    <div class="input-field col s12">
    <input id="editable-available" value="`+curr_available+`" type="number" min="0" class="validate">
    </div>`;
    $(item).find(".available-field").append(available_field);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE LOST FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||	
    $(item).find(".editable-lost").hide();
    var lost_field = `
    <div class="edit-elem-container">
    <div class="input-field col s12">
    <input id="editable-lost" value="`+curr_lost+`" type="number"  min="0" class="validate">
    </div>
    </div>`;
    $(item).find(".lost-field").append(lost_field);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE BROKEN FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||	
    $(item).find(".editable-broken").hide();
    var broken_field = `
    <div class="input-field col s12">
    <input id="editable-broken" value="`+curr_broken+`" type="number" min="0" class="validate">
    </div>`;
    $(item).find(".broken-field").append(broken_field);
}