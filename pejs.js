function validateForm(form) {
	var valid = true;
	
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var email = document.getElementById('email').value;
	var pass = document.getElementById('password').value;
	var dob = document.getElementById('dob').value;
	
	
	if (fname == "") {
		document.getElementById('fname-error-1').style.display = "inline-block";
		document.getElementById('fname').style.border = "1px solid red";
		valid = false;
	}
	else {
			document.getElementById('fname-error-1').style.display = "none";
			document.getElementById('fname').style.border = "";
	}
	
	if (lname == "") {
		document.getElementById('lname-error-1').style.display = "inline-block";
		document.getElementById('lname').style.border = "1px solid red";
		valid = false;
	}
	else {
			document.getElementById('lname-error-1').style.display = "none";
			document.getElementById('lname').style.border = "";
	}
	
	if (email == "") {
		document.getElementById('email').style.border = "1px solid red";
		document.getElementById('email-error-1').style.display = "inline-block";
		valid = false;
	}
	else {
			document.getElementById('email-error-1').style.display = "none";
	}
	
	if (pass == "") {
		document.getElementById('password-error-1').style.display = "inline-block";
		document.getElementById('password').style.border = "1px solid red";
		valid = false;
	}
	else {
			document.getElementById('password-error-1').style.display = "none";
			document.getElementById('password').style.border = "";
	}
	
	if (dob == "") {
		document.getElementById('dob-error').style.display = "inline-block";
		document.getElementById('dob').style.border = "1px solid red";
		valid = false;
	}
	else {
			document.getElementById('dob-error').style.display = "none";
			document.getElementById('dob').style.border = "";
	}
	
	
	return valid;
}



function validate(element) {
	var valid = true;
	
	var emailRGEX = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
	/*
		Password must contain minimum 8 and maximum 15 characters.
		Password must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.
	*/
	var passwordRGEX = 
	/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
	
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var email = document.getElementById('email').value;
	var pass = document.getElementById('password').value;
	
	if (element.id == "fname")	{
		if (fname == "") {
			document.getElementById('fname-error-1').style.display = "inline-block";
			document.getElementById('fname').style.border = "1px solid red";
			valid = false;
		}
		else {
				document.getElementById('fname-error-1').style.display = "none";
				document.getElementById('fname').style.border = "";
		}
	}	
	if (element.id == "lname")	{
		if (lname == "") {
			document.getElementById('lname-error-1').style.display = "inline-block";
			document.getElementById('lname').style.border = "1px solid red";
			valid = false;
		}
		else {
				document.getElementById('lname-error-1').style.display = "none";
				document.getElementById('lname').style.border = "";
		}
	}
	
	if (element.id == "email") {
		if (emailRGEX.test(email)) {
			document.getElementById('email-error-1').style.display = "none"
			document.getElementById('email-error-2').style.display = "none"	
			document.getElementById('email').style.border = "";
		}
		else if (email == "") {
			document.getElementById('email-error-1').style.display = "inline-block";
			document.getElementById('email-error-2').style.display = "none"	
			document.getElementById('email').style.border = "1px solid red";
			valid = false;
		}
		else {
			document.getElementById('email-error-1').style.display = "none"
			document.getElementById('email-error-2').style.display = "inline-block";
			document.getElementById('email').style.border = "1px solid red";
			valid = false;
		}
	}
		
	
	if (element.id == "password") {
		if (passwordRGEX.test(pass)) {
			document.getElementById('password-error-2').style.display = "none"
			document.getElementById('password-error-1').style.display = "none";
			document.getElementById('password').style.border = "";
		}
		else if (pass == "") {
			document.getElementById('password-error-1').style.display = "inline-block";
			document.getElementById('password-error-2').style.display = "none"	
			document.getElementById('password').style.border = "1px solid red";
			valid = false;
		}
		else {
		document.getElementById('password-error-2').style.display = "inline-block";
		document.getElementById('password').style.border = "1px solid red";
		valid = false;
		}
	}
	return valid;
}

function clearAll() {
	document.getElementById('registerForm').reset();

}