<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['mail'])) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Establish connection to the database
    $con = new mysqli("localhost", "root", "", "kp123");
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }

    // Get visit_id from URL parameter
    $visit_id = $_GET['id'];

    // Prepare and execute SQL query to delete the place
    $stmt = $con->prepare("DELETE FROM visits WHERE visit_id = ?");
    $stmt->bind_param("i", $visit_id);
    if ($stmt->execute()) {
        // Place deleted successfully
        header("Location: visits.php");
        exit();
    } else {
        // Error occurred while deleting place
        echo "Error deleting place.";
    }
} else {
    // Redirect to visits.php if visit_id is not provided
    header("Location: visits.php");
    exit();
}
?>
