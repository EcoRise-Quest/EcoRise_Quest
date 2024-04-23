// Get reference to the sign-up and sign-in buttons and forms
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

// Add event listener to the sign-up button
signUpButton.addEventListener('click', function(){
    // Hide the sign-in form and display the sign-up form
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
});

// Add event listener to the sign-in button
signInButton.addEventListener('click', function(){
    // Hide the sign-up form and display the sign-in form
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});
