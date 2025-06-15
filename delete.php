<?php
    session_start();
	// exit();

	// Check to make sure track_id is provided.
	if ( !isset($_GET['post_id']) || trim($_GET['post_id']) == '' ) {
		// Missing track_id;
		$error = "Invalid URL.";
	} else {

		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "artfolia";

		// Establish MySQL Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);

		// Check for any Connection Errors.
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$sql = "DELETE FROM posts
				WHERE post_id = " . $_GET['post_id'] . ";";


		// echo "<hr>$sql<hr>";

		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

        $sql = "DELETE FROM post_tags
				WHERE post_id = " . $_GET['post_id'] . ";";


		// echo "<hr>$sql<hr>";

		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();

        header("Location: main.php?username=$username");
        exit();
		

	}

?>