
const { 
	isEmailValid,
	isUsernameValid,
	getPasswordStrengthRating,
	getPasswordStrengthString,
	getPasswordStrengthColor
} = require('./signup_functions');


// email validation tests
test('Test if a correct email is recognised', () => {
	expect(isEmailValid('example@test.com')).toEqual(true);
	expect(isEmailValid('a@b.c')).toEqual(true);
});

test('Test if a wrong email is rejected', () => {
	expect(isEmailValid('word')).toEqual(false);
});

test('Test if an email without an address is rejected', () => {
	expect(isEmailValid('@abv.bg')).toEqual(false);
});

test('Test if an email without an @ is rejected', () => {
	expect(isEmailValid('123.test.com')).toEqual(false);
});

test('Test if an email without a dot is rejected', () => {
	expect(isEmailValid('email@test')).toEqual(false);
});

test('Test if an only a @ and a dot is rejected', () => {
	expect(isEmailValid('@.')).toEqual(false);
});


// username validation tests

test('Test if a normal username is accepted', () => {
	expect(isUsernameValid('ivan')).toEqual(true);
});

test('Test if a username with capital letters is accepted', () => {
	expect(isUsernameValid('IvaN')).toEqual(true);
});

test('Test if a username with numbers letters is accepted', () => {
	expect(isUsernameValid('ivan123')).toEqual(true);
});

test('Test if a username with capital letters and numbers is accepted', () => {
	expect(isUsernameValid('ivan123ASD')).toEqual(true);
});

test('Test if a username with only capital letters is accepted', () => {
	expect(isUsernameValid('IVAN')).toEqual(true);
});

test('Test if a username with only numbers is accepted', () => {
	expect(isUsernameValid('123123')).toEqual(true);
});

test('Test if the empty string is rejected', () => {
	expect(isUsernameValid('')).toEqual(false);
});

test('Test if a username with an invalid character _ is rejected', () => {
	expect(isUsernameValid('ivan_123')).toEqual(false);
});

test('Test if a username with an invalid character *  is rejected', () => {
	expect(isUsernameValid('ivan123**')).toEqual(false);
});

test('Test if a username with multiple invalid characters is rejected', () => {
	expect(isUsernameValid('ivan_123##&')).toEqual(false);
});

test('Test if a username with only invalid characters is rejected', () => {
	expect(isUsernameValid('!@#$%^&*')).toEqual(false);
});



// test password rating
test('Password with only lowercase should be 1', () => {
	expect(getPasswordStrengthRating('pass')).toEqual(1);
});

test('Password with only uppercase should be 1', () => {
	expect(getPasswordStrengthRating('PASS')).toEqual(1);
});

test('Password with only specials should be 1', () => {
	expect(getPasswordStrengthRating('!@#$')).toEqual(1);
});

test('Password with only numbers should be 1', () => {
	expect(getPasswordStrengthRating('1234')).toEqual(1);
});

test('Password with 2 types of characters should be 2 ', () => {
	expect(getPasswordStrengthRating('pass123')).toEqual(2);
	expect(getPasswordStrengthRating('passPASS')).toEqual(2);
	expect(getPasswordStrengthRating('pass!!!!')).toEqual(2);
	expect(getPasswordStrengthRating('PASS123')).toEqual(2);
	expect(getPasswordStrengthRating('PASS###')).toEqual(2);
	expect(getPasswordStrengthRating('123$$$')).toEqual(2);
});

test('Password with 3 types of characters should be 3 ', () => {
	expect(getPasswordStrengthRating('pass123$$$')).toEqual(3);
	expect(getPasswordStrengthRating('pass123PASS')).toEqual(3);
	expect(getPasswordStrengthRating('passPASS###')).toEqual(3);
	expect(getPasswordStrengthRating('PASS123%%%')).toEqual(3);
});

test('Password with 4 types of characters should be 4 ', () => {
	expect(getPasswordStrengthRating('pass123$$$PASS')).toEqual(4);
});


// test pass strength string
test('password with strength 1 is weak', () => {
	expect(getPasswordStrengthString(1)).toEqual('weak');
});

test('password with strength 2 is ok', () => {
	expect(getPasswordStrengthString(2)).toEqual('ok');
});

test('password with strength 3 is strong', () => {
	expect(getPasswordStrengthString(3)).toEqual('strong');
});

test('password with strength 4 is very strong', () => {
	expect(getPasswordStrengthString(4)).toEqual('very strong');
});

test('password with strength more than 4 is very strong', () => {
	expect(getPasswordStrengthString(10)).toEqual('very strong');
});

test('password with strength less than 1 is weak', () => {
	expect(getPasswordStrengthString(-10)).toEqual('weak');
});


// test pass strength color
test('password with strength 1 is red', () => {
	expect(getPasswordStrengthColor(1)).toEqual('#dd0004');
});

test('password with strength 2 is orange', () => {
	expect(getPasswordStrengthColor(2)).toEqual('orange');
});

test('password with strength 3 is light green', () => {
	expect(getPasswordStrengthColor(3)).toEqual('#93dc5c');
});

test('password with strength 4 is green', () => {
	expect(getPasswordStrengthColor(4)).toEqual('green');
});

test('password with strength more than 4 is green', () => {
	expect(getPasswordStrengthColor(10)).toEqual('green');
});

test('password with strength less than 1 is red', () => {
	expect(getPasswordStrengthColor(-10)).toEqual('#dd0004');
});