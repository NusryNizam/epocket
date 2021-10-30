<?php
include 'config.php';
$monthStart = date('Y-m-01');
$userId = $_COOKIE['userLogin'];

$sql = "SELECT catId, categories FROM category";
$result = $conn->query($sql);
$data = array();
$data2 = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // print_r($row);
        // echo '<br>'
        $id = $row['catId'];
        $sql2 = "SELECT SUM(recAmount) FROM record WHERE recCategory=$id AND recDate >= '$monthStart' AND userId=$userId" ;
        $result2 = $conn->query($sql2);
        
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            // array_push($data, $row2['SUM(recAmount)']);

        }

        // print_r($row);
        // echo '<br>';
        // print_r($row2);
        // echo '<br>';
        // echo '<br>';

        array_push($data, array($row['catId'], $row['categories'], $row2['SUM(recAmount)'] == null ? 0: (float)$row2['SUM(recAmount)']));
    }

    
}

// ($newArr);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);

?>