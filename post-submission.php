<?php
    echo "HELLO";
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

	$mysqli->set_charset('utf8');

    $sql_tags = "SELECT * FROM tags;";
	$results_tags = $mysqli->query($sql_tags);
	if ($results_tags == false) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}
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

        #image-preview {
            margin-top: 35px;
            display: flex;
            width: 90%;
            height: 50%;
            justify-content: center;
            align-items: center;
            background-color: rgb(255,255,255,0.2);
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            border: 2px solid rgb(255,255,255, 0.4);
            backdrop-filter: blur(15px);
        }

        #post-text {
            display: flex;
            flex-direction: column;
            width: 90%;
            height: 30%;
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

        input[type="text"], textarea, select {
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
            height: 50%;
            border-radius: 0;
            outline: none;
        }

        textarea::placeholder, #description { 
            font-size: 1em;
            font-weight: 400;
        }

        #tags {
            top: 70%;
            padding: 10px 0;
            padding-left: 15px;
            height: 30%;
            border-radius: 0 0 10px 10px;
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

     <form id="post-submission-form" action="post-confirmation.php" method="POST" enctype="multipart/form-data">
     <section id="upload-section">
        <div id="image-preview">
            <img id="image" class="img hidden" src="" alt="Image Preview">
                <input type="file" title=" " id="image-upload" accept=".jpeg, .png, .jpg" class="hidden" name="filename">
                <label id="upload-button" for="image-upload">Upload File</label>
        </div>

        <div id="post-text">
                <input type="text" name="title" id="title" placeholder="Title">
                <textarea name="description" id="description" placeholder="Type a description here..."></textarea>
                <select id="tags" name="tags-id" multiple>
                    <option value="" selected disabled>-- Select --</option>

                    <!-- PHP Output Here -->
                    <?php while( $row = $results_tags->fetch_assoc() ): ?>

                        <option value="<?php echo $row['tag_id']; ?>">
                            <?php echo $row['tags']; ?>

                        </option>

                    <?php endwhile; ?>
                </select>

                <input class="col-12 submit-btn" type="submit" value="Submit">
            </div>
        </section>
    </form>

<script>
    const inputElement = document.getElementById("image-upload");
    const previewElement = document.getElementById("image");
    const background = document.getElementById("upload-section");

    inputElement.addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file && (file.type === "image/jpeg" || file.type === "image/png")) {
        previewElement.classList.remove("hidden");
        document.querySelector("#upload-button").style.display = "none";
        const reader = new FileReader();
        reader.addEventListener("load", function() {
            background.style.backgroundImage = "url(" + reader.result + ")";
            previewElement.src = reader.result;
        });
        reader.readAsDataURL(file);
    } else {
        previewElement.classList.add("hidden");
    }
    });

    const selectTags = document.getElementById('tags');

    selectTags.addEventListener('change', () => {
    const selectedOptions = Array.from(selectTags.selectedOptions).map(option => option.value);
    console.log(selectedOptions);
    });
</script>
</body>
</html>