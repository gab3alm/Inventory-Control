<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>inventory side</title>
</head>

<body>
	<link rel="stylesheet" href="../sass/inventory.css">
	<div class="container-fluid">
		<!--||||||||||||||||||||||||||||||||||-->
		<!--|||MODAL BUTTON AND ITS STRUCTURE SECTION-->
		<!--||||||||||||||||||||||||||||||||||-->
		<div class="row">
			<div class="col s12">
				<div class="right-align">
					<!--MODAL TRIGGER FOR ITEM ADDITION-->
					<img data-target="addition_modal" class="item_addition hoverable modal-trigger" src="../images/plus.svg" alt="item addition button">

					<!--||||||||||||||||||||||||||||||||||-->
					<!--|||ADDITION MODAL STRUCTURE 	  -->
					<!--||||||||||||||||||||||||||||||||||-->
					<div id="addition_modal" class="modal center-align">
						<div class="modal-content">
							<p class="modal-header">item addition</p>
							<div class="card">
								<div class="card-image waves-effect waves-block waves-light">
									<img class="item-image" src="../images/inventory/default.svg">
									<div class="divider"></div>
								</div>
								<!--ITEM NAME-->
								<div class="input-field col s12">
									<label class="addition-label" for="item-name">name</label>
									<input id="item-name" type="text" class="validate">
								</div>
								<!--ITEM CATEGORY-->
								<div class="input-field col s12">
									<select id="item-category">
										<option value="" disabled selected></option>
										<option value="audio">Audio</option>
										<option value="camera">Camera</option>
										<option value="lense">Lense</option>
										<option value="gear">Gear</option>
										<option value="lighting">Lighting</option>
										<option value="cable">Cables</option>
										<option value="card_reader">Card Readers</option>
										<option value="battery">Batteries</option>
										<option value="software">Software</option>
									</select>
									<label class="addition-label" for="item-category">category</label>
								</div>
								<!--ITEM DESCRIPTION-->
								<div class="input-field col s12">
									<label for="item-description">Description</label>
									<textarea id="item-description" class="materialize-textarea" length="500"></textarea>
								</div>
								<!--ITEM QUANTITY-->
								<div class="input-field col s12">
									<label class="addition-label" for="item-quantity">quantity</label>
									<input id="item-quantity" type="number" class="validate">
								</div>
							</div>
						</div>
						<div class="divider"></div>
						<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
							<a id="add_it" href="#!" class="modal-action waves-effect waves-green btn-flat">Add</a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--||||||||||||||||||||||||||||||||||-->
		<!--|||DEMONSTRATION FOR ITEMS IN THE INVENTORY-->
		<!--||||||||||||||||||||||||||||||||||-->
		<div class="row">
			<div class="col s12 center-align">
				<div id="inventory_area">
					<?php include("scripts/show_inventory.php"); ?>
				</div>
			</div>
		</div>







	</div>

	<script src="scripts/inventory_scripts.js"></script>
</body>

</html>