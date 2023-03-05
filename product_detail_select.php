<?php
include('connection/connection.php');
session_start();

$product_id = $_SESSION['id_ps'];

$val = $_GET["value"];
$val_M = mysqli_real_escape_string($conn, $val);
// $val_M = 12;
$sql1 = "SELECT *
        FROM db_product_size
        WHERE product_id = $product_id
        AND ps_id = '$val_M'";
// $sql1 = "SELECT *
//         FROM db_product_size ps
//         INNER JOIN db_product p ON ps.product_id = p.product_id
//         WHERE ps.product_id = $product_id
//         AND ps.ps_size = '$val_M'";
$result = mysqli_query($conn, $sql1);
// $row = mysqli_num_rows($query);


if (mysqli_num_rows($result)>0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "฿".number_format($rows['ps_price'],2);
    }
}
?>