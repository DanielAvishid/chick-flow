<?php
session_start();

$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "root"; // Replace with your database password
$dbname = "ChickFlow"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the posted data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare the SQL statement
$sql = "SELECT password FROM users WHERE username = ?";

// Use prepared statements to avoid SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    // Successful login
    $_SESSION['username'] = $username;
    echo "Login successful! Welcome, " . htmlspecialchars($username) . ".";
    // Redirect to a protected page or dashboard
    header("Location: dashboard.php");
    exit();
} else {
    echo "<script>alert('Invalid credentials try again please...');</script>";
    echo "<script>window.location.href = 'home.php';</script>";
    $stmt->close();
    $conn->close();
    exit();
}

// Close the connection
$stmt->close();
$conn->close();
