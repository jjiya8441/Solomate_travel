<?php
session_start();
require('fpdf186/fpdf.php'); // Update the path to match your directory structure

if (isset($_POST['download_pdf'])) {
    // Establish connection to the database
    $con = new mysqli("localhost", "root", "", "kp123");
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }

    // Get current user's email
    $mail = $_SESSION['mail'];

    // Fetch user's name from the database
    $stmt_user = $con->prepare("SELECT name FROM visits WHERE mail = ?");
    $stmt_user->bind_param("s", $mail);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $row_user = $result_user->fetch_assoc();
    $userName = $row_user['name'];

    // Fetch data from visits table for the current user
    $stmt = $con->prepare("SELECT * FROM visits WHERE mail = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, $userName, 0, 1, 'C'); // Add user's name at the top
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Places to Visit', 0, 1, 'C'); // Add title for the list
    $pdf->Ln(5); // Add some space between the title and the list
    $pdf->SetFont('Arial', '', 12);

    // Add data to PDF as an indexed list
    $index = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $index . '.', 0, 0, 'C');
        $pdf->Cell(50, 10, $row['place'], 0, 1);
        $index++;
    }

    // Output PDF
    $pdf->Output('D', 'itinerary.pdf');

    // Clear out table entries based on visit ID
    $stmt_delete = $con->prepare("DELETE FROM visits WHERE mail = ?");
    $stmt_delete->bind_param("s", $mail);
    $stmt_delete->execute();

    // Stop script execution after generating PDF
    exit();
}
?>
