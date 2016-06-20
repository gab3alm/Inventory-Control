<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Testing the selection of categories</title>
</head>

<style>
	.section{
		display:none;
	}


</style>


<body>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>



	<div class="container">
		<div class="row center-align">
			<h1>testing the selection of categories</h1>
		</div>
		
		<div class="row">
			<div class="input-field col s4">
				<select id="category-selection" multiple>
					<option value="" disabled selected>Toggle Categories</option>
					<option id="audio-section" value="1">Audio</option>
					<option id="camera-section" value="2">Camera</option>
					<option id="lenses-section" value="3">Lenses</option>
				</select>
				<label for="category-selection">Select Categories</label>
			</div>
		</div>

		<div id="Audio" class="section">
			<div class="row">
				<div class="col s12">
					<h2>audio section</h2>					
				</div>
			</div>
		</div>

		<div id="Camera" class="section">
			<div class="row">
				<div class="col s12">
					<h2>camera section</h2>					
				</div>
			</div>
		</div>

		<div id="Lenses" class="section">
			<div class="row">
				<div class="col s12">
					<h2>lenses section</h2>					
				</div>
			</div>
		</div>
		
	</div>


	<script>
		$(document).ready(function() {
			$('select').material_select();
			selection();
		});

		function selection(){
			$("li").click(function(){
				var category = $(this).find("span").text();
				$('#'+category).toggle();
			});
		}
	</script>







</body>
</html>