<?php
include_once("../database/db.php");
$db = new Database();

$sql_product_search = "SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.added_date,p.p_status FROM products p,brands b,categories c WHERE p.bid = b.bid AND p.cid = c.cid AND p.product_name LIKE '%".$_POST["search"]."%'";
$result = $db->connect()->query($sql_product_search) or die($db->connect()->error);

$rows = array();
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

//return ["rows"=>$rows];

if (count($rows) > 0) {
    $n = 1;
    foreach ($rows as $row) {
        ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["category_name"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><?php echo $row["product_price"]; ?></td>
                <td><?php echo $row["product_stock"]; ?></td>
                <td><?php echo $row["added_date"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                    <a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#form_products" class="btn btn-info btn-sm edit_product">Edit</a>
                </td>
              </tr>
        <?php
        $n++;
    }
    ?>
        <tr><td colspan="5"></td></tr>
    <?php
    exit();
}




?>