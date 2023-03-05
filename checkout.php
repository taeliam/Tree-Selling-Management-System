<?php
include('connection/connection.php');
session_start();
if(isset($_POST['total']) && !empty($_POST['total'])) {
    if(!isset($_POST['weight_price']) || empty($_POST['weight_price'])) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("โปรดเลือกการจัดส่ง!");';
        $alert .= 'window.location.href = "cart_detail.php";';
        $alert .= '</script>';
        echo $alert;
    }else{ 
        $id = $_SESSION['user_id'];
        $tran_id = mysqli_real_escape_string($conn, $_POST['tran_id']);
        $total = mysqli_real_escape_string($conn, $_POST['last_price']);
        $freight = mysqli_real_escape_string($conn, $_POST['freight_price']);
        $weight_price = mysqli_real_escape_string($conn, $_POST['weight_price']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $h_number = mysqli_real_escape_string($conn, $_POST['h_number']);
        $moo = mysqli_real_escape_string($conn, $_POST['moo']);
        $subdistrict = mysqli_real_escape_string($conn, $_POST['subdistrict']);
        $district = mysqli_real_escape_string($conn, $_POST['district']);
        $province = mysqli_real_escape_string($conn, $_POST['province']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

        $sql = "INSERT INTO db_order(m_id,transport_id,order_total,order_freight,order_name,order_lname,order_postcode,
                order_hnumber,order_moo,order_dist,order_subdist,order_prov,order_tel,order_status)
                VALUES('$id','$tran_id','$total','$freight','$name','$lname','$zipcode','$h_number','$moo','$district',' $subdistrict','$province','$tel','1')";
        if(mysqli_query($conn, $sql)){
            $sql_select = "SELECT * FROM db_order ORDER BY order_id DESC LIMIT 1";
            $query_select = mysqli_query($conn, $sql_select);
            $result_select = mysqli_fetch_assoc($query_select);
            
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("สั่งซื้อเรียบร้อย!");';
            $alert .= 'window.location.href = "checkout_payment.php?order_id='.$result_select['order_id'].'";';
            $alert .= '</script>';
            echo $alert;
        }
        else {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("สั่งซื้อไม่สำเร็จ!");';
            $alert .= 'window.location.href = "cart_detail.php";';
            $alert .= '</script>';
            echo $alert;
        }

    }
} else {
    $alert = '<script type="text/javascript">';
        $alert .= 'alert("ไม่มีสินค้าในตะกร้า!");';
        $alert .= 'window.location.href = "cart_detail.php";';
        $alert .= '</script>';
        echo $alert;
}
?>
