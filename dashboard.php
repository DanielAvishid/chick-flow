<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a753023b7e.js" crossorigin="anonymous"></script>
    <script defer src="script.js"></script>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: home.php'); // Redirect to login page if not authenticated
        exit();
    }

    // Establish a database connection
    $conn = new mysqli("localhost", "root", "root", "ChickFlow");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set character set to utf8
    $conn->set_charset("utf8");

    // Perform the query to retrieve all orders
    $sql = "SELECT * FROM `Order`"; // Use backticks for reserved keywords like 'Order'
    $result = $conn->query($sql);
    ?>

    <header class="app-header">
        <div class="app-header-container">
            <div class="login-modal">
                <button class="close-btn" onclick="onClickLoginClose()">
                    X
                </button>
                <form class="login-form" action="login_process.php" method="POST">
                    <input class="auth-input" type="text" placeholder="username" name="username" id="username" required>
                    <input class="auth-input" type="password" placeholder="password" name="password" id="password" required>
                    <button class="login-btn" type="submit">Login</button>
                </form>
            </div>
            <div class="sign-modal">
                <button class="close-btn" onclick="onClickSignClose()">
                    X
                </button>
                <form class="login-form" action="register_process.php" method="POST" id="register-form">
                    <input class="auth-input" type="text" placeholder="fullname" name="fullname" id="fullname" required>
                    <input class="auth-input" type="text" placeholder="email" name="email" id="email" required>
                    <input class="auth-input" type="text" placeholder="username" name="username" id="username" required>
                    <input class="auth-input" type="password" placeholder="password" name="password" id="password" required>
                    <button class="login-btn" type="submit">Sign Up</button>
                </form>
            </div>
            <div class="logo-container">
                <div class="logo-icon"></div>
                <a class="logo" href="home.php">ChicFlow</a>
            </div>
            <nav class="header-nav">
                <a href="home.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact-us.php">Contact Us</a>
                <a href="dashboard.php" class="active">Dashboard</a>
            </nav>
            <?php

            if (!isset($_SESSION['username'])) {
                echo '<div class="header-btns">
                <button class="login-btn-header" onclick="onClickLogin()">
                    <i class="fa-solid fa-right-to-bracket icon-auth"></i>
                </button>
                <button class="sign-btn-header" onclick="onClickSign()">
                    <i class="fa-solid fa-user-plus icon-auth"></i>
                </button>
            </div>';
            } else {
                echo '<div class="custom-title" style="color: white;">';
                echo 'Welcome, ';
                echo $_SESSION['username'];
                echo '</div>';
                echo '<form action="logout.php" method="POST">
                      <button type="submit">Logout</button>
                      </form>';
            }
            ?>

        </div>
    </header>

    <div class="dashboard-container">
        <h1 class="welcome-dashboard-title">
            <?php
            echo 'Welcome, ';
            echo $_SESSION['username'];
            ?>
        </h1>

        <div class="dashboard-btns-container">
            <button class="button-49">Employees</button>
            <button class="button-49">Orders</button>
        </div>
    </div>


</body>

</html>