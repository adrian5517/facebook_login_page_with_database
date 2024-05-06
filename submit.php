<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "facebook_users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username from GET parameter
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Prepare SQL statement
$sql = "INSERT INTO users (email) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
