<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../database/db.php';

    // Instantiate DB & connect
    $database = new Database();
    $con = $database->connect();

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $parent_cat = $data->parent_cat;
    $category_name = $data->category_name;

    $parent_cat = htmlspecialchars(strip_tags($parent_cat));
    $category_name = htmlspecialchars(strip_tags($category_name));

    $pre_stmt = $con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
    $status = 1;
    $pre_stmt->bind_param("isi",$parent_cat,$category_name,$status);
    $result = $pre_stmt->execute() or die($con->error);

    if ($result) {
        echo json_encode(array('message' => 'Post Created'));
    }else{
        echo json_encode(array('message' => 'Post Not Created'));
    }
?>