<?php
	session_start();
	
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '2')){		
      header("Location: login.php");
    }
	/*
		This php file purpose is to:
		1. Show client home page.
		2. Client can choose one health entry so advice can be generated.
	*/
?>

<!DOCTYPE html>
<html lang ="en">
<head>
<title> Client Home Page	</title>
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="pecss.css">
</head>
<body>
  <div class="header">
		<h1>Health System Application</h1>
		<h2> Client Home Page </h2>
	</div>
	<div class = "body">
		<div class = "headMenu">
			<h2> Welcome, <?php echo $_SESSION["name"];?></h2>
			<a href ="clientHistory.php"><button type="button" class="history">My History</button> </a>
			<a href ="logout.php"><button type="button" class="logout">Log Out</button></a>
		</div>
		<hr>
		<h2> Please select an entry from the list! </h2>
<?php
			require_once("conn.php");
			
		$sql = "SELECT healthRiskTitle FROM health_risks";
		$result = $conn->query($sql);	
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$title = $row["healthRiskTitle"];
			
				$token = strtok($title, " ");
				
				$temp = ""; 
				while ($token !== false){
						 $temp = $temp.$token;
							$token = strtok(" ");
					}
					
				$title = $temp.".html";
				$title = strtolower($title);
				?>
				<a class = "linkMenu" href=<?php echo $title?>><?php echo  $row["healthRiskTitle"];?></a><br>
				<?php
			}
		}	
		else {
				echo "0 results";
			}
				
		$conn->close();
?>
	</div>	
</body>
</html>


