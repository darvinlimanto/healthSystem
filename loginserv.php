<?php
	/*
		This php file purpose is to:
		1. Check account credentials and based on their respective role, redirect them to the correct home page.
	*/	
	
  session_start();
	require_once("conn.php");
	$error= "";
	
	if(isset($_POST['submit'])){
		if(empty($_POST['username']) || empty($_POST['password'])){
			$error = "Username or Password is Invalid";
		}
		else {
			$username = mysqli_real_escape_string($conn,$_POST['username']);
			$password = mysqli_real_escape_string($conn,$_POST['password']);
			
			$password = md5($password); 
			$sql = "SELECT * FROM clients WHERE email='$username' AND password='$password'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 1) {
				$_SESSION['username'] = $username;
				$user = mysqli_fetch_assoc($result);

        if($user['role'] == '1'){
						$_SESSION['name'] = $user['firstName'];
						$_SESSION['role'] = '1';
            header("Location: adminHome.php");
						
        }
				else{
						$_SESSION['name'] = $user['firstName'];
						$_SESSION['role'] = '2';
						$_SESSION['clientID'] = $user['clientID'];
            header("Location: clientHome.php");
        }
    } else {
			$error = "Username or Password is Invalid";
		}			
	}
	}
/* Restriction access for admin only
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '1')){
			header("Location: login.php");
    }	
		
	Restriction access for user only
	if(!isset($_SESSION['role']) || ($_SESSION['role'] != '2')){
			header("Location: login.php");
    }	
*/

?>