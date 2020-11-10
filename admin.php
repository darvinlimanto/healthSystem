<?php
	session_start();

	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '1')){
			header("Location: login.php");
}	
/*
	This php file purpose is to:
	1. insert appropriate data into the database on health_risks, parameters, formulas, and 	recommendation table.
	2. Create health entry html file dynamically based on the data that admin supplied.
	3. Publish the health entry to the user side where user can choose an option and enter their own data to the health entry
*/	
?>

<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="pecss.css">
</head>
<body>
	<div class="header">
		<h1>Health Systems Application</h1>
	<h2>Add Health Entry</h2>
	</div>	
	<div class = "body">

	<?php
		/*
			Can be used to reset auto increment healthRiskID at the database
			ALTER TABLE `health_risks` AUTO_INCREMENT = 0;
			ALTER TABLE `parameters` AUTO_INCREMENT = 0;
		*/

		date_default_timezone_set('Australia/Sydney');
		$healthRiskTitle = $_POST['healthRiskTitle'];
		$formulaName = strtolower($_POST['formulaName']);
		$formulaCalc = $_POST['formulaCalc'];
		$riskName = $_POST['riskName'];
		$riskCondition = $_POST['riskCon'];
		$advice = ($_POST['advice']);
		$parameterName = $_POST['paramName'];
		$parameterUnit = $_POST['paramUnit'];
		$date = date('Y-m-d H:i:s');

		if(isset($_POST['submit'])) {
			require_once("conn2.php");
			
			if (mysqli_connect_error()) {
				die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
			} else {
				/*	Check whether similar healthRiskTitle exist*/
				/*	If it exists, return an error */
				$SELECT = "SELECT healthRiskTitle from health_risks Where healthRiskTitle = ? Limit 1";	
				
				$stmt = $conn->prepare($SELECT);
				$stmt->bind_param("s", $healthRiskTitle);
				$stmt->execute();
				$stmt->bind_result($healthRiskTitle);
				$stmt->store_result();
				$rnum = $stmt->num_rows;
				
				if ($rnum == 0) {
					$stmt->close();
				
					/*	SQL Prepared Statements*/
					/*	Tokenize Title */
					$title = $healthRiskTitle;
					$token = strtok($title, " ");				
					$temp = ""; 
					while ($token !== false){
								$temp = $temp.$token;
								$token = strtok(" ");
						}		
					$title = $temp.".html";	
					$title = strtolower($title);
					
					/*	Tokenize Formula Name*/
					$formula_Name = $formulaName;
					$token = strtok($formula_Name, " ");
					$temp = ""; 
					while ($token !== false){
								$temp = $temp.$token;
								$token = strtok(" ");
						}
					$formula_Name = $temp;


					/*	Tokenize Formula Calculation*/
					$formula_Calc = $formulaCalc;
					$token = strtok($formula_Calc, " ");		
					$temp = ""; 
					while ($token !== false){
								$temp = $temp.$token;
								$token = strtok(" ");
						}
					$formula_Calc = $temp;
					$formula_Calc = strtolower($formula_Calc);				

					/* Tokenize Risk Condition */
					$risk_Condition = $riskCondition;
					for ($i = 0; $i <= sizeof($riskName) - 1; $i++) {
						$token = strtok($risk_Condition[$i], " ");
						$temp = ""; 
						while ($token !== false){
									$temp = $temp.$token;
									$token = strtok(" ");
							}
							
						$risk_Condition[$i] = $temp;	
                    	$risk_Condition[$i] = strtolower($risk_Condition[$i]);
					}
										
					/*	Tokenize Parameters Name*/
					$parameter_Name = $parameterName;
					
					for ($i = 0; $i <= sizeof($parameterName) - 1; $i++) {
						$token = strtok($parameter_Name[$i], " ");
			
						$temp = ""; 
						while ($token !== false){
									$temp = $temp.$token;
									$token = strtok(" ");
							}	
						$parameter_Name[$i] = $temp;
						$parameter_Name[$i] = strtolower($parameter_Name[$i]);
						$parameterName[$i] = strtolower($parameterName[$i]);
					}
			
					$stringParams = "";
					$x = 0;
					foreach($parameter_Name as $param){
						$stringParams .= "\n<label for ='".$param."'>Enter ".$parameterName[$x]."</label><br><input type='number' step='any' id='".$param."' name='value[]'/>".$parameterUnit[$x]."<br>";
						$x++;
					}
					
					$varParams = "";
					$x = 0;
					foreach ($parameter_Name as $param){
						$varParams .= "\nvar ".$param." = document.getElementById('".$param."').value;";
						$x++;
					}
					
					$varParams2 = "";
					$x = 0;
					foreach ($parameter_Name as $param2){
						$varParams2 .= "\n<input type='hidden' id='parameterName' name='parameterName[]' value='".$param2."' readonly><br>";
						$x++;
					}
												
					$stringRisks = "";
					$y = 0;
					foreach($riskName as $risk){
						$stringRisks .= "\nif(".$risk_Condition[$y]."){
							document.getElementById('desc').value ='".$riskName[$y]."';
							document.getElementById('advice').innerHTML = '".$advice[$y]."';
							}";
						$y++;
					}
					
					/* Generate html file dynamically after publishing health entry */	
					$fh = fopen ($title, 'w');
					$stringData = 
					"<?php\n".
					"session_start();\n".
					"?>\n".
					"<!DOCTYPE html>\n".
					"<html>\n".
					"<head>\n".
						"<meta charset='UTF-8'>\n".
						"<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n".
						"<link rel='stylesheet' type='text/css' href='client.css'>\n".
						"<title>".$healthRiskTitle." </title>\n". 
						"<script>\n".
							"function calc".$formula_Name."() {\n".
								$varParams."\n".
								"document.getElementById('recommendation').style.display = 'inline-block';\n".
								"var ".$formula_Name." = ".$formula_Calc.";\n".
								"".$formula_Name." = (Math.round(".$formula_Name." * 100) / 100).toFixed(2);\n".
								"document.getElementById('formula').value = ".$formula_Name.";\n".
								$stringRisks.
								
								"\nvar today = new Date();\n".
								"var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();\n".
								"var time = today.getHours() + ':' + today.getMinutes();\n".
								"var dateTime = date+' '+time;\n".
								"document.getElementById('date').innerHTML = dateTime;\n".
							"\n}\n".						
						"</script>\n".
					"<body>\n".
						"<div class='header'>\n".
							"<h1>Health System Application</h1>\n".
							"<h2> ".$healthRiskTitle." </h2>\n".
						"</div>\n".
						"<form id ='clientData' action='clientData.php' method='post' >\n".
							"<h2>Enter Your Information</h2>\n".
							"<div class = 'clientContainer'>\n".
								$stringParams.
							"</div>\n".
							"<button type='button' value='Get Result' class='result' onclick='calc".$formula_Name."()'>Get Result</button>\n".
							"<hr>\n".
							"<h2>Results</h2>\n".
							"<div class = 'clientContainer'>\n".
								
								"<label for ='formula'>".$formulaName." Value</label><br>\n".
								"<input type='number' id='formula' name='formula' readonly><br>\n".
								"<label for='desc'>Description </label><br>\n".
								"<input type='text' class='desc' id='desc' name='desc' readonly>\n".
									"<h3> Result generated on: </h3>\n".
									"<p name = 'date' id='date'></p>\n".
                    			"<input type='hidden' id='healthRiskTitle' name='healthRiskTitle' value='".$healthRiskTitle."' readonly><br>\n".
								$varParams2."\n".
							"</div>\n".						
							"<div class='recommendation' id='recommendation'>\n".
							"<hr>\n".
									"<h2>Recommendations</h2>\n".
									"<p id='advice' name='advice' class='advice'> </p><br>\n".
							"</div>\n".
							"<hr>\n".
							"<a href='clientHome.php'><button id='cancel' type='button'> Cancel</button></a>\n".
							"<input type='submit' id='submit' name='submit' value='Submit'><br>\n".
						"</form>\n".
					"</body>\n".
					"</head>\n".
					"</html>\n";
					fwrite ($fh, $stringData);
					fclose ($fh);

					/*Insert SQL data using prepared statement */
					$INSERT1 = "INSERT INTO health_risks (healthRiskTitle, dateAdded) values(?, ?)";
					
					$INSERT2 = "INSERT INTO formulas (formulaName, formulaCalc, healthRiskID) values(?, ?, (select healthRiskID from health_risks where healthRiskTitle = '$healthRiskTitle'))";				
					$INSERT3 = "INSERT INTO recommendations (riskName, riskCondition, advice, healthRiskID) values(?, ?, ?, (select healthRiskID from health_risks where healthRiskTitle = '$healthRiskTitle'))";	
					
					$INSERT4 = "INSERT INTO parameters (parameterName, parameterUnit,  healthRiskID) values(?, ?, (select healthRiskID from health_risks where healthRiskTitle = '$healthRiskTitle'))";

					/*	Bind SQL values and execute */
					$stmt1 = $conn->prepare($INSERT1);
					$stmt1->bind_param("ss", $healthRiskTitle, $date);
					$stmt1->execute();
					
					$stmt2 = $conn->prepare($INSERT2);
					$stmt2->bind_param("ss", $formula_Name, $formula_Calc);
					$stmt2->execute();
					
					$stmt3 = $conn->prepare($INSERT3);
					$stmt4 = $conn->prepare($INSERT4);			
					
					for ($i = 0; $i <= sizeof($riskName) - 1; $i++) {
						$risk_Name = $riskName[$i];
						$risk_Con = $risk_Condition[$i];
						$risk_Advice = $advice[$i];
						$stmt3->bind_param("sss", $risk_Name, $risk_Con, $risk_Advice);
						$stmt3->execute();
					}
					
					for ($i = 0; $i <= sizeof($parameter_Name) - 1; $i++) {
						$para_Name = $parameter_Name[$i];
						$para_Unit = $parameterUnit[$i];
						$stmt4->bind_param("ss", $para_Name, $para_Unit);
						$stmt4->execute();
					}
					?>
						<p><?php echo "Thank you for adding health entry.";?></p>
						<a class = "homeMenu" href="adminHome.php">Back to Home</a>
					<?php
						$stmt1->close();
						$stmt2->close();
						$stmt3->close();
						$stmt4->close();
			} else {
					?>				
						<p><?php echo "Similar healh risk title has already been created. Please try other name.";?></p>
						<br>
						<a class = "homeMenu" href="adminHome.php">Back to Home</a>
			<?php
			}
			$conn->close();
		}
		} else {
			echo "All field are required";
		die();
		}
	?>
	</div>
</body>
</html>

