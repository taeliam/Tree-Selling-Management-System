<?php 
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_admin WHERE ad_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $newpassword = mysqli_real_escape_string($conn, sha1(md5($_POST['newpassword'])));
    $confirmpassword = mysqli_real_escape_string($conn, sha1(md5($_POST['confirmpassword'])));
    if($newpassword != $confirmpassword) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("รหัสผ่านไม่ตรงกัน!");';
        $alert .= 'window.location.href = ""';
        $alert .= '</script>';
        echo $alert;
    } else {
        $sql = "UPDATE db_admin SET ad_password = '$newpassword' WHERE ad_id = '$id'";
        if ($query = mysqli_query($conn, $sql)) {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("รีเซ็ตรหัสผ่านบัญชีแอดมิน : '.$result['ad_username'].' สำเร็จ!");';
            $alert .= 'window.location.href = "?page=admin"';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            ?>
                <div class="alert alert-danger" role="alert">
                        มีบางอย่างผิดปกติ!
                </div>
            <?php
        }
    }
    mysqli_close($conn);
}
?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เปลี่ยนรหัสผ่านของแอดมิน : <?=$result['ad_username']?></h1>
    </div>
    <div class="col-auto">
         <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">                      
                <div class="app-card-body">
                    <form action="" method="post">
                        
                        <div class="mb-3 col-lg-3">
                            <label  class="form-label">รหัสผ่านใหม่</label>
                            <input type="password" class="form-control" name="newpassword" placeholder="รหัสผ่านใหม่ " autocomplete="off" required>
                        </div>
                        <div class="mb-3 col-lg-3">
                            <label  class="form-label">ยืนยันรหัสผ่านใหม่</label>
                            <input type="password" class="form-control" name="confirmpassword" placeholder="ยืนยันรหัสผ่านใหม่ " autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->