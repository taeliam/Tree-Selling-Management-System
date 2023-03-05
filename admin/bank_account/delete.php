<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM db_bank_account WHERE bank_id ='$id'";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบข้อมูลบัญชีธนาคารสำเร็จ!");';
        $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ข้อมูลบัญชีธนาคารนี้ถูกใช้ในตารางอื่น!");';
        $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
        $alert .= '</script>';
        echo $alert;
        exit();
    }
    mysqli_close($conn); 
}

?>