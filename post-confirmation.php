<?php 
    session_start(); // start the session

    if (!isset($_FILES['filename']) && $_FILES['filename']['error'] > 0) {
       echo "Please fill out all required fields.";

    } else {

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "artfolia";

        // Establish DB Connection
        $mysqli = new mysqli($host, $user, $pass, $db);

        // Check for MySQL Errors
        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }

        $filename = $_FILES['filename']['name'];
        $file_tmp = $_FILES['filename']['tmp_name'];
        $file_size = $_FILES['filename']['size'];
        $file_type = $_FILES['filename']['type'];

        // Define the destination directory and file name
        $filepath = 'img/' . $filename;
        move_uploaded_file($file_tmp, $filepath);

        $tags = $_POST['tags-id'];

        if (isset($_POST['title']) && trim($_POST['title']) != '') {
            $title = $_POST['title'];
        } else { 
            $title = "";
        }
    
        if (isset($_POST['description']) && trim($_POST['description']) != '') {
            $description = $_POST['description'];
        } else { 
            $description = "";
        }

        $user_id = $_SESSION['user_id'];
        
        $sql = "INSERT INTO posts (user_id, title, description, filename, date, filepath)
        VALUES ('$user_id', '$title', '$description', '$filename', NOW(), '$filepath');";

        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        $post_id = $mysqli->insert_id;

        if (is_array($tags)) {
            foreach ($tags as $tag) {
                $sql = "INSERT INTO post_tags (post_id, tags_id) 
                        VALUES ($post_id, $tag);";
                // execute the query
            }
        } else {
            $sql = "INSERT INTO post_tags (post_id, tags_id) 
                        VALUES ($post_id, $tags);";
        }

        $mysqli->set_charset('utf8');

        $results = $mysqli->multi_query($sql);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        $mysqli->close();


        // Set the session variables
        $_SESSION['post_id'] = $post_id;
        $_SESSION['logged_in'] = true;

       header("location: main.php");
    }
?>
