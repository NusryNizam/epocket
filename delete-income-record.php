<?php header("Content-type: application/x-www-form-urlencoded");

include 'config.php';
$userId = $_COOKIE['userLogin'];
$userId = (int)$userId;

$recordId = $_POST['recordId'];
$recordId = (int)$recordId;


$sqlFilter = "DELETE FROM record WHERE recId=$recordId";
$result = $conn->query($sqlFilter);

if ($result === true) {
    $data = "success";
} else {
    $data = 'Failed';
}

echo json_encode($data);

$conn->close();
