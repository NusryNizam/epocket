<?php
include 'config.php';
$uname = strtolower(trim($_POST['username']));
$pword = trim($_POST['password']);
if (isset($uname) && isset($pword)) {
    $sql = "SELECT userId FROM users WHERE username='$uname' AND password='$pword'";
    $result = $conn->query($sql);
    $cookieName = "userLogin";
    // $cookieValue = $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // echo $row["username"];
            $cookieValue = $row["userId"];
            setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/"); // 86400 = 1 day

            header("Location: dashboard.php");

?>
            <html>

            <body>

                <?php
                if (!isset($_COOKIE[$cookieName])) {
                    echo "Cookie named '" . $cookieName . "' is not set!";
                } else {
                    echo "Cookie '" . $cookieName . "' is set!<br>";
                    echo "Value is: " . $_COOKIE[$cookieName];
                }
                ?>

            </body>

            </html>
<?php

        }
    } else {
        // echo "Your username or password is wrong. Please try again.";
        header("Location: login.php?error=true");
    }
} else {
    echo "Username and password cannot be empty";
}
?>