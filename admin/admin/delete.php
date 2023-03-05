<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM db_admin WHERE ad_id='$id'";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ลบบัญชีแอดมินสำเร็จ!");';
        $alert .= 'window.location.href = "?page=admin";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        // echo "Errror: ". $sql . "<br>" . mysqli_error($conn);
        ?>
        <div class="alert alert-danger" role="alert">
                บางอย่างผิดพลาด!
        </div>
        <?php
    }
    mysqli_close($conn); 
}

?>