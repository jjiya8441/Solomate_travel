<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['mail'])) {
    header("Location: index.html");
    exit();
}

// Establish connection to the database
$con = new mysqli("localhost", "root", "", "kp123");
if ($con->connect_error) {
    die("Failed to connect to MySQL: " . $con->connect_error);
}

// Get current user's email
$mail = $_SESSION['mail'];

// Fetch data from visits table for the current user
$stmt = $con->prepare("SELECT * FROM visits WHERE mail = ?");
$stmt->bind_param("s", $mail);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visits</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Visits</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Visit ID</th>
                    <th>Name</th>
                    <th>Place</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output data in table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['visit_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['place'] . "</td>";
                    echo "<td><a href='delete.php?id=" . $row['visit_id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <form action="generate_pdf.php" method="post">
            <button type="submit" name="download_pdf" class="btn btn-primary">Download PDF</button>
        </form>
        <a href="index2.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>
