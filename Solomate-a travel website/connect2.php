<?php
session_start();

$mail = $_POST['mail'];
$password = $_POST['password'];

$con = new mysqli("localhost", "root", "", "kp123");
if ($con->connect_error) {
    die("Failed to Connect:" . $con->connect_error);
} else {
    $stmt = $con->prepare("select * from registration where mail=?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        $name = $data['name'];
        $age = $data['age'];
        $gender = $data['gender'];
        $mail = $data['mail'];
        $number = $data['number'];

        if ($data['password'] === $password) {
            // Start session and store user's email
            $_SESSION['mail'] = $mail;
            $_SESSION['age'] = $age;
            $_SESSION['gender'] = $gender;
            $_SESSION['name'] = $name;
            $_SESSION['number'] = $number;
           // echo "Name: " . $name;
            echo "<h2> Login Successfully</h2>";
            echo '<script>window.location.href = "index2.php";</script>';
           // exit();

        } else {
            echo "<h2>Invalid Email or Password";
            echo '<script>window.location.href = "index.html";</script>';
            exit();
        }
    } else {
        echo "<h2>Invalid Email or Password";
        echo '<script>window.location.href = "index.html";</script>';
        exit();
    }

}

?>