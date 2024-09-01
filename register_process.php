<?php
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
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Validate password: only allow numbers and English letters
if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
    echo "<script>alert('Password must contain only numbers and English letters.');</script>";
    echo "<script>window.location.href = 'register.php';</script>";
    exit();
}

// Check if the email is already taken
$sql = "SELECT email FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Error in preparing the statement: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email is already taken
    echo "<script>alert('The email address is already registered. Please use a different email.');</script>";
    echo "<script>window.location.href = 'home.php';</script>";
    $stmt->close();
    $conn->close();
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare the SQL statement for insertion
$sql = "INSERT INTO users (fullName, email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Error in preparing the statement: " . $conn->error);
}

$stmt->bind_param("ssss", $fullName, $email, $username, $hashed_password);

if ($stmt->execute()) {
    session_start();
    $_SESSION['registration_success'] = true;
    $_SESSION['username'] = $username;
    // Redirect to home.php
    header("Location: home.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
