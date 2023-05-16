<?php

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

	$mysqli->set_charset('utf8');

    $post_id = $_GET['post_id'];

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
    
    $sql_current_tags = "SELECT * FROM post_tags WHERE post_id = $post_id;";

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="keywords" content="Social Media, Art, Artist, Drawing, Creatives, Post, Share">
	<meta name="description" content="Social Media Website For Artists To Upload Artwork and View Other Art. This page is where you can
    submit / post a drawing or artwork using .png, .jpeg, or other picture format. The post will have a section for description, tags, etc.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <title>Post Submission Page</title>
    <link rel="stylesheet" href="shared.css">

    <style>
    
        body {
            background-color: black;
        }
        #upload-section {
            max-width: 1200px; 
            margin: 0 auto; 
            height: 1000px;
            background-image: 
            linear-gradient(
                to right, 
                rgb(131, 69, 255),
                rgb(191, 113, 255) 50%, /* Added color stop */
                rgb(250, 158, 255)
            );
            display: flex;
            position: relative;
            flex-direction: column;
            align-items: center;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        #upload-section::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(13px);
        }

        #post-text {
            display: flex;
            flex-direction: column;
            width: 90%;
            height: 50%;
            background-color: rgb(255,255,255,0.2);
            border-radius: 15px;
            margin-top: 50px;
            position: relative;
            border: 2px solid rgb(255,255,255, 0.4);
            backdrop-filter: blur(25px);
        }
       

        .hidden {
            display: none;
        }

        #upload-button {
            background-color: black;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 500;
            letter-spacing: 1.5px;
            z-index: 2;
        }

        #image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        input[type="text"], textarea {
            background-color: transparent;
        }

        input[type="text"]:focus, textarea:focus {
            outline: none;
        }

        input[type="text"]::placeholder, textarea::placeholder{
            color:rgb(244, 231, 245, 0.8);
        }

        #title {
            border-radius: 10px 10px 0 0;
            border: none;
        }

        #title, #description, #tags {
            position: absolute;
            width: 100%;
            height: 20%;
            padding-left: 15px;
            font-size: 1.2em;
            font-weight: 600;
            letter-spacing: 1.2px;
            color: white;
        }

        #description {
            top: 20%;
            padding: 10px 0;
            padding-left: 15px;
            height: 80%;
            border-radius: 0;
            outline: none;
        }

        textarea::placeholder, #description { 
            font-size: 1em;
            font-weight: 400;
        }


        .submit-btn {
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
            position: absolute;
            top: 110%;
            outline: none;
            border: 2px solid rgb(131, 69, 255);

        }
        .submit-btn:hover {
            border: 2px solid rgb(191, 113, 255);
        }

        option:focus {
            background-color: rgb(0,0,0, 0.4);
        }
        @media screen and (max-width: 768px) {
            #upload-section {
                max-width: 90%;
            }
        }

            @media screen and (min-width: 768px) and (max-width: 1024px) {
            #upload-section {
                max-width: 80%;
            }
        }

            @media screen and (min-width: 1024px) {
            #upload-section {
                max-width: 1000px;
            }
        }


        
        
    </style>
</head>
<body>
    <!-- HEADER SECTION -->
    <header>
        <nav>
         <div class="links">
             <a id="home-link" href="Homepage.html">Home</a>
             <a id="discover-link" href="Discoverpage.html">Discover</a>
         </div>
         <div class="right-links">
             <div class="profile-icon"></div>
             <a id="post-symbol" href="#">Post</a>
         </div>
        </nav>
     </header>

     <form id="post-submission-form" action="edit-post-confirmation.php" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
     <section id="upload-section">

        <div id="post-text">
                <input type="text" name="title" id="title" placeholder="<?php echo $title ?>">
                <textarea name="description" id="description" placeholder="<?php echo $description?>"></textarea>

                <input class="col-12 submit-btn" type="submit" value="Submit">
            </div>
        </section>
    </form>

<script>
    
</script>
</body>
</html>