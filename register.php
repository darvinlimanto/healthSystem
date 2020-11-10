<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Registration Page	</title>
	<link rel="stylesheet" type="text/css" href="pecss.css">
</head>
<body>
  <div class="header">
		<h1>Health System Application</h1>
		<h2> Registration Page </h2>
	</div>
	<div class = "body">

<?php
	/*
		This php file purpose is to:
		1. insert registered user data into the clients table.
		2. User that has been registered later can access user part of the Health System Application.
	*/
	date_default_timezone_set('Australia/Sydney');
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$dob = $_POST["dob"];	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = md5($password); 
	
	if(isset($_POST['submit'])) {
		require_once("conn2.php");
		
		if (mysqli_connect_error()) {
			die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
		} else {
			$SELECT = "SELECT email from clients Where email = ? Limit 1";
			$INSERT = "INSERT Into clients (firstName, lastName, gender, dob, email, password, dateJoined) values(?, ?, ?, ?, ?, ?, NOW() )";
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();
			$rnum = $stmt->num_rows;
		 
			if ($rnum==0) {
				$stmt->close();
				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("ssssss", $fname, $lname, $gender, $dob, $email, $password);
				$stmt->execute();
				?>
				<p><?php echo "Thank you for registering.";?> </p>
				<a class = "homeMenu" href="login.php">Please click here to login!</a>
				<?php
     } else {
			 ?>
				<p><?php echo "Email is already taken. Please try another.";?></p>
			<?php
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>