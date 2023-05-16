<?php
     session_start();
     
     if (isset($_SESSION['username'])) {
         $username = $_SESSION['username'];
         $user_id = $_SESSION['user_id'];
         //echo "WELCOME $username and $user_id";

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

        $sql = "SELECT * 
                FROM posts 
                WHERE user_id = $user_id";
        $mysqli->set_charset('utf8');
        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }
     } else {
         // User is not logged in, redirect to login page
         header("Location: login-page.php?error=2");
         exit();
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="keywords" content="Social Media, Art, Artist, Drawing, Creatives, Post, Share">
	<meta name="description" content="Social Media Website For Artists To Upload Artwork and View Other Art">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <title>Xpress Main Page </title>
    <link rel="stylesheet" href="shared.css">

    <style>

        #header-section {
            height: 250px;
            background-image: linear-gradient(
                to right, 
                rgb(131, 69, 255),
                rgb(191, 113, 255) 50%,
                rgb(250, 158, 255)
            );
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #header-section h2 {
            position: absolute;
            position: absolute;
            left: 140px; /* width of profile icon + left margin + padding + desired space between */
            top: 43%;
            transform: translateY(-50%);
        }

        #profile-icon {
            width: 85px;
            height: 85px;
            background-color: white;
            left: 30px;
            position: absolute;
            transform: translateY(-50%);
            overflow: hidden;
            display: flex;
            justify-content: center;
            border: 3px solid black
            
        }

        #profile-icon img {
            width: 100%;
            height: auto;
            object-fit: cover;
            object-position: center;
        }

        #header-section h4 {
            position: absolute;
            left: 140px; /* width of profile icon + left margin + padding + desired space between */
            top: 59%;
            transform: translateY(-50%);
            position: absolute;
        }

        #about-me {
            background-color: black;
            height: 90%;
            width: 50%;
            position: absolute;
            right: 30px;
            border-radius: 10px; background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            color: #fff;
            max-width: 600px;
            padding: 30px;
            border: 2px solid rgba(255,255,255,0.6);
        }

        #about-me::before {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            content: '';
            position: absolute;
            top: -10px;
            bottom: -10px;
            left: -10px;
            right: -10px;
            z-index: -1;
        }

        #about-me:focus {
            outline: none;
        }

        #feed {
            min-height: 500px;
            background-color: black;
        }

        #feed-nav {
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }

        #feed-nav a {
            text-decoration: none;
            color: white;
            padding: 15px 80px 11px 80px;
            font-size: 0.9em;
            font-weight: 600;
            
        }

        .icon {
            font-size: 25px;
            color: white;
        }

        .tab.active {
            border-bottom: 2px solid white;
            margin-top: 2px;
        }

        .content {
            margin-top: 50px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .box {
            margin: 15px;
            height: 300px;
            position: relative;
            
        }

        .overlay-text {
            font-size: 20px;
            display: flex;
            flex-direction: row;
            position: absolute;
            transition: opacity 0.3s ease-in;
            opacity: 0;
        }

        .likes {
            display: flex;
            flex-direction: row;
            margin-right: 10px;
        }
        
        .comments {
            display: flex;
            flex-direction: row;
        }


        .box:hover .overlay-text {
            opacity: 1;
            transition: opacity 0.3s ease-in;
        }

        .icons {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: flex;
        }

        .icons a {
            color: white;
            z-index: 2;
    
        }

        .delete-icon, .update-icon {
            margin-left: 10px;
        }

        .icons a i {
            font-size: 24px;
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
             <a id="logout-btn" href="logout.php">Logout</a>
         </div>
         <div class="right-links">
            <a id="account" href="main.php"><div class="profile-icon"></div></a>
            <a id="post-symbol" href="post-submission.php">Post</a>
         </div>
        </nav>
     </header>

     <section id="header-section" class="container-fluid">
        <div id="left-side">
            <h2> <?php echo $username ?> </h2>
            <div id="profile-icon"><img src="img/pfp-placeholder.jpeg" alt="Profile Icon"></div>
            <h4> 100 Followers | 100 Following </h4>
        </div>
        <textarea id="about-me">About Me... </textarea>
     </section>

    <!-- FEED / YOUR POSTS -->
     <section id="feed">
        <nav id="feed-nav">
            <a class="tab active" href="#"><i class="bi bi-columns-gap icon"></i></a>
            <a class="tab" href="#"><i class="bi bi-heart icon"></i></a>
            <a class="tab" href="#"><i class="bi bi-bookmark icon"></i></a>
        </nav>

        <div class="content">
            <div class="tab-content active" id="posts">
              <!-- content for the "Posts" tab goes here -->
              <div class="row no-gutters">
              <?php 
              while ($row = $results->fetch_assoc()) {
                $post_id = $row['post_id'];
                $title = $row['title'];
                $description = $row['description'];
                $filepath = $row['filepath'];
                $user_id = $row['user_id'];
                $date = $row['date'];

                // Generate HTML code for this post
                
                $post_html = '<div class="col-lg-3 col-md-4 col-sm-4 col-6">';
                $post_html .= '<div class="box">';
                $post_html .= '<img class="img" src="' . $filepath . '" alt="' . $title . '">';
                $post_html .= '<div class=overlay-text>';
                $post_html .= '<div class="likes"><i class="bi bi-heart-fill"></i><p> 100 </p></div>';
                $post_html .= '<div class="comments"><i class="bi bi-chat-fill"></i><p> 100 </p></div>';
                $post_html .= '</div>';
                $post_html .= '<div class="icons">';
                $post_html .= '<a href="edit-post.php?post_id=' . $post_id . '&username=' . $username . '" class="update-icon"><i class="bi bi-pencil-square"></i></a>';
                $post_html .= '<a href="delete.php?post_id=' . $post_id . '&username=' . $username . '" 
                                class="delete-icon" onclick="return confirm(\'Are you sure you want to delete this track?\');">
                                <i class="bi bi-trash"></i></a>';
                $post_html .= '</div>';
                $post_html .= '</div>';
                $post_html .= '</div>';

                // Output HTML for this post
                echo $post_html;
            }
            ?>
            </div>
            <div class="tab-content" id="liked">
              <!-- content for the "Liked" tab goes here -->
            </div>
            <div class="tab-content" id="saved">
                <!-- content for the "Saved" tab goes here -->
            </div>
        </div>
     </section>
 
    <!-- FOOTER -->
     <footer>
        <div class="footer-container">
            <div class="logo">
  
            </div>
            <div class="footer-wrapper">
            <div class="links">
              <ul>
                <li><a href="Homepage.html">About</a></li>
                <li><a href="Discoverpage.html">Discover</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>
          

                <p> &copy; 2023 Summer Ngo </p>
            </div>
        </div>
      </footer>

<script>
const tabs = document.querySelectorAll('.tab');
const tabContents = document.querySelectorAll('.tab-content');

tabs.forEach((tab, index) => {
  tab.addEventListener('click', (e) => {
    e.preventDefault();
    tabs.forEach((tab) => tab.classList.remove('active'));
    tab.classList.add('active');
    tabContents.forEach((tabContent) => tabContent.classList.remove('active'));
    tabContents[index].classList.add('active');
  });
});
</script>
</body>
</html>