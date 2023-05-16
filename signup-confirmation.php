<?php 
    session_start(); // start the session

    if ((!isset($_POST['User']) || trim($_POST['User']) == '') && (!isset($_POST['Email']) || trim($_POST['Email']) == '')
    && (!isset($_POST['password']) || trim($_POST['password']) == '')) {

		$error = "Please fill out all required fields.";

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
    
        $username = $_POST['User'];
        $password = $_POST['password'];
        $email = $_POST['Email'];

        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email';";
        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        if ($results->num_rows > 0) {
            echo "Username or email already exists.";
            $mysqli->close();
            header("Location: signup-page.php?error=1");
            exit();
        }
    
        $sql = "INSERT INTO users (username, password, email)
                VALUES ('$username', '$password', '$email');";

        $mysqli->set_charset('utf8');

        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        $user_id = $mysqli->insert_id;

        $mysqli->close();

        // Set the session variables
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['logged_in'] = true;

        // Redirect the user to the main page
        header("Location: main.php?username=$username");
        exit();
    }
    
    echo "User Created"
?>
