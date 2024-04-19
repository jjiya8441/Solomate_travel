<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['mail'])) {
        // If user is not logged in, redirect them to the login page
        header("Location: index.html");
        exit();
    }

    $mail = $_SESSION['mail'];

    // Collect the place from the form
    $place = $_POST['place'];

    // Establish connection to the database
    $con = new mysqli("localhost", "root", "", "kp123");
    if ($con->connect_error) {
        die("Failed to Connect:" . $con->connect_error);
    } else {
        // Prepare and execute SQL query to insert data into the visits table
        $stmt = $con->prepare("INSERT INTO visits (name, mail, place) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $mail, $place);
        $name = $_SESSION['name'];
        if ($stmt->execute()) {
            // Visit saved successfully
            echo "<script>alert('Visit saved successfully!');</script>";
        } else {
            // Error occurred while saving visit
            echo "<script>alert('Error saving visit. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('assets/images/itback.webp');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .container {
            margin-top: 100px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Plan Your Itinerary</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="place">Place:</label>
                <input type="text" class="form-control" id="place" name="place" placeholder="Enter the place" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Visit</button>
        </form>
        <a href="index2.php" class="btn btn-secondary mt-3">Back to Home</a>
        <a href="main.html" class="btn btn-secondary mt-3">Back to Trip</a>
        <a href="visits.php" class="btn btn-secondary mt-3">Show Itinerary</a>
    </div>
</body>
</html>
