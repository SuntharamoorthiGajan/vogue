<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VOGUE</title>
<script src="https://kit.fontawesome.com/72c5f1cce8.js" crossorigin="anonymous"></script>
    <style>
    	.container {
            display: flex;
            flex-wrap: wrap;
            font-size: 24px;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin-top: 10%;
        }
		* {
			box-sizing: border-box;
		}

		body {
			background: linear-gradient(to right, #ff0000  , #000000 60%);
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
			height: 100vh;
			margin: -20px 0 50px;
		}

		h1 {
			font-weight: bold;
			margin: 0;
		}

		h2 {
			text-align: center;
		}

		a {
			color: #333;
			font-size: 14px;
			text-decoration: none;
			margin: 15px 0;
			color: #000
		}
		a:hover {
		  color:#F11B3B ;
		}

		input[type="submit"] {
			border-radius: 20px;
			border: 1px solid #000;
			background-color: #000;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
			padding: 12px 45px;
			letter-spacing: 1px;
			text-transform: uppercase;
			transition: transform 80ms ease-in;
		}

		input[type="submit"].ghost {
			background-color: transparent;
			border-color: #FFFFFF;
		}
		

		form {
			background-color: #FFFFFF;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 50px;
			height: 100%;
			text-align: center;
		}
		input{
			width: 100%;
			background: transparent;
			border: 0;
			outline: 0;
			padding: 10px 15px;
		}
		textarea{
			width: 100%;
			background: transparent;
			border: 0;
			outline: 0;
			padding: 10px 15px;
		}
		.input-field{
			background: #eaeaea;
			margin: 15px 0;
			border-radius: 3px;
			display: flex;
			align-items: center;
			max-height: 65px;
			transition: max-height 0.5s;
			overflow: hidden;
		}
		
		.input-field i {
			margin-left: 15px;
			color: #999;
		}
		.container {

			background-color: #fff;
			border-radius: 10px;
		  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
					0 10px 10px rgba(0,0,0,0.22);
			position: relative;
			width: 768px;
			max-width: 100%;
			min-height: 600px;
		}

		.form-container {
			position: absolute;
			top: 0;
			height: 100%;
			transition: all 0.2s ease-in-out;
		}

		.sign-in-container {
			left: 0;
			width: 50%;
			z-index: 2;
		}

		.container.right-panel-active .sign-in-container {
			transform: translateX(100%);
		}

		.sign-up-container {
			left: 0;
			width: 50%;
			opacity: 0;
			z-index: 1;
		}

		.container.right-panel-active .sign-up-container {
			transform: translateX(100%);
			opacity: 1;
			z-index: 5;
			animation: show 0.2s;
		}

		.overlay-container {
			position: absolute;
			top: 0;
			left: 50%;
			width: 50%;
			height: 100%;
			overflow: hidden;
			transition: transform 0.6s ease-in-out;
			z-index: 100;
		}
		
		.container.right-panel-active .overlay-container{
			transform: translateX(-100%);
		}


		.overlay {
			
            background-image: url('img/red.png');
			background-repeat: no-repeat;
			background-size: cover;
			background-position: 0 0;
			color: #FFFFFF;
			position: relative;
			left: -100%;
			height: 100%;
			width: 200%;
		  	transform: translateX(0);
			transition: transform 0.2s ease-in-out;
		}

		.container.right-panel-active .overlay {
		  	transform: translateX(50%);
		}

		.overlay-panel {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 40px;
			text-align: center;		
			height: 100%;
			width: 50%;	
		}

		.overlay-right {
			right: 0;
			transform: translateX(0);
		}   
		.image-small {
		    width: 350px;
		    height: auto;
		  }
 	</style>
	<link rel="stylesheet" href="navbar.css" />
    <script>
    function checkPassword()
        {
            let pw = document.getElementById("txtPassword").value;
            let cpw = document.getElementById("txtConfimPassword").value;
            if(pw != cpw)
                {
                    alert("Password and confrim password should be the same");
                    event.preventDefault();
                }
            else
				{
					document.forms['form_01'].submit();
				}
        }
    </script>
</head>

<body>
	<div class="navbar">
	        <div class="logo">
	            <img src="img/voguelogo.png" width="100px">
	        </div>
	        <nav>
	            <ul>
					<?php if (!isset($_SESSION['user'])): ?>
						<li><a href="adminlogin.php">SIGNIN & SIGNUP</a></li>
					<?php else: ?>
						<li><a href="ProductAdd.php">ADD PRODUCT</a></li>
						<li><a href="allProduct.php">ALL PRODUCT</a></li>
						<li><a href="soldDetail.php">ORDER DETAIL</a></li>
						<li><a href="userDetail.php">USER DETAIL</a></li>
						<li><a href="adminProfile.php">PROFILE</a></li>
						<li><a href="logout.php">LOGOUT</a></li>
					<?php endif; ?>
					
	            </ul>
	        </nav>
	</div>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="adminRegistrationHandler.php" method="post" name="form_01" enctype="multipart/form-data">

			<h1>Create Account</h1>
			<div class="input-group">
				<div class="input-field">
					<i class="fa-solid fa-user"></i>		
					<input type="text" placeholder="Name" name="txtName" id = "txtName">
				</div>
				<div class="input-field">
					<i class="fa-solid fa-envelope"></i>
					<input type="email" placeholder="Email" required name="txtEmail" id="txtEmail">
				</div>
				<div class="input-field">
					<i class="fa-sharp fa-solid fa-id-badge"></i>
					<input type="file" name="imageFile" placeholder="Upload a Picture" >
				</div>
				<div class="input-field">
					<i class="fa-solid fa-key"></i>
					<input type="password" placeholder="Password" id="txtPassword" name="txtPassword" >
				</div>
				<div class="input-field">
					<i class="fa-solid fa-key"></i>
            		<input type="password" placeholder="Confirm Password" id="txtConfimPassword" name="txtConfimPassword">
            	</div>
            	<div class="input-field">
            		<i class="fa-sharp fa-solid fa-phone"></i>
            		<input type="number" placeholder="Contact Number" name="txtContactNo" id="txtContactNo" pattern="[0-9]{10}" > 
            	</div>
            	<div class="input-field">  
            		<i class="fa-solid fa-calendar-days"></i>     
            		<input type="Date" placeholder="Date Of Birth" id="txtPassword" name="txtdate">
            	</div>
            	<div class="input-field">
            		<i class="fa-solid fa-location-dot"></i>
            		<textarea placeholder="Contact Address" name="txtaddress" id="txtaddress"></textarea>
            	</div>
            </div>
			<input type="submit" value="Sign Up" name="submit" onClick="checkPassword()">
			
		</form>
        
	</div>
	<div class="form-container sign-in-container">
		<form action="adminLoginHandler.php" method="post">
			<h1>Sign in</h1>
			<div class="input-group">
				<div class="input-field">
					<i class="fa-solid fa-envelope"></i>
					<input type="email" name="txtEmail" placeholder="Email" >
				</div>
				<div class="input-field">
					<i class="fa-solid fa-key"></i>
					<input type="password" name="txtPassword" placeholder="Password" >
				</div>
			</div>
			<a href="#">Forgot your password?</a>
			<input type="submit" value="Sign In" name="btnSubmit">
            <br>
        </form>
         
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
                <input type="submit" class="ghost" id="signIn" value="Sign In">
                
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
                 <input type="submit" class="ghost" id="signUp" value="Sign Up"> 
                 
			</div>
		</div>
	</div>
</div>

<script>
    
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>
