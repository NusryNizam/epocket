<?php
include 'config.php';

$uname = strtolower(trim($_POST['username']));
$email = strtolower(trim($_POST['email']));
$pword = trim($_POST['password']);
$confirmpword = trim($_POST['confirmPassword']);

if ($pword != $confirmpword) {
    header("Location: signup.php?error=pwd");
} else {
    if (isset($uname) && isset($email) && isset($pword)) {
        // $sql = "INSERT INTO users VALUES ('$uname', '$email', '$pword');";

        $sql = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $uname, $email, $pword);
        $result = $sql->execute();

        if ($result === TRUE) {
?>

            <body style="background-color: #efffda">
                <div style="width: 100%; text-align: center; display: block; margin: 10% auto;">
                    <p><b>Account successfully created</b></p>
                    <a href="login.php">Go back to login</a>
                    <div>
            </body>
<?php

        } else {
            // echo "Error: " . $conn->error;
            header("Location: signup.php?error=exists");
        }
    } else {
        echo "Input fields cannot be empty";
    }
}

$sql->close();
$conn->close();

?>