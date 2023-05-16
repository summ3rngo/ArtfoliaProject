<?php
    session_start(); // start the session

    if ((!isset($_POST['Email']) || trim($_POST['Email']) == '')
    && (!isset($_POST['password']) || trim($_POST['password']) == '')) {

        $error = "Please fill out all required fields.";
        header("Location: login.php");
    
    } else {
        $host = "303.itpwebdev.com";
        $user = "slngo_db_user";
        $pass = "uscitp2023";
        $db = "slngo_project_db";

        // Establish DB Connection
        $mysqli = new mysqli($host, $user, $pass, $db);

        // Check for MySQL Errors
        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }

        $password = $_POST['password'];
        $email = $_POST['Email'];

        // Retrieve the user with the matching email and password
        $sql = "SELECT * 
                FROM users 
                WHERE email='$email' AND password='$password'";
        $mysqli->set_charset('utf8');

        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }


        if ($results->num_rows > 0) {
        // User authenticated successfully
            $row = $results->fetch_assoc(); // Get the first row of the result set
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['logged_in'] = true;


            // Redirect the user to the main page
            $username = $_SESSION['username'];
            // redirect to user's page
            header("Location: main.php?username=$username");
            exit();
        } else {
        // Email and password do not match
            header("Location: login-page.php?error=1");
        }
        $mysqli->close();
    }
?>