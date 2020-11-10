<?php
		$host = "localhost";
		$dbUsername = "pa2008";
		$dbPassword = "uoPoq5EjPAVOxls";
		$dbname = "pa2008";
		
		
		/*
		$host = "localhost";
		$dbUsername = "root";
		$dbPassword = "";
		$dbname = "pa2008";
        */
		
		$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}	
?>

