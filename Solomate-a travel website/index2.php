<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solomate - Welcome!</title>
    <style>
        /* Reset default margin and padding */
        body, html {
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        .navbar {
            background-color: #333; /* Dark background color */
            color: white;
            padding: 20px 40px; /* Increased padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-left {
            margin-right: auto; /* Pushes the left content to the left */
        }

        .navbar-right {
            margin-left: auto; /* Pushes the right content to the right */
        }

        .nav-link {
            color: white;
            text-decoration: none;
            margin-right: 20px; /* Adjust spacing between links */
            font-size: 18px; /* Increased font size */
        }

        .logo {
            font-size: 24px; /* Adjust the font size for the logo */
            margin-right: 20px; /* Add margin to separate logo from home link */
        }

        /* Main content styles */
        .main-content {
            background-image: url('assets/images/travel.JPG'); /* Replace with your image path */
            background-size: cover;
            background-position: left;
            height: calc(100vh - 160px); /* Full height of viewport minus navbar and footer heights */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .background-image {
            padding: 20px;
            text-align: left; /* Align text to the left */
        }

        .background-text {
            color: black;
            font-size: 3em; /* Adjust font size as needed */
        }

        /* White background below the text */
        .background-overlay {
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white */
            padding: 20px; /* Adjust padding as needed */
            border-radius: 10px; /* Add rounded corners */
        }

        /* Footer styles */
        .footer {
            background-color: black;
            color: white;
            padding: 40px; /* Increased padding */
            text-align: center;
            font-size: 18px; /* Increased font size */
        }

        .social-media-icons {
            margin-top: 20px;
        }

        .social-media-icons a {
            margin-right: 10px;
            color: white;
            text-decoration: none;
        }

        /* Adjust size of social media icons */
        .social-media-icons img {
            width: 30px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <span class="logo">Solomate</span>
            <a href="index2.php" class="nav-link">Home</a>
            <a href="contact.php" class="nav-link">Contact</a>
            <a href="main.html" class="nav-link">Trip</a>
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="itinerary.php" class="nav-link">Itinerary</a>
        </div>
        <div class="navbar-right">
            
        <?php
                    session_start();
                    // Check if the user is logged in
                    if (isset($_SESSION['name'])) {
                        // User is logged in, display their name and logout link
                        echo '<span class="nav-link" style="text-shadow: 1px 1px rgb(0, 0, 0);">Hello ' . $_SESSION['name'] . '</span>';
                        echo '<a class="nav-link" style="text-shadow: 1px 1px rgb(241, 241, 241);" href="logout.php" id="logout">Log Out</a>';
                    } else {
                        // User is not logged in, display default message
                       // echo '<span class="nav-link" style="text-shadow: 1px 1px rgb(241, 241, 241);">Hello user</span>';
                    }
                    ?>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="background-image">
            <div class="background-overlay">
                <h1 class="background-text">Welcome to Solomate!</h1>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div>
        <p>Travel The World With Us</p>
      </div>
      <div class="social-media-icons">
        <a href="https://www.instagram.com/krutarth_pandya_?igsh=MWozZXp3b29oc2w3bA%3D%3D&utm_source=qr"><img src="assets/images/icons/instagram.JPEG" alt="Instagram"></a>
        <a href="https://www.facebook.com"><img src="assets/images/icons/facebook.png" alt="Facebook"></a>
        <a href="https://www.linkedin.com/in/krutarth-pandya-42197a267/"><img src="assets/images/icons/linkedin.png" alt="LinkedIn"></a>
    </div>
      <div class="social-media-icons">
        <a href="https://www.instagram.com/krutarth_pandya_?igsh=MWozZXp3b29oc2w3bA%3D%3D&utm
