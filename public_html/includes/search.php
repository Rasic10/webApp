<?php
    include_once("manage.php");

    $m = new Manage();
    $result = $m->manageSearch("products",$_POST["pageno"],$_POST["search"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if (count($rows) > 0) {
        echo $_POST["pageno"];
        $n = (($_POST["pageno"] - 1) * 5)+1;
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
                        <a href="#" bid="<?php echo $row['pid']; ?>" class="btn btn-success btn-sm">Barter</a>
                        <a href="#" eid="<?php echo $row['pid']; ?>" data-toggle="modal" data-target="#form_products" class="btn btn-info btn-sm edit_product">Edit</a>
                        <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                    </td>
                    </tr>
            <?php
            $n++;
        }
        ?>
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php
        exit();
    }
?>