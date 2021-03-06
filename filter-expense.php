<?php
header("Content-type: application/x-www-form-urlencoded");

include 'config.php';
$userId = $_COOKIE['userLogin'];

$startDate = $_POST['startDateExpense'];
$endDate = $_POST['endDateExpense'];
$userId = (int)$userId;

if (isset($startDate) && isset($endDate)) {

    $sqlFilter = "SELECT recId, recDate, categories, recDescription, type, recAmount FROM record JOIN category ON recCategory=catId JOIN type ON recType=typeId WHERE userId=$userId AND recDate>='$startDate' AND recDate<='$endDate' AND recType=2 ORDER BY recDate DESC;";
    $result = $conn->query($sqlFilter);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rowData = [$row["recDate"], $row["categories"], $row["recDescription"], $row["type"], $row["recAmount"], $row["recId"]];
            array_push($data, $rowData);
        }
    } else {
        $data = "Zero";
    }
} else {
    $startDate = date('Y-m-01');
    $endDate = date('Y-m-j', strtotime("last day of this month"));

    $sqlFilter = "SELECT redId, recDate, categories, recDescription, type, recAmount FROM record JOIN category ON recCategory=catId JOIN type ON recType=typeId WHERE userId=$userId AND recDate>='$startDate' AND recDate<='$endDate' AND recType=1 ORDER BY recDate DESC;";
    $result = $conn->query($sqlFilter);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rowData = [$row["recDate"], $row["categories"], $row["recDescription"], $row["type"], $row["recAmount"], $row["recId"]];
            array_push($data, $rowData);
        }
    } else {
        echo "No data found: " . $conn->error;
    }
}

echo json_encode($data);

$conn->close();
