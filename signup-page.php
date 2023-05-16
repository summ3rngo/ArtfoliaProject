<?php
    session_start(); // start the session

    // Check if an error occurred
    $error = '';
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        $error = "User or Email already exists";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="keywords" content="Social Media, Art, Artist, Drawing, Creatives, Post, Share, Join, LogIn">
	<meta name="description" content="Social Media Website For Artists To Upload Artwork and View Other Art. This is the Registration form to become an Artfolian. ">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <title>Xpress LogIn Page</title>
    <link rel="stylesheet" href="shared.css">

    
    
    <style>
        
    html, body {
        height: 100%;
    }
        #login-container {
            width: 100%;
            height: 100%;
            background-color: black;
            display: flex;
            justify-content: center;
            height: 100vh;
            position: relative;
            overflow: hidden;

        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            width: 80%;
            height: 80%;
            display: flex;
            flex-direction: row;
            border-radius: 30px;
        }

        .image-container {
            width: 50%;
            background-image: url('img/placeholder-16.jpeg');
            background-position: center;
            background-size: cover;
            border-radius: 30px 0 0 30px;
        }

        .form-container {
            width: 50%;
            margin: 30px;
        }

        h2 {
            font-size: 2.5em;
            font-weight: 700;
            letter-spacing: 1.5px;
            background: linear-gradient(
                to right, 
                rgb(131, 69, 255),
                rgb(191, 113, 255) 50%, /* Added color stop */
                rgb(250, 158, 255)
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            
        }

        #description {
            margin-bottom: 30px;
            text-align: center;
            color: rgb(191, 113, 255)
        }
        
        form input {
            margin-bottom: 20px;
            height: 50px;
            border: none;
            background-color: rgb(250, 158, 255, 0.075);
            padding-left: 10px;
    
     
        }

        input::placeholder {
            color:  rgb(207, 144, 210);
            font-size: 1.05em;
            letter-spacing: 1.3px;
            
        }

        .login-input[type="text"], .login-input[type="email"], .login-input[type="password"], .login-input[type="submit"] {
            width: 95%;
            border-radius: 0 10px 10px 0;
        }

        .login-input[type="email"]:focus, .login-input[type="password"]:focus {
            outline: none;
    
        }

        #email-input, #password-input, #confirm-password-input, #user-input {
            border-bottom: 2px solid rgb(169, 149, 192);
        }

        .login-btn {
            background-image: 
            linear-gradient(
                to right, 
                rgb(131, 69, 255),
                rgb(191, 113, 255) 50%, /* Added color stop */
                rgb(250, 158, 255)
            );
            color: white;
            letter-spacing: 1.9px;
            font-weight: 500;
            font-size: 1.4em;
            margin-top: 15px;
            border-radius: 10px;
        }
        .login-btn:hover {
            border: 2px solid rgb(191, 113, 255);
        }

        .input-container {
            display: flex;
            
        }

        .icon {
            padding: 13px 15px 10px 15px;
            margin-bottom: 20px;
            border-bottom: 2px solid rgb(169, 149, 192);
            background-color: rgb(191, 113, 255, 0.25);
            border-radius: 10px 0 0 10px;
        }

        .form-container p {
            font-size: 0.9em;
            letter-spacing: 1.05px;
        }

        .form-container a {
            text-decoration: none;
            color: rgb(191, 113, 255);


        }

        small, .text-danger {
            margin: 0;
            padding: 0;
            font-weight: 300;
            font-size: 0.7em;
        }

        @media (max-width: 754px) { 
            .login-box {
                flex-direction: column;
                align-items: center;
                padding: 30px;
            }
            .image-container {
                display: none;
            }
            .form-container {
                width: 100%;
                margin: 0 30px 30px 30px;
            }
        }

        @media (max-width: 576px) { 
            .login-box {
                flex-direction: column;
                align-items: center;
                padding: 25px;
            }
            .image-container {
                display: none;
            }
            .form-container {
                width: 100%;
                margin: 0 30px 30px 30px;
            }
        }


    </style>
