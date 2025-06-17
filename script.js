const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const signUpMobileButton = document.getElementById('signUpMobile');
const signInMobileButton = document.getElementById('signInMobile');

// Function to add the active class
const showSignUp = (e) => {
    if (e) e.preventDefault();
	container.classList.add("right-panel-active");
};

// Function to remove the active class
const showSignIn = (e) => {
    if (e) e.preventDefault();
	container.classList.remove("right-panel-active");
};

// Event Listeners
signUpButton.addEventListener('click', showSignUp);
signInButton.addEventListener('click', showSignIn);
signUpMobileButton.addEventListener('click', showSignUp);
signInMobileButton.addEventListener('click', showSignIn);