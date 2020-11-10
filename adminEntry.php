<?php
	session_start();

	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '1')){
			header("Location: login.php");
}		
/*
	This php file purpose is to:
	1. Publish health entry to the user.
	2. Health entry need to be supplied with title, parameter name and unit, formula name and calculation, risk name, risk condition and advice.
	3. health entry title must be unique.
	4. Both parameters and risks part can be to added to maximum 10 entries.
*/	
?>

<!DOCTYPE html>
<html lang ="en">
<head>
	<title>Add Health Entry</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="pecss.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		var i = 1;
		
		$(document).ready(function() {
			var max_fields = 10;
			var wrapper = $(".parameterElements");
			var add_button = $(".add_form_field");
			var msg = "Please enter valid format"
			var x = 1;
			$(add_button).click(function(e) {
				e.preventDefault();
				if (x < max_fields) {
						x++;
						$(wrapper).append('<div><button type="button" class="delete" id="removeButton">X</button><input type="text" id="paramName'+ i +'" name="paramName[]"  oninput="setCustomValidity("")" required /> <input type="text" class = "paramUnit" id="paramUnit'+ i +'" name="paramUnit[]"  /> </div>'); //add input box
								
						i++;
				} else {
					document.getElementById('para-error').style.display = "inline-block";
					}
			});
		$(wrapper).on("click", ".delete", function(e) {
			e.preventDefault();
			$(this).parent('div').remove();
			x--;
			})
		});
	</script>
	<script>
	var j = 1;
	$(document).ready(function() {
	var max_fields = 10;
	var wrapper = $(".riskElements");
	var add_button = $(".add_form_field2");

	var x = 1;
	$(add_button).click(function(e) {
			e.preventDefault();
		if (x < max_fields) {
				x++;
				$(wrapper).append('<div><button type="button" class="delete" id="removeButton">X</button><input type="text" id="riskName'+ j +'" name="riskName[]"/> <input type="text" id="riskCon'+ j +'" name="riskCon[]"/> <textarea class = "advice" id="advice'+ j +'" name="advice[]"></textarea> </div>');
						
				j++;
			} else {
				document.getElementById('risk-error').style.display = "inline-block";
		}
	});

	$(wrapper).on("click", ".delete", function(e) {
			e.preventDefault();
		$(this).parent('div').remove();
			x--;
	})
	});

	function clearAll() {
		document.getElementById('adminForm').reset();
	}
	</script>
</head>
<body>
	<div class="header">
		<h1>Health Systems Application</h1>
		<h2>Add Health Entry</h2>
	</div>	
	<form id ="adminForm" action="admin.php" method="post" >
		<h2> Entry Title </h2>
		<h4>Disease Name</h4>
		<input type ="text" name="healthRiskTitle" id="healthRiskTitle" placeholder="Input Disease Name" pattern="[a-zA-Z0-9\s]{3,100}" oninvalid="this.setCustomValidity('Please enter minimum 3 and 100 alphanumeric characters')" oninput="setCustomValidity('')" required />
		<br>
		<div class ="parameterElements">
						<hr>
						<h2> Parameters </h2>
			<h4> Add Parameter Name & Units</h4>
						<br>
						<button class="add_form_field" type="button" id="addParameter">Add New Parameter &nbsp; + </button>
						<span class="error-messages" id="para-error">*You can only add to maximum 10 parameters </span>
						<input type="text" placeholder="Input Parameter Name" name="paramName[]" id="paramName" required />
						<input type="text" placeholder="Input Parameter Units" class = "paramUnit" name="paramUnit[]" id="paramUnit" required /> 
		</div>
		<div>
						<hr>
						<h2> Formula </h2>
        <h4>Input Formula Name & Formula Calculation</h4>
       		<div class="tooltip">HELP?
				<span class="tooltiptext">
                	<div class = 'body2'>
					<p> Allowed Formula Operations: </p>
					<p> '+' For addition || '-' For substraction </p>
					<p> '/' For division || '*' For multiplication </p>
					<p> Parenthesis() is allowed. </p>
                	</div>
				</span>
			</div><br><br>
			<input type="text" placeholder="Input Formula Name" name="formulaName" id="formulaName" pattern="[a-zA-Z0-9\s]{2,25}" oninvalid="this.setCustomValidity('Please enter minimum 2 and 25 alphanumeric characters')" oninput="setCustomValidity('')" required />
						<textarea class="formulaCalc" placeholder="Input Formula Calculation" class="formulaCalc" name="formulaCalc" id="formulaCalc" required></textarea>

		</div>
		<br>
					<div class="riskElements">
						<hr>
						<h2> Risks </h2>
			<h4>Define Risks, Conditions & Recommendations</h4>
							<br>
							<button class="add_form_field2" type="button" id="addRisk">Add New Risk &nbsp; +</button>
							<span class="error-messages" id="risk-error">*You can only add to maximum 10 risks  </span>
							<input type="text" placeholder="Input Risk Name" name="riskName[]" id="riskName" required />
							<input type="text" placeholder="Input Risk Conditions" name="riskCon[]" id="riskCon" required />
							<textarea class="advice" placeholder="Input Recommendations"  name="advice[]" id="advice" required></textarea>
							<br>
					</div>	
						<input type="submit" name= "submit" value="Publish" id="submit">
	</form>
	<div class = 'body'>
		<a href='adminHome.php'><button id='cancel'>Cancel</button></a>
		<input type="reset" id="reset" class="registerbtn" value="Reset" onclick="clearAll()">
		<br>
	</div>	
</body>
</html>
	