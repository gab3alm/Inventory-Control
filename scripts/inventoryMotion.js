// Item_cart is just an array to store the values of arrays.
var item_cart = [];

//|||||||||||||||||||||||||||||||||||||||||||||||||||||\
//RANDOMIZE BACKGROUND - START
//|||||||||||||||||||||||||||||||||||||||||||||||||||||\
function randomize_background() {
	var num = getRandomInt(1, 5);
	var image = "nature" + num + ".jpg";
	$('body').css({
		background: "url('../images/backgrounds/" + image + "')"
	});
}

function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min + 1) + min);
}

//|||||||||||||||||||||||||||||||||||||||||||||||||||||\
//CATEGORY SELECTION BUTTONS - START
//This is the main function being called
//It takes care of the activation of category buttons
//In charge of activation of item cart modal
//|||||||||||||||||||||||||||||||||||||||||||||||||||||\
function button_selection() {
	$(".category-bubble").click(function () {
		var selection = $(this).attr("id");
		if (selection == "selected") {
			deselect($(this));
			destroy_item_list($(this));
		} else {
			select($(this));
			create_item_list($(this));
		}
	});

	$(".checkout-container").click(function(){
		$("#checkout_modal").openModal();
		var listing = display_cart();
		$("#final_item_cart").empty().append(listing);
		$('.tooltipped').tooltip({delay: 50});
		cart_item_deletion();
	});

	$(".take_items").click(function(){
		check_out();
	});

	$(".logout").click(function(){
		logout();
	});

}

/**
 * Select |
 * Selects the given category button element, it changes its id to selected
 * and animates the button into its selected state. Changes the appearance 
 * of the selected button.
 * @param  {[category button element]}
 * @return {[void]}
 */
 function select(item) {
 	animate_button(item);
	// you have to select the two bubbles at once
	var shared_class = $(item).attr("class").split(' ')[1];
	$("."+shared_class).attr("id", "selected");
	// Looking for classes in common in order to affect both bubbles at once.
	var target = $("."+shared_class).children(":first").attr('class').split(" ")[0];
	$("."+target).css({
		background: "url('../images/success.svg')"
	});
	var target = $("."+target).children(":first").attr("class").split(" ")[0];
	$("."+target).css({
		opacity: ".2"
	});
}

/**
 * deselect | 
 * Selects the given category button element and changes its id attribute to unselected.
 * It changes the appearance of the given card element while also animating its
 * deselection
 * @param  {[button element]}
 * @return {[void]}
 */
 function deselect(item) {
 	animate_button(item);
 	var shared_class = $(item).attr("class").split(' ')[1];
 	$("."+shared_class).attr("id", "");

 	var target = $("."+shared_class).children(":first").attr('class').split(" ")[0];
 	$("."+target).css({
 		background: ""
 	});
 	
 	var target = $("."+target).children(":first").attr("class").split(" ")[0];
 	$("."+target).css({
 		opacity: "1"
 	});
 }

/**
 * animate_button |
 * simple adds the classes necessary for the animation of the given button element
 * animations are done with Animate.css library. Look into it if you have any questions.
 * @param  {[item - button element]}
 * @return {[void]}
 */
 function animate_button(item) {
 	var selector = $(item).children(":first").attr("class").split(' ')[0];
 	var specific = "."+selector;
 	$(specific).addClass("animated flip");
 	setTimeout(function () { 
 		$(specific).removeClass("animated flip");
 	}, 700);
 }

/**
 * create_item_list |
 * It changes the hidden status of the selected category item into 
 * a visible state. A complete list of the inventory is created on load
 * therefore to avoid constant loading, the entire list is hidden and 
 * only shown when its corresponding category button is clicked.
 * @param  {[selected - category button clicked]}
 * @return {[void]}
 */
 function create_item_list(selected) {
 	var category = $(selected).children(":first").children(":first").attr("id");
 	$("#"+category+"_inventory").fadeIn(500);
 }

