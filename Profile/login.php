<!DOCTYPE html>
<html5 lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0">
	<title>Ecorise Quest 🍀</title> <!-- Title of the webpage -->
    <!-- Linking the Font Awesome library for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
	<!-- Linking an external CSS file named "style1.css" -->
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <!-- SIGN UP SECTION -->
    <div class="container" id="signup" style="display: none ;"> <!-- Container for sign-up form (initially hidden) -->
        <h1 class="form-title">Create an Account</h1> <!-- Heading for the sign-up form -->
        <p style="color: #63327f; padding-top: 15px; padding-bottom: 45px;">Let's get started!</p> <!-- Paragraph encouraging users to sign up -->
        <form method="POST" action="register.php"> <!-- Form for user sign-up, submits to "register.php" -->
            <div class="input-group"> <!-- Input group for user's full name -->
                <input type="text" name="name" placeholder="Name" required/>
                <label for="name">Full Name</label> <!-- Label for the input field -->
            </div>  
            <div class="input-group"> <!-- Input group for user's email -->
                <input type="email" name="email" placeholder="Email" required />
                <label for="email">Email</label> <!-- Label for the input field -->
            </div>
            <div class="input-group"> <!-- Input group for user's password -->
                <input type="password" name="password" placeholder="Password" />
                <label for="password">Password</label> <!-- Label for the input field -->
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp"> <!-- Submit button for sign-up form -->
        </form>
        <p class="extras">
            ------------------------------------------ <!-- Separator line -->
        </p>
        <div class="icons"> <!-- Container for social login icons -->
            <a href="google-oauth.php"><i class="fab fa-google"></i></a> <!-- Google login icon -->
            <a href="fb.php"><i class="fab fa-facebook"></i></a> <!-- Facebook login icon -->
        </div>
        <div class="links"> <!-- Container for sign-in link -->
            <p>Already registered?</p> <!-- Text indicating user is already registered -->
            <button id="signInButton">Sign in</button> <!-- Button to navigate to sign-in section -->
        </div>
    </div>
   
    <br>
    <!------------------------------------------------------------------->
    <!-- SIGN IN SECTION -->
    <div class="container" id="signIn" style="margin-top: -0.8rem ;"> <!-- Container for sign-in form (initially hidden) -->
        <h1 class="form-title">Sign into your account</h1> <!-- Heading for the sign-in form -->
        <p style="color: #63327f; padding-top: 15px;padding-bottom: 45px;">To get started!</p> <!-- Paragraph encouraging users to sign in -->
        <form method="POST" action="register.php"> <!-- Form for user sign-in, submits to "register.php" -->
            <div class="input-group"> <!-- Input group for user's email -->
                <input type="email" name="email" placeholder="Email" required />
                <label for="email">Email</label> <!-- Label for the input field -->
            </div>
            <div class="input-group"> <!-- Input group for user's password -->
                <input type="password" name="password" placeholder="Password" />
                <label for="password">Password</label>
            </div>
            <p class="recover">
                Forgot password?  <a href="#">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn"> <!-- Submit button for sign-in form -->
        </form>
        <p class="extras">
            ----------------------------------------- <!-- Separator line -->
        </p>
        <div class="icons"> <!-- Container for social login icons -->
            <a href="google-oauth.php"><i class="fab fa-google"></i></a> <!-- Google login icon -->
            <a href="fb.php"><i class="fab fa-facebook"></i></a> 
        </div>
        <div class="links">
            <p>Don't have an account yet?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>
   
    <div class="right" id="signInRight">
        <p class="txt">Ready to take on eco-friendly challenges?
            <br>Log in to Ecorise Quest and join our community of sustainability champions!</p>
        <img src="images/bg2.jpg" alt="Background image">
    </div>
   
    <br>
    
    <!-- Including JavaScript file -->
    <script src="javascripts/script.js"></script>
</body>
</html5>