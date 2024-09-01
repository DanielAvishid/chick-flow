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
        <section class="hero-container">
            <div class="second-line"></div>
            <div class="third-line"></div>
            <div class="shape">
                <div class="bottom-line"></div>
            </div>
            <section class="hero">
                <div class="inside-shape"></div>
                <div class="welcome-title">
                    <h2>Welcome</h2>
                </div>
                <h2 class="second-title">
                    We're your go-to platform for a seamless wardrobe or inventory experience</h2>
                <h2 class="hero-title">
                    Where style meets efficiency in clothing management</h2>
                <h2 class="hero-title-second">
                </h2>
                <div class="hero-form-container">
                    <form class="hero-form" onsubmit="return onSubmit(event)">
                        <input class="hero-input" type="email" placeholder="Email" required>
                        <div class="hero-input-container">
                            <input class="hero-checkbox" required type="checkbox">
                            <label class="hero-label" for="">I would like to receive news and updates from Chicflow.</label>
                        </div>
                        <button class="hero-form-btn" type="submit">Subscribe</button>
                    </form>
                </div>
            </section>
        </section>
        <div class="cards-line-container">
            <div class="card-shape">
            </div>
            <section class="cards-container">
                <div class="card-container">
                    <div class="icon-container">
                        <span class="icon-first icon">
                            <i class="fa-solid fa-ranking-star"></i>
                        </span>
                    </div>
                    <h3 class="card-title">Innovative Solutions</h3>
                    <h4 class="card-subtitle">Stay ahead with our cutting-edge features.</h4>
                </div>
                <div class="card-container">
                    <div class="icon-container">
                        <span class="icon">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </span>
                    </div>
                    <h3 class="card-title">Intuitive Design</h3>
                    <h4 class="card-subtitle">Effortless navigation for a delightful experience.</h4>
                </div>
                <div class="card-container">
                    <div class="icon-container">
                        <span class="icon">
                            <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                        </span>
                    </div>
                    <h3 class="card-title">Track My Goods</h3>
                    <h4 class="card-subtitle">Locate your order exact status</h4>
                </div>
            </section>
        </div>
        <section class="join-us-container">
            <div class="join-us-content">
                <h2 class="join-us-title">Ready to Elevate Your Style? Join ChicFlow Today for Effortless Wardrobe and Inventory Management!</h2>
                <form class="join-us-form" onsubmit="return onSubmit(event)">
                    <div class="join-us-input-container">
                        <input class="contact-input" type="text" placeholder="Full Name" required>
                        <input class="contact-input" type="email" placeholder="Email" required>
                        <button class="submit-btn join-us-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <image src="./images/bussiness.jpeg" class="join-us-image" />
        </section>
    </main>

    <?php if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) : ?>
        <script>
            // Display the registration success modal
            document.querySelector('.confirm-sign-modal').style.display = 'block';

            // Clear the session variable
            <?php unset($_SESSION['registration_success']); ?>
        </script>
    <?php endif; ?>

</body>

</html>