/**
 * destroy_item_list |
 * If a category list is visible and its button is clicked again, the list 
 * is changed into its hidden state once again
 * @param  {[selected - category button clicked]}
 * @return {[void]}
 */
 function destroy_item_list(selected) {
 	var category = $(selected).children(":first").children(":first").attr("id");
 	$("#"+category+"_inventory").fadeOut(800);
 }


//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
// CARD SELECTION ANIMATION
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
/**
 * activate_card |
 * When a card element is clicked it looks into its ID attribute
 * to tell whether the card element has already been selected or not
 * and calls its corresponding function depending on the selection state
 * @return {[void]}
 */
 function activate_card(){
 	$('.card').click(function(){
 		var card = $(this);
 		var selected = $(card).attr("id");
 		if(selected == "unselected"){
 			select_card(card);			
 		}else{
 			deselect_card(card);
 		}
 		animate_card(card);
 	});
 }

/**
 * animate_card |
 * Adds animation classes used by Animate.css in order to animate 
 * the given card element.
 * @param  {[card element]}
 * @return {[void]}
 */
 function animate_card(card){
 	setTimeout(function() {
 		$(card).removeClass("animated bounce");
 	}, 1000);
 	$(card).addClass("animated bounce");
 }

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
// CARD SELECTION LOGIC
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
/**
 * select_card | 
 * When a card element is clicked, this changes the appearance of the 
 * selected card into its corresponding state. Also the function to 
 * push the selected into element into the cart is called. 
 * All selected elements are placed in a global array called item_cart
 * @param  {[card element]}
 * @return {[void]}
 */
 function select_card(card){
 	$(card).attr("id", "selected");
	// $(card).animate({background:"url('../images/success.svg')"});
	$(card).css("background-image","url('../images/success.svg')");
	$(card).css("background-size", "cover");
	$(card).css("background-position","center");
	$(card).css("background-color", "#25AE88");
	$(card).find(".card-image-container").css("opacity", ".5");
	$(card).find(".card-content").css("opacity", ".5");
	push_item_to_cart(card);
}

/**
 * push_item_to_cart |
 * selects the important information of the selected card and 
 * pushes this information into the global cart array 
 * @param  {[selected card element]}
 * @return {[void]}
 */
 function push_item_to_cart(card){
	//recording of item-id is necessary, additional data is obtained from database
	var row = $(card).attr('class').split(" ")[0].split("-")[0];
	// the structure of the array is the following, ["unique-element-id", "amount being taken by user"]
	// row applies to the row of the item in its database
	// "1" is the default since users have to take at least 1 items that they selected
	// "0" means that the item has not been returned yet |
	var item = [row, "1", "0"];
	item_cart.push(item);
	$(".checkout_items").empty().append(item_cart.length);
}

/**
 * display_cart |
 * Creates a list of the items that the user placed into their cart
 * Look into the Materialize css library to see the structure of Collections
 * @return {[void]}
 */
 function display_cart(){
 	var listing = "<ul class='collection'>";
 	for(var i = 0; i < item_cart.length; i++){
 		var item_id = "."+ item_cart[i][0] +"-item";
 		var name = $(item_id).find(".card-title").html();
 		var available = $(item_id).find(".item_available").html().split(" ")[0];
 		listing += create_cart_item(i, name, available);
 	}
 	var listing = listing + "</ul>";
 	return listing;
 }

/**
 * create_cart_item |
 * creates the <li> element that will be placed within the display_cart function
 * structure of the element is created with the materialize css framework (collections)
 * @param  {[id - unique item identifier]}
 * @param  {[name - name of the selected item]}
 * @param  {[available - max number of items that a user can take]}
 * @return {[type]}
 */
 function create_cart_item(id, name, available){
 	var list_item = `
 	<li id="`+id+`" class="collection-item"> 
 	<div class="row">
 	<div class="delete-cart-container"><img class="cart-item-delete-button tooltipped" data-position="left" data-delay="50" data-tooltip="Remove Item(coming soon)" src="../images/delete.svg"></div>
 	<div class="col s12 l5"><p class="cart-item-name">`+name+`</p></div>
 	<div class="input-field col s4 push-s4 l3">
 	<label class="active" for="amount">`+available+` Max</label>
 	<input max="`+available+`" min="1" value="1" id="`+id+`-amount" name="AMOUNT" type="number" class="validate" required>
 	</div>		
 	</div>
 	</li>
 	`;
 	return list_item;
 }

