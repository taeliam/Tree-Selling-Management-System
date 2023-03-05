<?php
session_start();
include('connection/connection.php');
// query about us
if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    // print_r($order_id);
}

if(isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
    foreach($_SESSION['shopping_cart'] as $key => $value){
        $sum_price = $value['item_quan']*$value['item_price'];
        $sql = "INSERT INTO db_order_details(order_id,product_id,ps_id,detail_qty,detail_price,sum_price)
                VALUES('$order_id','".$value['item_p_id']."','".$value['item_ps_id']."','".$value['item_quan']."','".$value['item_price']."','$sum_price') ";

    }
    if(mysqli_query($conn, $sql)){
        unset($_SESSION['shopping_cart']);
        $alert = '<script type="text/javascript">';
        $alert .= 'window.location.href = "payment.php?order_id='.$order_id.'";';
        $alert .= '</script>';
        echo $alert;
    }
}

?>




    