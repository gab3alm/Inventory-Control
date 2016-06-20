<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>List inventory view</title>

</head>
<body>
	<link rel="stylesheet" href="../sass/admin_list_inventory.css">

	<div class="row">
		<div class="col s4">
			<div class="input-field col s12">
				<select multiple id="category-dropdown">
					<option value="" disabled selected>Available Categories</option>
					<script>
						$.ajax({
							type: "POST",
							url: "./scripts/get_categories.php",
							data: {'CURRENT-CATEGORY': ""},
							success: function(response){
								$("#category-dropdown").append(response);
								$('select').material_select();
								$('.item-category-section').hide();
							},
							error: function(jqXHR, textStatus, errorThrown){
								console.log(errorThrown);
							}
						});
					</script>
				</select>
				<label>Active Categories</label>
			</div>
		</div>
	</div>


	<!--||||||||||||||||||||||||||||||||||-->
	<!--|||MODAL STRUCTURES				  -->
	<!--||||||||||||||||||||||||||||||||||-->



	<!-- DELETION WARNING MODAL -->
	<div id="deletion-warning" class="modal">
		<div class="modal-content">
			<div class="row">
				<h4 class="deletion-warning">are you sure you want to delete this item?</h4>
			</div>
			<p class="deletion-message">This deletion is permanent</p>
		</div>
		<div class="modal-footer">
			<a href="#!" id="cancel-modal-deletion" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
			<a href="#!" id="commit-modal-deletion" class=" modal-action modal-close waves-effect waves-green btn-flat">Delete</a>
		</div>
	</div>









	<!--||||||||||||||||||||||||||||||||||-->
	<!--|||DEMONSTRATION FOR ITEMS IN THE INVENTORY-->
	<!--||||||||||||||||||||||||||||||||||-->
	<div class="row">
		<div id="inventory_area" class="inventory_area">
			<script>
				$("#inventory_area").load("scripts/list_inventory.php");
			</script>
		</div>
	</div>








	<script src="./scripts/list_inventory_addition.js"></script>




</body>
</html>