// global for element about to be deleted
var element = "";

$(document).ready(function () {
    action_buttons();
    toggle_category_sections();
    $('.tooltipped').tooltip({
        delay: 50
    });
});

function toggle_category_sections(){
    $(".multiple-select-dropdown li").click(function(){
        var category = $(this).find("span").text();
        category = category.replace(" ", "_").toUpperCase();
        $('#'+category).fadeToggle(400);
    });
}

function action_buttons() {
    $(".card").hover(function () {
        $(this).find(".action-btn-holder").animate({
            opacity: "1"
        });
    }, function () {
        $(this).find(".action-btn-holder").animate({
            opacity: "0"
        });
        $(this).find(".action-btn-holder").finish();
    });

    // update-btn is the recycling button located on the card
    $(".update-btn").click(function () {
        var card = $(this).closest(".card_element");
        create_editable_card(card);
        var buttons = $(this).closest(".action-btn-holder");
        replace_action_buttons(buttons, "show-submit-cancel");
    });

    // delete button is the X located on the card
    $(".delete-btn").click(function () {    
        var card = $(this).closest(".card_element");
        element = card;
        $('#deletion_modal').openModal({
            dismissible: true,
        });
    });

    $(".submit-btn").click(function () {
        var card = $(this).closest(".card_element");
        var row = $(this).closest(".card_element").attr("id");
        var name = $(card).find("#form-name").val();
        var category = $(card).find("#form-category option:selected").text();
        var description = $(card).find("#form-description").val();
        var quantity = $(card).find("#form-quantity").val();
        var available = $(card).find("#form-available").val();
        var lost = $(card).find("#form-lost").val();
        var broken = $(card).find("#form-broken").val();
        update_db(card, row, name, category, description, quantity, available, lost, broken);
        var buttons = $(this).closest(".action-btn-holder");
        replace_action_buttons(buttons, "show-update-delete");
    });

    $(".cancel-btn").click(function () {
        var card = $(this).closest(".card_element");
        replace_action_buttons(card, "show-update-delete");
        card_default(card);
    });


    // #delete is the button located on the deletion warning modal
    $("#delete").click(function () {
        delete_card(element);
    });
}


function replace_action_buttons(item, phase){
    if(phase == "show-submit-cancel"){
        $('.tooltipped').tooltip('remove');
        $(item).find(".update-btn").hide(400, function(){
            $(item).find(".submit-btn").fadeIn();
        });
        $(item).find(".delete-btn").hide(400, function(){
            $(item).find(".cancel-btn").fadeIn();
        });
    }else if(phase == "show-update-delete"){
        $('.tooltipped').tooltip('remove');
        $(item).find(".submit-btn").hide(400, function(){
            $(item).find(".update-btn").fadeIn();
        });
        $(item).find(".cancel-btn").hide(400, function(){
            $(item).find(".delete-btn").fadeIn();
        });
    }
    $('.tooltipped').tooltip({delay: 50});
}

function create_editable_card(card) {
    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE NAME FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_name = $(card).find(".editable-name").hide().html();
    var box = '<input id="form-name" value="' + curr_name + '" type="text" length="250" class="validate">';
    $(card).find(".name-field").append(box);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE CATEGORY FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_category = $(card).find(".editable-category").hide().html();
    curr_category = curr_category.replace(" ", "_").toLowerCase();
    $.ajax({
        url: "scripts/get_categories.php",
        type: "POST",
        data: {
            "CURRENT-CATEGORY": curr_category,
        },
        success: function (response) {
            var start = '<select id="form-category">';
            var options = response;
            var end = '</select>';
            var box = start + options + end;
            $(card).find(".category-field").append(box);
            $('select').material_select();
            toggle_category_sections();
        }
    });

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE DESCRIPTION FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_description = $(card).find(".editable-description").hide().html();
    box = '<textarea id="form-description" class="materialize-textarea" length="500" class="validate">'+curr_description+'</textarea>';
    $(card).find(".description-field").append(box);
    $('textarea#form-description').characterCounter();


    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE QUANTITY FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_quantity = $(card).find(".editable-quantity").hide().html();
    box = '<input id="form-quantity" value="' + curr_quantity + '" type="number" class="validate">';
    $(card).find(".quantity-field").append(box);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE AVAILABLE FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_available = $(card).find(".editable-available").hide().html();
    box = '<input id="form-available" value="' + curr_available + '" type="number" class="validate">';
    $(card).find(".available-field").append(box);


    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE LOST FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_lost = $(card).find(".editable-lost").hide().html();
    box = '<input id="form-lost" value="' + curr_lost + '" type="number" class="validate">';
    $(card).find(".lost-field").append(box);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE BROKEN FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var curr_broken = $(card).find(".editable-broken").hide().html();
    box = '<input id="form-broken" value="' + curr_broken + '" type="number" class="validate">';
    $(card).find(".broken-field").append(box);
}



function update_db(card, row, name, category, description, quantity, available, lost, broken) {
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
            card_change(card, name, category, description, quantity, available, lost, broken);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            Materialize.toast('Changes were not made', 4000);
        }
    });
}



function card_change(card, name, category, description, quantity, available, lost, broken) {
    //clear all form fields 
    $(card).find(".name-field").empty();
    $(card).find(".category-field").empty();
    $(card).find(".description-field").empty();
    $(card).find(".quantity-field").empty();
    $(card).find(".available-field").empty();
    $(card).find(".lost-field").empty();
    $(card).find(".broken-field").empty();
    //Update card to new values
    $(card).find(".editable-name").empty().append(name).fadeIn(800);
    $(card).find(".editable-category").empty().append(category).fadeIn(800);
    $(card).find(".editable-description").empty().append(description).fadeIn(800);
    $(card).find(".editable-quantity").empty().append(quantity).fadeIn(800);
    $(card).find(".editable-available").empty().append(available).fadeIn(800);
    $(card).find(".editable-lost").empty().append(lost).fadeIn(800);
    $(card).find(".editable-broken").empty().append(broken).fadeIn(800);
}

function card_default(card){
    //clear all form fields 
    $(card).find(".name-field").empty();
    $(card).find(".category-field").empty();
    $(card).find(".description-field").empty();
    $(card).find(".quantity-field").empty();
    $(card).find(".available-field").empty();
    $(card).find(".lost-field").empty();
    $(card).find(".broken-field").empty();
    //show old values 
    $(card).find(".editable-name").fadeIn(800);
    $(card).find(".editable-category").fadeIn(800);
    $(card).find(".editable-description").fadeIn(800);
    $(card).find(".editable-quantity").fadeIn(800);
    $(card).find(".editable-available").fadeIn(800);
    $(card).find(".editable-lost").fadeIn(800);
    $(card).find(".editable-broken").fadeIn(800);
}


function delete_card(card) {
    var card_number = $(card).attr("id");
    $.ajax({
        url: "scripts/delete_card.php",
        type: "POST",
        data: {
            "ITEM-ROW": card_number
        },
        success: function (response) {
            // you will get response from your php page (what you echo or print)
            $(card).remove();
            Materialize.toast(response, 4000);
            element = "";
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            Materialize.toast('Card was not deleted', 4000);
        }
    });
}