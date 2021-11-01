<?php
if (isset($_COOKIE['userLogin'])) {
    header("Location: dashboard.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles-login.css">
    <title>ePocket</title>
</head>

<body>
    <?php include 'hf/nav.php' ?>

    <section id="section1">
        <section id="login">
            <form id="login-form" method="POST" action="signup-backend.php">

                <h2>Signup</h2>
                <label for="username">Username<br>
                    <input type="text" name="username" required>
                </label>
                <br>
                <label for="email">Email<br>
                    <input type="email" name="email" required>
                </label>
                <br>
                <label for="password">New Password<br>
                    <input type="password" name="password" required>
                </label>
                <br>
                <label for="confirmPassword">Confirm Password<br>
                    <input type="password" name="confirmPassword" required>
                </label>
                <br>
                <?php
                if ($_SERVER['REQUEST_URI'] == '/signup.php?error=pwd') {
                    echo '<p style="font-size: 12px; color: red; font-weight: bold;">Passwords doesn\'t match</p>';
                }

                if ($_SERVER['REQUEST_URI'] == '/signup.php?error=exists') {
                    echo '<p style="font-size: 12px; color: red; font-weight: bold;">Username or email already occupied</p>';
                }
                ?>
                <input type="submit" class="btn-light" name="signup" value="Signup">
                <p class="small-text">Already have an account? <a href="login.php">Login here</a></p>
            </form>

        </section>
        <div id="section1-right">
            <img src="assets/undraw_Pie_chart_re_bgs8.svg" alt="Pie-Chart" style="width: 40vw">
        </div>
    </section>

    <?php include 'hf/footer.php' ?>
</body>
<script src="script.js"></script>

</html>