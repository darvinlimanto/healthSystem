<?php
	session_start();
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '2')){		
      header("Location: login.php");
    }
	/*
		This php file purpose is to:
		1. Show every health entry that client has submitted.
	*/

?>

<!DOCTYPE html>
<html lang ="en">
<head>
	<title> Client History Page	</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="pecss.css">
</head>
<body>
  <div class="header">
		<h1>Health System Application</h1>
		<h2> Client History Page </h2>
	</div>
	<div class = "body">
		<h2> <?php echo $_SESSION["name"];?>'s History </h2>
		<div class = "headMenu">
			<a href ="clientHome.php"><button type="button" class="history">Home</button> </a>
		</div>

<?php
				
		$clientID = $_SESSION['clientID'];
		
		require_once("conn.php");
			
		$sql = "SELECT clientHealthRiskTitle, dateTime FROM client_health_risks WHERE clientID = '$clientID' ORDER BY dateTime DESC";
		$result = $conn->query($sql);	
		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				
				$title = $row["clientHealthRiskTitle"];
			
				$token = strtok($title, " ");
				
				$temp = ""; 
				while ($token !== false){
						 $temp = $temp.$token;
							$token = strtok(" ");
					}
				$i++;
				$title = $_SESSION["name"]. $temp. $i.".php";	
				
				?>
				<a class = "historyMenu" href=<?php echo $title?>><?php echo  $row["clientHealthRiskTitle"];?></a>
				<p class = "dateTime"> <?php echo  $row["dateTime"];?></p>
				<hr>
				
				<?php
			}
		}	
		else {
				echo "You do not have any history";
			}			
		$conn->close();
?>
	</div>	
</body>
</html>


