<?php 
    session_start(); // start the session

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

        $post_id = $_POST['post_id'];
        
        $sql = "SELECT * FROM posts WHERE post_id = $post_id;";
        $results = $mysqli->query($sql);

        if ($results == false) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        $row = $results->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $filename = $row['filename'];
        $date = $row['date'];
        $filepath = $row['filepath'];

        $tags = $_POST['tags-id'];

        if (isset($_POST['title']) && trim($_POST['title']) != '') {
            $title = $_POST['title'];
        }
    
        if (isset($_POST['description']) && trim($_POST['description']) != '') {
            $description = $_POST['description'];
        } 

        $user_id = $_SESSION['user_id'];
        

        $sql_update = "UPDATE posts 
                        SET user_id = '$user_id', 
                        title = '$title', 
                        description = '$description', 
                        filename = '$filename', 
                        date = '$date', 
                        filepath = '$filepath'
                        WHERE post_id = '$post_id';";
        
        $results_update = $mysqli->multi_query($sql_update);

        if (!$results_update) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        $mysqli->close();

        // Set the session variables
        $_SESSION['post_id'] = $post_id;
        $_SESSION['logged_in'] = true;

        header("Location: main.php?username=$username");
    
?>
