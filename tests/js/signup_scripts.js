
function getPasswordStrengthRating(pass){
	var regex_pass_lower = /[a-z]/g;
	var regex_pass_upper = /[A-Z]/g;
	var regex_pass_special = /[0-9]/g;
	var regex_pass_number = /[!@#$%^&*]/g;
	
	var passStrength = 0;
	if(pass.match(regex_pass_lower))passStrength += 1;
	if(pass.match(regex_pass_upper))passStrength += 1;
	if(pass.match(regex_pass_special))passStrength += 1;
	if(pass.match(regex_pass_number))passStrength += 1;
	
	return passStrength;
}


function getPasswordStrengthString(rating){
	if(rating <= 1) return "weak";
	else if(rating == 2) return "ok";
	else if(rating == 3) return "strong";
	else if(rating >= 4) return "very strong";
}

function getPasswordStrengthColor(rating){
	if(rating <= 1) return '#dd0004';
	else if(rating == 2) return 'orange';
	else if(rating == 3) return '#93dc5c';
	else if(rating >= 4) return 'green';
}

// function and variables used to check if the submit should be disabled or no
 
var submitButton = document.getElementById('submitButton');
var isEmailOk = false;
var isUsernameOk = false;
var isPasswordOk = false;
function checkSubmitButton(){
	if(isEmailOk && isUsernameOk && isPasswordOk){
		submitButton.removeAttribute("disabled");
	} else {
		submitButton.setAttribute("disabled", "disabled");
	}
}


// validating the email field

var emailInput = document.getElementById('emailField');
var invalidEmailText = document.getElementById('invalidEmailText');
var tooLongEmailText = document.getElementById('tooLongEmailText');

emailInput.onkeyup = function(){
	var regex_mail = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
	
	// check if email is valid
	if (emailInput.value.match(regex_mail)){
		invalidEmailText.style.display = 'none';
		isEmailOk = true;
	}
	else {
		invalidEmailText.style.display = 'block';
		isEmailOk = false;
	}
	
	// check if email is too long
	if (emailInput.value.length >= 128) {
		tooLongEmailText.style.display = 'block';
		isEmailOk = false;
	}
	else {
		tooLongEmailText.style.display = 'none';
		isEmailOk = true;
	}
	
	// check if email has an entered value
	if (emailInput.value === ""){
		invalidEmailText.style.display = 'none';
		tooLongEmailText.style.display = 'none';
		isEmailOk = false;
	}
	
	checkSubmitButton();
}


// validating the username field

var usernameField = document.getElementById('usernameField');
var invalidUsernameText = document.getElementById('invalidUsernameText');
var tooLongUsernameText = document.getElementById('tooLongUsernameText');
var tooShortUsernameText = document.getElementById('tooShortUsernameText');

usernameField.onkeyup = function(){
	var regex_username = /^[a-zA-Z0-9]+$/;
	
	// check if username is valid
	if (usernameField.value.match(regex_username)) {
		invalidUsernameText.style.display = 'none';
		isUsernameOk = true;
	}
	else {
		invalidUsernameText.style.display = 'block';
		isUsernameOk = false;
	}
	
	// check if username is too long
	if(usernameField.value.length >= 128) {
		tooLongUsernameText.style.display = 'block';
		isUsernameOk = false;
	}
	else {
		tooLongUsernameText.style.display = 'none';
		isUsernameOk = true;
	}
	
	// check if username is too short
	if(usernameField.value.length < 8) {
		tooShortUsernameText.style.display = 'block';
		isUsernameOk = false;
	}
	else {
		tooShortUsernameText.style.display = 'none';
		isUsernameOk = true;
	}
	
	// check if username has an entered value
	if(usernameField.value === "") {
		invalidUsernameText.style.display = 'none';
		tooLongUsernameText.style.display = 'none';
		tooShortUsernameText.style.display = 'none';
		isUsernameOk = false;
	}
	
	checkSubmitButton();
}

var passwordField = document.getElementById('passwordField');
var passStrengthText = document.getElementById('passStrengthText');
var tooLongPasswordText = document.getElementById('tooLongPasswordText');
var tooShortPasswordText = document.getElementById('tooShortPasswordText');

passwordField.onkeyup = function(){
	
	var passStrength = getPasswordStrengthRating(passwordField.value);
	passStrengthText.innerHTML = "Password strength: " + getPasswordStrengthString(passStrength);
	passStrengthText.style.display = 'block';
	passStrengthText.style.color = getPasswordStrengthColor(passStrength);
	
	// check if password is too long
	if(passwordField.value.length >= 128) {
		tooLongPasswordText.style.display = 'block';
		isPasswordOk = false;
	}
	else {
		tooLongPasswordText.style.display = 'none';
		isPasswordOk = true;
	}
	
	// check if password is too short
	if(passwordField.value.length < 8) {
		tooShortPasswordText.style.display = 'block';
		isPasswordOk = false;
	}
	else {
		tooShortPasswordText.style.display = 'none';
		isPasswordOk = true;
	}
	
	// check if password has an entered value
	if(passwordField.value === ""){
		passStrengthText.style.display = 'none';
		tooLongPasswordText.style.display = 'none';
		tooShortPasswordText.style.display = 'none';
		isPasswordOk = false;
	}
	
	checkSubmitButton();
}
