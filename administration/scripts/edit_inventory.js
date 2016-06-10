$(document).ready(function () {
    show_action_buttons();
    initialize_actions();
    $('.tooltipped').tooltip({
        delay: 50
    });
});


function show_action_buttons() {
    $(".card").hover(function () {
        $(this).find(".btn-holder").animate({
            opacity: "1"
        });
    }, function () {
        $(this).find(".btn-holder").animate({
            opacity: "0"
        });
        $(this).find(".btn-holder").finish();
    });
}


function initialize_actions() {
    $(".update-btn").click(function () {
        create_editable_card($(this));
    });

    $(".delete-btn").click(function () {
        var card = $(this);
        $('#deletion_modal').openModal({
            dismissible: true,
        });
        $("#delete").click(function () {
            delete_card(card);
        });
    });

}


function create_editable_card(card) {
    var id = $(card).attr("id").split("-");
    var card_number = id[0];
    $('.tooltipped').tooltip('remove');
    $("#" + card_number + "-update").hide().parent().append('<img class="card-action-item submit-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Update Item" src="../images/submit.svg">').hide().fadeIn(1500);
    $("#" + card_number + "-delete").hide().parent().append('<img class="card-action-item cancel-btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel" src="../images/cancel.svg">').hide().fadeIn(1500);
    $('.tooltipped').tooltip({delay: 50});
    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE NAME FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_name_id = "#" + card_number + "-name";
    var current_name = $(card_name_id).html();
    var box = '<input id="editable-name" value="' + current_name + '" type="text" length="250" class="validate">';
    $(card_name_id).empty().append(box);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE CATEGORY FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_category_id = "#" + card_number + "-category";
    var current_category = $(card_category_id).html();
    $.ajax({
        url: "scripts/get_categories.php",
        success: function (response) {
            var start = '<select id="editable-category" value="' + current_category + '"  selected>';
            var options = response;
            var end = '</select>';
            var box = start + options + end;
            $(card_category_id).empty().append(box);
            $('select').material_select();
        }
    });

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE DESCRIPTION FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_description_id = "#" + card_number + "-description";
    var current_description = $(card_description_id).html();
    var box = '<textarea id="editable-description" class="materialize-textarea" length="500" class="validate"></textarea>';
    $(card_description_id).empty().append(box);
    $('textarea#editable-description').characterCounter();
    $('textarea#editable-description').val(current_description);


    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE QUANTITY FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_quantity_id = "#" + card_number + "-quantity";
    var current_quantity = $(card_quantity_id).html();
    var box = '<input id="editable-quantity" value="' + current_quantity + '" type="number" class="validate">';
    $(card_quantity_id).empty().append(box);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE AVAILABLE FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_available_id = "#" + card_number + "-available";
    var current_available = $(card_available_id).html();
    var box = '<input id="editable-available" value="' + current_available + '" type="number" class="validate">';
    $(card_available_id).empty().append(box);


    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE LOST FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_lost_id = "#" + card_number + "-lost";
    var current_lost = $(card_lost_id).html();
    var box = '<input id="editable-lost" value="' + current_lost + '" type="number" class="validate">';
    $(card_lost_id).empty().append(box);

    //||||||||||||||||||||||||||||||||||||||||||||||
    //|||CREATE THE EDITABLE BROKEN FIELD
    //||||||||||||||||||||||||||||||||||||||||||||||
    var card_broken_id = "#" + card_number + "-broken";
    var current_broken = $(card_broken_id).html();
    var box = '<input id="editable-broken" value="' + current_broken + '" type="number" class="validate">';
    $(card_broken_id).empty().append(box);


    $(".submit-btn").click(function () {
        var row = card_number;
        var name = $("#editable-name").val();
        var category = $("#editable-category option:selected").text();
        var description = $("#editable-description").val();
        var quantity = $("#editable-quantity").val();
        var available = $("#editable-available").val();
        var lost = $("#editable-lost").val();
        var broken = $("#editable-broken").val();
        update_db(row, name, category, description, quantity, available, lost, broken);
        $('.tooltipped').tooltip('remove');
    });

    $(".cancel-btn").click(function () {
        card_default(card_number, current_name, current_category, current_description, current_quantity, current_available, current_lost, current_broken);
        $('.tooltipped').tooltip('remove');
    });
}



function update_db(row, name, category, description, quantity, available, lost, broken) {
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
            card_default(row, name, category, description, quantity, available, lost, broken);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            Materialize.toast('Changes were not made', 4000);
        }
    });
}



function card_default(id, name, category, description, quantity, available, lost, broken) {
    //    <p id="' + id + '-name" class="item-data">' + name + '</p>
    $("#" + id + "-name").empty().append('<span id="' + id + '-name" class="card-title">' + name + '</span>').hide().fadeIn();
    $("#" + id + "-category").empty().append('<p id="' + id + '-category" class="item-data">' + category + '</p>').hide().fadeIn();
    $("#" + id + "-description").empty().append('<p id="' + id + '-description" class="item-data">' + description + '</p>').hide().fadeIn();
    $("#" + id + "-quantity").empty().append('<p id="' + id + '-quantity" class="item-data">' + quantity + '</p>').hide().fadeIn();
    $("#" + id + "-available").empty().append('<p id="' + id + '-available" class="item-data">' + available + '</p>').hide().fadeIn();
    $("#" + id + "-lost").empty().append('<p id="' + id + '-lost" class="item-data">' + lost + '</p>').hide().fadeIn();
    $("#" + id + "-broken").empty().append('<p id="' + id + '-broken" class="item-data">' + broken + '</p>').hide().fadeIn();

    $(".submit-btn").hide().parent().find("#" + id + "-update").fadeIn();
    $(".cancel-btn").hide().parent().find("#" + id + "-delete").fadeIn();
    $("#inventory_area").empty().load("scripts/show_inventory.php");
}


function delete_card(card) {
    var id = $(card).attr("id").split("-");
    var card_number = id[0];
    $.ajax({
        url: "scripts/delete_card.php",
        type: "POST",
        data: {
            "ITEM-ROW": card_number
        },
        success: function (response) {
            // you will get response from your php page (what you echo or print)
            //Materialize.toast(response, 4000);
            $("#inventory_area").empty().load("scripts/show_inventory.php");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            Materialize.toast('Card was not deleted', 4000);
        }
    });
}