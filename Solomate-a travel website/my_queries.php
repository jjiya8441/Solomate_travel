<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['mail'])) {
    header("Location: index.html"); // Redirect to login page if not logged in
    exit();
}

// Retrieve user details from session
$mail = $_SESSION['mail'];

// Connect to the database
$con = new mysqli("localhost", "root", "", "kp123");
if ($con->connect_error) {
    die("Failed to Connect:" . $con->connect_error);
}

// Fetch queries for the logged-in user
$stmt = $con->prepare("SELECT query_id, query FROM queries WHERE mail = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$result = $stmt->get_result();

// Delete query if requested
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $query_id = $_POST['delete'];
    $delete_stmt = $con->prepare("DELETE FROM queries WHERE query_id = ?");
    $delete_stmt->bind_param("i", $query_id);
    $delete_stmt->execute();
    $delete_stmt->close();
    // Redirect to refresh the page after deletion
    header("Location: my_queries.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Queries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/images/myqueries.webp') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Add transparency */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .query {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .query:hover {
            background-color: #f0f0f0;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }

        .return-btn {
            margin-top: 20px;
            text-align: center;
        }

        .return-btn a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border-radius: 5px;
        }

        .return-btn a:hover {
            background-color: black;
            color:white
        }
    </style>
</head>
<body>

<div class="container">
    <h2>My Queries</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="query">';
            echo '<p>' . $row['query'] . '</p>';
            echo '<form method="post">';
            echo '<input type="hidden" name="delete" value="' . $row['query_id'] . '">';
            echo '<button class="delete-btn" type="submit">Delete</button>';
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo '<p>No queries found.</p>';
    }
    ?>
     <div class="return-btn">
        <a href="index2.php">Return to Home</a>
    </div>
</div>

</body>
</html>
