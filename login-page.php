<?php
    session_start(); // start the session

    // Check if an error occurred
    $error = '';
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        $error = "Email and Password do not match";
    } else if (isset($_GET['error']) && $_GET['error'] == 2) {
        $error = "Must be logged in to access main page.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="keywords" content="Social Media, Art, Artist, Drawing, Creatives, Post, Share, Join, LogIn">
	<meta name="description" content="Social Media Website For Artists To Upload Artwork and View Other Art. Logging In">
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
            margin-bottom: 100px;
            text-align: center;
            
        }

        
        form input {
            margin-bottom: 20px;
            height: 50px;
            border: none;
            background-color: rgb(246, 238, 255, 0.4);
            padding-left: 10px;
    
     
        }

        input::placeholder {
            color:  rgb(169, 149, 192);
            font-size: 1.05em;
            letter-spacing: 1.3px;
            
        }

        .login-input[type="email"], .login-input[type="password"], .login-input[type="submit"] {
            width: 95%;
            border-radius: 0 10px 10px 0;
        }

        .login-input[type="email"]:focus, .login-input[type="password"]:focus {
            outline: none;
    
        }

        #email-input, #password-input {
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
            font-size: 1.4;
            margin-top: 50px;
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
            background-color: rgba(208, 188, 236, 0.4);
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
            font-size: 0.9em;
            margin-bottom: 10px;
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
                <h2> Artfolia Log In</h2>
                <form id="login-form" class="row no-gutters" action="login-confirmation.php" method="POST">

                <?php if ($error != ''): ?>
                    <small class="text-danger"><?php echo $error; ?></small>
                <?php endif; ?>
                    <small id="email-error" class="form-text text-danger"></small>
                    <div id="email-container" class="input-container">
                        <span id="email-icon" class="icon"><i class="bi bi-envelope"></i></span>
                        <input id="email-input" class="login-input" type="email" placeholder="Email" name="Email">
                      </div>
                      <small id="password-error" class="form-text text-danger"></small>
                      <div class="input-container">
                        <span class="icon"><i class="bi bi-lock"></i></span>
                        <input id="password-input" class="login-input" type="password" id="password" name="password" placeholder="Password">
                      </div>

                    <div class="input-container">
                        <input class="col-12 login-btn" type="submit" value="Log In">
                    </div>
                </form>
                <p> Become an Artfolier  <strong><a href="signup-page.php"> Join Artfolia </a></strong></p>
            </div>
        </div>
    </div>
<script>
    document.querySelector("#login-form").onsubmit = function() {
		console.log("Form Submitted")
		let validForm = true;

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
	} else {
		document.querySelector("#password-error").innerHTML = ""
	}

    return false;

}
</script>
</body>
</html>