</head>
<body>
    <div id="login-container" class="container-fluid">
        <div class="login-box">
            <div class="image-container"> 
        
            </div>
            <div class="form-container">
                <h2> Artfolia Sign Up</h2>
                <p id="description"> Welcome to Artfolia! Create an account and join 
                    the art community
                </p>
                <?php if ($error != ''): ?>
                    <small class="text-danger"><?php echo $error; ?></small>
                <?php endif; ?>
                <form id="signup-form" class="row no-gutters" action="signup-confirmation.php" method="POST">
                    <small id="user-error" class="form-text text-danger"></small>
                    <div id="user-container" class="input-container">
                        <span id="user-icon" class="icon"><i class="bi bi-person"></i></span>
                        <input id="user-input" class="login-input" type="text" placeholder="Username" name="User">
                    </div>
                    <small id="email-error" class="form-text text-danger"></small>
                    <div id="email-container" class="input-container">
                        <span id="email-icon" class="icon"><i class="bi bi-envelope"></i></span>
                        <input id="email-input" class="login-input" type="email" placeholder="Email" name="Email">
                    </div>
                    <small id="password-error" class="form-text text-danger"></small>
                      <div class="input-container">
                        <span class="icon"><i class="bi bi-lock"></i></span>
                        <input id="password-input" class="login-input" type="password" name="password" placeholder="Password">
                    </div>
                    <small id="confirm-password-error" class="form-text text-danger"></small>
                      <div class="input-container">
                        <span class="icon"><i class="bi bi-lock-fill"></i></span>
                        <input id="confirm-password-input" class="login-input" type="password" name="confirm-password" placeholder="Confirm Password">
                    </div>

                    <div class="input-container">
                        <input class="col-12 login-btn" type="submit" value="Create Account">
                    </div>
                </form>
                <p> Already have an account?  <strong><a href="login-page.php"> Log In </a></strong></p>
            </div>
        </div>
    </div>
<script>
    document.querySelector("#signup-form").onsubmit = function() {
		console.log("Form Submitted")
		let validForm = true;

	// checking name //
	const username = document.querySelector("#user-input").value.trim()
	//console.log(firstName)

	if (username.length === 0) {
		validForm = false
		document.querySelector("#user-error").innerHTML = "Username cannot be empty"
	} else {
		document.querySelector("#first-name-error").innerHTML = ""
	}

	// checking email // 
	const email = document.querySelector("#email-input").value.trim()
	//console.log(email)

	if (email.length === 0) {
		validForm = false
		document.querySelector("#email-error").innerHTML = "Email cannot be empty."
	} else if (!isValidEmail(email)) {
		validForm = false
		document.querySelector("#email-error").innerHTML = "Invalid email."
	} else {
		document.querySelector("#email-error").innerHTML = ""
		}

	// checking password //
	const password = document.querySelector("#password-input").value.trim()
	//console.log(email)

	if (password.length === 0) {
		validForm = false
		document.querySelector("#password-error").innerHTML = "Password cannot be empty."
	} else if ((/\d/.test(password) && /[A-Z]/.test(password) && /[a-z]/.test(password) && /[!@#$%^&*]/.test(password)) === false) {
		validForm = false
		document.querySelector("#password-error").innerHTML = "Insecure password: number and special character included."
	} else {
		document.querySelector("#password-error").innerHTML = ""
	}

    const password_confirm = document.querySelector("#confirm-password-input").value.trim()
    if (password != password_confirm) {
        validForm = false;
        document.querySelector("#confirm-password-error").innerHTML = "Passwords don't match."
    } else {
		document.querySelector("#confirm-password-error").innerHTML = ""
	}
	//console.log(validForm)
	
	return false

}
</script>
</body>
</html>