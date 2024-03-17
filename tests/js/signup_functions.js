
function isEmailValid (emailString){
	var regex_mail = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
	if (emailString.match(regex_mail)) return true;
	else return false;
}

function isUsernameValid (usernameString){
	var regex_username = /^[a-zA-Z0-9]+$/;
	if (usernameString.match(regex_username)) return true;
	else return false;
}

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
	if(rating <= 1) return 'weak';
	else if(rating == 2) return 'ok';
	else if(rating == 3) return 'strong';
	else if(rating >= 4) return 'very strong';
}

function getPasswordStrengthColor(rating){
	if(rating <= 1) return '#dd0004';
	else if(rating == 2) return 'orange';
	else if(rating == 3) return '#93dc5c';
	else if(rating >= 4) return 'green';
}

module.exports = { 
	isEmailValid,
	isUsernameValid,
	getPasswordStrengthRating,
	getPasswordStrengthString,
	getPasswordStrengthColor
};