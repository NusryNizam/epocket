<?php header('Content-Type: application/json; charset=utf-8');
include 'config.php';
$userId = $_COOKIE['userLogin'];
$monthStart = date('Y-m-01');

$sql = "SELECT SUM(recAmount) FROM record WHERE recType=1 AND userId=$userId AND recDate >= '$monthStart';";
$result = $conn->query($sql);

$income = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $income = $row['SUM(recAmount)'] == null ? 0 : $row['SUM(recAmount)'];
    // echo "Rs. " . $income;
}





$sql2 = "SELECT SUM(recAmount) FROM record WHERE recType=2 AND userId=$userId AND recDate >= '$monthStart';";
$result2 = $conn->query($sql2);

$expense = 0;
if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    // var_dump($row['SUM(recAmount']);
    $expense = $row2['SUM(recAmount)'] == null ? 0 : $row2['SUM(recAmount)'];

    // echo "Rs. " . $expense;
}




$sql3 = "SELECT recDate, categories, recDescription, type, recAmount FROM record JOIN category ON recCategory=catId JOIN type ON recType=typeId WHERE userId=$userId ORDER BY recDate DESC;";
$result3 = $conn->query($sql3);


$tableData = [$income, $expense];
if ($result3->num_rows > 0) {
    $max = min($result3->num_rows, 5);
    for ($i = 0; $i < $max; $i++) {
        $row3 = $result3->fetch_assoc();
        array_push($tableData, [$row3["recDate"], $row3["categories"],$row3["recDescription"],$row3["type"],$row3["recAmount"]]);
    }
}

echo json_encode($tableData);
