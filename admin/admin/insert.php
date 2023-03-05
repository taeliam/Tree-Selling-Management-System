<?php 
    if  (isset($_POST) && !empty($_POST)) {
        $username = mysqli_real_escape_string($conn, $_POST['ad_username']);
        $password = mysqli_real_escape_string($conn, sha1(md5($_POST['ad_password'])));
        $email = mysqli_real_escape_string($conn, $_POST['ad_email']);
        $firstname = mysqli_real_escape_string($conn, $_POST['ad_name']);
        $lastname = mysqli_real_escape_string($conn, $_POST['ad_lname']);
        $tel = mysqli_real_escape_string($conn, $_POST['ad_tel']);
        $ad_level = mysqli_real_escape_string($conn, $_POST['ad_level']);
        
        if (!empty($username)) {
            $sql_check = "SELECT * FROM db_admin WHERE ad_username = '$username'";
            $query_check = mysqli_query($conn, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if($row_check > 0) {
                ?>
                    <div class="alert alert-warning" role="alert">
                        ชื่อบัญชีแอดมินนี้มีอยู่แล้ว!
                    </div>
                <?php
            } else {  
                $sql = "INSERT INTO db_admin(ad_username, ad_password, ad_email, ad_name, ad_lname, ad_tel, ad_level) 
                VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$tel', '$ad_level')";
                if (mysqli_query($conn, $sql)) {
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("เพิ่มบัญชีแอดมินสำเร็จ!");';
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
            }
        }

        
        mysqli_close($conn);
    }

?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เพิ่มบัญชีแอดมิน</h1>
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
                            <input type="text" class="form-control" id="floatingInput" name="ad_username" placeholder="seeker" autocomplete="off" required>
                            <label  for="floatingInput">ชื่อผู้ใช้</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="password" class="form-control" id="floatingInput" name="ad_password" placeholder="seeker" autocomplete="off" required>
                            <label  for="floatingInput">รหัสผ่าน</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="email" class="form-control" id="floatingInput" name="ad_email" placeholder="seeker" 
                            value="<?=(isset($_POST['ad_email']) && !empty($_POST['ad_email']) ? $_POST['ad_email'] : '' )?>" autocomplete="off" required>
                            <label  for="floatingInput">อีเมล์</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_name" placeholder="seeker" 
                            value="<?=(isset($_POST['ad_name']) && !empty($_POST['ad_name']) ? $_POST['ad_name'] : '' )?>" autocomplete="off" required>
                            <label  for="floatingInput">ชื่อ</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_lname" placeholder="seeker" 
                            value="<?=(isset($_POST['ad_lname']) && !empty($_POST['ad_lname']) ? $_POST['ad_lname'] : '' )?>" autocomplete="off" required>
                            <label  for="floatingInput">นามสกุล</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="ad_tel" placeholder="seeker" 
                            value="<?=(isset($_POST['ad_tel']) && !empty($_POST['ad_tel']) ? $_POST['ad_tel'] : '' )?>" autocomplete="off" required>
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
                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->