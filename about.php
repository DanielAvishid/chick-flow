<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChicFlow</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a753023b7e.js" crossorigin="anonymous"></script>
    <script defer src="script.js"></script>
</head>

<body>
    <?php
    session_start();

    $conn = new mysqli("localhost", "root", "root", "ChickFlow");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");

    $sql = "SELECT * FROM `Order`"; // Use backticks for reserved keywords like 'Order'
    $result = $conn->query($sql);
    $conn->close();
    ?>

    <div class="confirm-modal">
        <h2 class="confirm-modal-title">Sent Successfully</h2>
        <button class="submit-btn modal-close-btn" onclick="onCloseConfirmModal()">Close</button>
    </div>
    <div class="confirm-login-modal">
        <h2 class="confirm-modal-title">Connecting... please wait a moment</h2>
        <button class="submit-btn modal-close-btn" onclick="onCloseConfirmLoginModal()">Close</button>
    </div>
    <div class="confirm-sign-modal">
        <h2 class="confirm-modal-title">We are happy you Joined!</h2>
        <h2 class="confirm-modal-title">You can start editing your dashboard</h2>
        <button class="submit-btn modal-close-btn" onclick="onCloseConfirmSignModal()">Close</button>
    </div>
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
                <button class="close-btn" onclick="onClickLoginClose()">
                    X
                </button>
                <form class="login-form" action="register_process.php" method="POST">
                    <input class="auth-input" type="text" placeholder="fullname" name="fullName" id="fullName" required>
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
                <a href="home.php" class="active">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact-us.php">Contact Us</a>
                <a href="dashboard.php">Dashboard</a>
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
    <main>
        <div class="about-container">
            <h2 class="about-title">About us</h2>
            <div class="about-team">
                <div class="team-card">
                    <div class="aviv-team">
                        <img class="team-one" src="../chick-flow/images/team-one.jpeg" alt="">
                    </div>
                    <h2 class="text-center">Michal Budnitzki</h2>
                    <h2 class="text-center role-title">CFO</h2>
                </div>
                <div class="team-card">
                    <img class="aviv-team" src="images/aviv-team.jpeg" alt="">
                    <h2 class="text-center">Aviv Nahon</h2>
                    <h2 class="text-center role-title">Founder and CEO</h2>
                </div>
                <div class="team-card">
                    <div class="aviv-team">
                        <img class="team-two" src="images/team-two.jpeg" alt="">
                    </div>
                    <h2 class="text-center">Maayan Timstit</h2>
                    <h2 class="text-center role-title">Director of Trade Department</h2>
                </div>
            </div>
        </div>
    </main>
</body>

</html>