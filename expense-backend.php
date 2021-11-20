<?php
include 'config.php';
$userId = $_COOKIE['userLogin'];


$dateInput = strtolower(trim($_POST['date']));
$category = (int)trim($_POST['category']);
$description = trim($_POST['description']) . " ";
$amount = (float)trim($_POST['amount']);
$expense = 2;
$userId = (int)$userId;

if (isset($dateInput) && isset($category) && isset($description) && isset($amount)) {

    $sqlExpense = $conn->prepare("INSERT INTO record (recDate, recCategory, recDescription, recAmount, recType, userId) VALUES (?, ?, ?, ?, ?, ?)");
    $sqlExpense->bind_param("sisdii", $dateInput, $category, $description, $amount, $expense, $userId);
    $result = $sqlExpense->execute();
    // var_dump($result);
    if ($result === TRUE) {
        header("location: dashboard.php?expense?success=true");
    } else {
        echo "Error: " . $conn->error;
        // header("Location: signup.php?error=exists");
    }
} else {
    echo "Input fields cannot be empty";
}

$sqlExpense->close();
$conn->close();
