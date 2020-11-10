<?php
	session_start();
	
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '1')){
			header("Location: login.php");
    }		
	/*
		This php file purpose is to:
		1. Show the previously added health entry.
		2. Health entry title that is going to be added must be unique
	*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Health Entry History Page	</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="pecss.css">
</head>
<body>
  <div class="header">
		<h1>Health System Application</h1>
		<h2> Health Entry History </h2>
	</div>
	<div class = "body">
	<h2> Created Health Entries </h2>
    	<div class = "headMenu">
			<a href ="adminHome.php"><button type="button" class="history">Home</button> </a>
		</div>

<?php
		require_once("conn.php");		
		$sql = "SELECT healthRiskTitle FROM health_risks";
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				?>
				<a class = "linkMenu" href=""><?php echo  $row["healthRiskTitle"];?></a><br>

				<?php
			}
		}	
		else {
				echo "There are no health entries";
			}
				
		$conn->close();
?>
	</div>	
</body>
</html>


