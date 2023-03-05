<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM db_member WHERE m_id='$id'";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบผู้ใช้สำเร็จ!");';
        $alert .= 'window.location.href = "?page=user";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        // echo "Errror: ". $sql . "<br>" . mysqli_error($conn);
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ข้อมูล user กำลังถูกใช้ในตารางอื่น!");';
        $alert .= 'window.location.href = "?page=user";';
        $alert .= '</script>';
        echo $alert;
        exit();

    }
    mysqli_close($conn); 
}

?>