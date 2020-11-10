<?php
	include("loginserv.php"); 
	/*
		This php file purpose is to:
		1. show login page functionality.
		2. use loginserv for checking username and password
	*/
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="pecss.css">
</head>

<body>
	<div class="header">
		<h1>Health Systems Application</h1>
		<h2>Login Account</h2>
  </div>
	<div class="login">
		<form action="" method="post" style="text-align:center;">
		<h1>Enter Login Details</h1>
		<input type="text" placeholder="Please Enter Username" id="username" name="username"><br><br>
		<input type="password" placeholder="Please Enter Password" id="password" name="password"><br>
		<p class='login-error'><?php echo $error; ?></p>
		
	<input type="submit" id="submit" value="Login" name="submit">
	<br><br>
	No account? <a href="registration.html">Register</a> now.

</body>
</html>