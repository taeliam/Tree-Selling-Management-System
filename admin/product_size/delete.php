<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM db_product_size WHERE ps_id='$id'";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบขนาดต้นไม้สำเร็จ!");';
        $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Errror: ". $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn); 
}

?>