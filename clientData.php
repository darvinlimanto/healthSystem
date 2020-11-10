<?php
	session_start();
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '2')){		
      header("Location: login.php");
    }
	/*
		This php file purpose is to:
		1. insert appropriate data into the client_health_risks and client_health_risk_parameters table.
		2. Intended to store parameter value in order to show history for each client. (incomplete)
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
		<h1>Health System Application</h1>
		<h2> Client Data Entry </h2>
	</div>
	<div class = "body">

<?php
	/*
		Can be used to reset auto increment healthRiskID at the database
		ALTER TABLE `health_risks` AUTO_INCREMENT = 0;
		ALTER TABLE `parameters` AUTO_INCREMENT = 0;
		ALTER TABLE `client_health_risks` AUTO_INCREMENT = 0;
	*/ 
	date_default_timezone_set('Australia/Sydney');
	$username = $_SESSION["username"];
	$healthRiskTitle = $_POST['healthRiskTitle'];
	$parameterValue = $_POST['value'];
	$parameterName = $_POST['parameterName'];	
	$date = date('Y-m-d');
	
if(isset($_POST['submit'])) {
	require_once("conn2.php");
		
		if (mysqli_connect_error()) {
			die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
		} else {
			$sql = "select clientID from clients where email = '$username'";
			
			
			$result = $conn->query($sql);
			$clientID = "";
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$clientID = $row["clientID"];
				}
			}		
			
			$INSERT1 = "INSERT INTO client_health_risks (dateTime, clientHealthRiskTitle, clientID, healthRiskID) values(?, ?, ?, (select healthRiskID from health_risks where healthRiskTitle = '$healthRiskTitle'))";

			$INSERT2 = "INSERT INTO client_health_risk_parameters (parameterName, parameterValue, clientHealthRisksID) values(?, ?, (select clientHealthRisksID from client_health_risks where clientHealthRiskTitle = '$healthRiskTitle' AND clientID = '$clientID' AND dateTime = '$date'))";
										
			$stmt1 = $conn->prepare($INSERT1);	
			$stmt1->bind_param("ssi", $date, $healthRiskTitle, $clientID);
			$stmt1->execute();
			
			$stmt2 = $conn->prepare($INSERT2);			
			for ($i = 0; $i <= sizeof($parameterName) - 1; $i++) {
				$parameter_Name = $parameterName[$i];
				$parameter_Value = $parameterValue[$i];
				$stmt2->bind_param("sd", $parameter_Name, $parameter_Value);
				$stmt2->execute();
			}
			?>
					<p><?php echo "Thank you for inputting your data entry.";?></p>
					<a class = "homeMenu" href="clientHome.php">Back to Home</a>
				<?php
				$stmt1->close();
				$stmt2->close();
     } 
			 ?>				
					
		<?php
     
     $conn->close();
    }
 else {
	echo "All field are required";
 die();
}
?>
	</div>
</body>
</html>

