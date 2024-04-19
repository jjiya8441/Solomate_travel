<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['mail'])) {
    header("Location: index.html"); // Redirect to login page if not logged in
    exit();
}

// Retrieve user details from session
$name = $_SESSION['name'];
$mail = $_SESSION['mail'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if query is not empty
    if (!empty($_POST['query'])) {
        // Connect to the database
        $con = new mysqli("localhost", "root", "", "kp123");
        if ($con->connect_error) {
            die("Failed to Connect:" . $con->connect_error);
        } else {
            // Prepare and execute SQL query to insert the query into the database
            $query = $_POST['query'];
            $stmt = $con->prepare("INSERT INTO queries (name, mail, query) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $mail, $query);
            $stmt->execute();
            $stmt->close();
            $con->close();

            // Redirect to a thank you page or display a success message
            echo "<h2>Query submitted successfully. We'll get back to you soon!</h2>";
        }
    } else {
        echo "<h2>Please enter a query.</h2>";
    }
}
?>
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
            background-image: url('assets/images/paris2.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            height: calc(100vh - 160px); /* Full height of viewport minus navbar and footer heights */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .background-image {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black overlay */
            padding: 20px;
            text-align: center;
        }

        .background-text {
            color: white;
            font-size: 3em; /* Adjust font size as needed */
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
        .myque {
            margin-top: 20px;
            text-align: center;
        }

        .myque a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border-radius: 5px;
        }

        .myque a:hover {
            background-color: black;
            color: white;
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
            <a href="itinerary.php" class="nav-link">itinerary</a>
        </div>
        
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="background-image">
          <h3>Contact Us:</h3>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="query">Your Query:</label>
            <textarea id="query" name="query" placeholder="Write your query here..." required></textarea>
        </div>
        <div class="btn-container">
            <button type="submit">Submit</button>
        </div>
        <div class="myque">
        <a href="my_queries.php">Show Complaints</a>
    </div>
    </form>
        </div>
    </div>

    

    <!-- Footer -->
    <footer class="footer">
      <div>
        <p>Travel The World With Us</p>
        <hr>
          <address class="text">Krutarth Pandya, Jiya Jain<br>
            Karnavati University</address>
            <p class="text">KJ@gmail.com</p>
            <p class="text">123456789</p>
      </div>
      <div class="social-media-icons">
        <a href="https://www.instagram.com/krutarth_pandya_?igsh=MWozZXp3b29oc2w3bA%3D%3D&utm_source=qr"><img src="assets/images/icons/instagram.JPEG" alt="Instagram"></a>
        <a href="https://www.facebook.com"><img src="assets/images/icons/facebook.png" alt="Facebook"></a>
        <a href="https://www.linkedin.com/in/krutarth-pandya-42197a267/"><img src="assets/images/icons/linkedin.png" alt="LinkedIn"></a>
    </div>
    </footer>
</body>
</html>


