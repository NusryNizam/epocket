<?php
include 'config.php';
if(isset($_COOKIE['userLogin'])){
    header("Location: dashboard.php");
}
if($_SERVER['REQUEST_URI'] == "/login.php?logout=true") {
    setcookie('userLogin', "", time(), -3600);
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

    <?php include 'hf/nav.php'?>
    
    <section id="section1">
        <section id="login">
            <form id="login-form" method="post" action="login-backend.php">
                <h2>Login</h2>
                <label for="username">Username<br>
                    <input type="text" name="username" required>
                </label>
                <br>
                <label for="password">Password<br>
                    <input type="password" name="password" required>
                </label>
                <br>
                <?php
                if($_SERVER['REQUEST_URI'] == "/login.php?error=true"){
                    echo '<p style="font-size: 12px; color: red; font-weight: bold;">Wrong username or password</p>';
                } 
                ?>
                
                <input type="submit" class="btn-light" name="login" value="Login">
                <p class="small-text">Don't have an account? <a href="signup.php">Create one</a></p>
            </form>
        </section>
        <div id="section1-right">
            <img src="assets/undraw_Pie_chart_re_bgs8.svg" alt="Pie-Chart" style="width: 40vw">
        </div>
    </section>

    <?php include 'hf/footer.php'?>
</body>
<script src="script.js"></script>
</html>