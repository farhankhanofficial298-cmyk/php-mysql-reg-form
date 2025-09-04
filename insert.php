<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sttudent_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = trim($_POST['name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if (!empty($name) && !empty($email) && !empty($course)) {
        // Use prepared statement for security
        $stmt = $conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $course);

        if ($stmt->execute()) {
            echo "New student registered successfully! <br>";
            echo "<a href='view.php'>View Students</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill all fields!";
    }
}

$conn->close();
?>