/**
 * check_out | 
 * Connects to database and stores the items that the user
 * selected into their cart
 * @return {[void]}
 * It doesn't really return a value but it closes the cart modal
 * and it opens the message about taking care of the equipment
 */
 function check_out(){
 	get_borrowed_item_amount();
 	var cart_data = JSON.stringify(item_cart);
 	$.ajax({
 		url: "../scripts/add_borrower_to_db.php",
 		type: "POST",
 		data: { 'SERIALIZED-ITEMS': cart_data},
 		success: function(response){
 			$("#checkout_modal").closeModal();
 			$("#success_modal").openModal();
			// console.log(response);
		},
		error: function (jqXHR, textStatus, errorThrown){
			// alert(errorThrown);
		}
	});
 }

/**
 * get_borrowed_item_amount |
 * It updates the amount taken if the user changed its default value of 1
 * @return {[void]}
 */
 function get_borrowed_item_amount(){
 	for(var i = 0; i < item_cart.length; i++){
 		var amount = $("#"+i+"-amount").val();
 		item_cart[i][1] = amount;
 	}
 }

/**
 * logout |
 * When the user checks their items out, they are automatically logged out
 * @return {[void]}
 */
 function logout(){
 	$.ajax({
 		url: "../scripts/logout.php",
 		success: function(response){
 			$("#success_modal").closeModal();
 			window.location.replace("user_login.php");
 		},
 		error: function (jqXHR, textStatus, errorThrown){
 			alert(errorThrown);
 		}
 	});	
 }

//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
// CARD UNSELECTION LOGIC
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
/**
 * deselect_card |
 * Changes the appearance of the given card element.
 * Calls function to pop the given item out of the item cart
 * @param  {[card element]}
 * @return {[void]}
 */
 function deselect_card(card){
 	$(card).attr("id", "unselected");
 	$(card).css("background-image","");
 	$(card).css("background-color", "");
 	$(card).find(".card-image-container").css("opacity", "1");
 	$(card).find(".card-content").css("opacity", "1");
 	pop_item_to_cart(card);
 }

/**
 * pop_item_to_cart |
 * Removes the given card element from the item cart array
 * @param  {[card element]}
 * @return {[void]}
 */
 function pop_item_to_cart(card){
	//recording of item-id is necessary, additional data is obtained from database
	var row = $(card).attr('class').split(" ")[0].split("-")[0];
	var item = [row, "1"];
	position = -1;
	for(var i = 0; i < item_cart.length; i++){
		if(item_cart[i][0] == item[0]){
			position = i;
		}
	}
	if(position != -1){
		item_cart.splice(position, 1);
		$(".checkout_items").empty().append(item_cart.length);
	}
}

/**
 * cart_item_deletion |
 * WORK IN PROGRESS 
 * Erases the <li> element that was selected
 * @return {[void]}
 */
 function cart_item_deletion(){
 	$(".collection-item").hover(function(){
 		$(this).find(".delete-cart-container").show();
 		var cart_item_id = $(this).attr("id");
 		$(this).find(".delete-cart-container").click(function(){
 			var real_id = item_cart[cart_item_id][0];
 			var target_card = $("."+real_id+"-item");
			// deselect_card(target_card);
			// $(this).find('.tooltipped').tooltip('remove');
			// var new_listing = display_cart();
			// $("#final_item_cart").empty().append(new_listing);
		});	
 	}, function(){
 		$(this).find(".delete-cart-container").hide();	
 	});
 }