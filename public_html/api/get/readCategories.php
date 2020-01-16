<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../database/db.php';

    // Instantiate DB & connect
    $database = new Database();
    $con = $database->connect();

    // Blog post query
    $sql = "SELECT * FROM categories";
    $result = $con->query($sql) or die($con->error);

    // Check if any posts
    if ($result->num_rows > 0) {
        // Post array
        $posts_arr = array();
        
        $posts_arr['data'] = array();

        while ($row = $result->fetch_assoc()) {
            extract($row);

            $post_item = array(
                'cid' => $cid,
                'parent_cat' => $parent_cat,
                'category_name' => $category_name,
                'status' => $status
            );

            // Pust to "data"
            array_push($posts_arr['data'], $post_item);
        }

        // Turn to JSON & output
        echo json_encode($posts_arr);

    } else {
        // No Posts
        echo json_encode(array('message' => "No Posts Found"));
    }

?>