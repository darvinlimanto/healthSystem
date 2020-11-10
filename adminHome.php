<?php
	session_start();
	
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '1')){
			header("Location: login.php");
    }
	/*
		This php file purpose is to:
		1. show the home page for the admin panel.
		2. Home page will contain menu for adding health entry, health entry history, and logging out.
	*/		
?>

<!DOCTYPE html>
<html lang="en">
   <head>
  		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="pecss.css">
			<title>Admin Home Page</title>
   </head>
   <body>
      <div class="header">
         <h1>Health Systems Application</h1>
         <h2>Admin Home Page</h2>
      </div>
      <div class = "body">
						<h2> Welcome, administrator! </h2>
						<br>
						<a href="adminEntry.php"><button type="button">Add Health Entry</button> </a>		 
						<a href="adminHistory.php"><button type="button">Health Entry History</button></a>		
						<a href="logout.php"><button type="button" href="">Log Out</button></a>   					
						<br>
			</div>
	</body>
</html>
	 