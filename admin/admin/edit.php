<?php 
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_admin WHERE ad_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $email = mysqli_real_escape_string($conn, $_POST['ad_email']);
    $firstname = mysqli_real_escape_string($conn, $_POST['ad_name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['ad_lname']);
    $tel = mysqli_real_escape_string($conn, $_POST['ad_tel']);
    $ad_level = mysqli_real_escape_string($conn, $_POST['ad_level']);
    

    $sql = "UPDATE db_admin SET ad_email='$email', ad_name='$firstname', ad_lname='$lastname', ad_tel='$tel', ad_level='$ad_level' WHERE ad_id = '$id' ";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("แก้ไขข้อมูลแอดมินสำร็จ!");';
        $alert .= 'window.location.href = "?page=admin";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            บางอย่างผิดพลาด!
        </div>
    <?php
    }
    mysqli_close($conn); 
}

?> 

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">แก้ไขแอดมิน</h1>
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
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_username" placeholder="seeker" 
                            value="<?=$result['ad_username']?>" autocomplete="off" required disabled>
                            <label  for="floatingInput">ชื่อผู้ใช้</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="email" class="form-control" id="floatingInput" name="ad_email" placeholder="seeker" 
                            value="<?=$result['ad_email']?>" autocomplete="off" required >
                            <label  for="floatingInput">อีเมล์</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_name" placeholder="seeker" 
                            value="<?=$result['ad_name']?>" autocomplete="off" required >
                            <label  for="floatingInput">ชื่อ</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_lname" placeholder="seeker" 
                            value="<?=$result['ad_lname']?>" autocomplete="off" required >
                            <label  for="floatingInput">นามสกุล</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_tel" placeholder="seeker" 
                            value="<?=$result['ad_tel']?>" autocomplete="off" required >
                            <label  for="floatingInput">เบอร์โทรศัพท์</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <select name="ad_level" class="form-select" id="floatingSelect" required>
                                <option value="" selected disabled>เลือกระดับของแอดมิน</option>
                                <option value="admin">Admin</option>
                                <option value="super admin">Super Admin</option>
                            </select>
                            
                            <label for="floatingSelect">ระดับของแอดมิน</label>
                        </div>

                        <!-- เหลือ super admin -->

                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->