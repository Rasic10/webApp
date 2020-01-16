<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../database/db.php';

    // Instantiate DB & connect
    $database = new Database();
    $con = $database->connect();

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $cid = $data->cid;

    $cid = htmlspecialchars(strip_tags($cid));

    $pre_stmt = $con->prepare("DELETE FROM `categories` WHERE cid = ?");
    $pre_stmt->bind_param("i",$cid);
    $result = $pre_stmt->execute() or die($con->error);

    if ($result) {
        echo json_encode(array('message' => 'Post Deleted'));
    }else{
        echo json_encode(array('message' => 'Post Not Deleted'));
    }
?>