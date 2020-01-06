<?php

include_once("../database/db.php");
$db = new Database();
$con = $db->connect();

header('content-type:application/json');

$actionName = $_POST["actionName"];
if($actionName == "selectPost") {

    $query = "SELECT * FROM categories";
    $result = mysqli_query($con, $query);

    $rowCount = mysqli_num_rows($result);

    if($rowCount > 0) {
        $postData = array();
        while($row = mysqli_fetch_assoc($result)) {
            $postData[] = $row;
        }
        $resultData = array('status' => true, 'postData' => $postData);
    } else {
        $resultData = array('status' => false, 'massage' => 'No Post(s) Found...');
    }

    echo json_encode($resultData);
}



?>