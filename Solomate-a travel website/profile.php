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
$age = $_SESSION['age'];
$gender = $_SESSION['gender'];
$number = $_SESSION['number'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/images/profback.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Add transparency */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .details p strong {
            margin-right: 5px;
        }

        /* Highlight on hover */
        .details div:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        .btn-container a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
        }

        .btn-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile">
        <img src="assets/images/profilepic.png" alt="Profile Picture">
        <h2>Welcome, <?php echo $name; ?></h2>
    </div>
    <div class="details">
        <div>
            <p><strong>Email:</strong> <?php echo $mail; ?></p>
        </div>
        <div>
            <p><strong>Age:</strong> <?php echo $age; ?></p>
        </div>
        <div>
            <p><strong>gender:</strong> <?php echo $gender; ?></p>
        </div>
        <div>
            <p><strong>Number:</strong> <?php echo $number; ?></p>
        </div>
    </div>
    <div class="btn-container">
        <a href="index2.php">Back to Home</a>
    </div>
</div>

</body>
</html>
