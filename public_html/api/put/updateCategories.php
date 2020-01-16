<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../database/db.php';

    // Instantiate DB & connect
    $database = new Database();
    $con = $database->connect();

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $parent_cat = $data->parent_cat;
    $category_name = $data->category_name;
    $cid = $data->cid;

    $parent_cat = htmlspecialchars(strip_tags($parent_cat));
    $category_name = htmlspecialchars(strip_tags($category_name));
    $cid = htmlspecialchars(strip_tags($cid));
    $status = 1;

    $pre_stmt = $con->prepare("UPDATE `categories` SET `parent_cat`=?, `category_name`=?, `status`=? WHERE cid = ?");
    $pre_stmt->bind_param("isii",$parent_cat,$category_name,$status,$cid);
    $result = $pre_stmt->execute() or die($con->error);

    if ($result) {
        echo json_encode(array('message' => 'Post Updated'));
    }else{
        echo json_encode(array('message' => 'Post Not Updated'));
    }
?>