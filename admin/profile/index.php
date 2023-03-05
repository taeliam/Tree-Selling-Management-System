<?php
    $username = $_SESSION['user_login'];
    $sql = "SELECT * FROM db_admin WHERE ad_username = '$username'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);

    if (isset($_POST) && !empty($_POST)) {
        if(isset($_POST['profile'])) {
            $email = mysqli_real_escape_string($conn, $_POST['ad_email']);
            $firstname = mysqli_real_escape_string($conn, $_POST['ad_name']);
            $lastname = mysqli_real_escape_string($conn, $_POST['ad_lname']);
            $tel = mysqli_real_escape_string($conn, $_POST['ad_tel']);

            $sql = "UPDATE db_admin SET ad_email='$email', ad_name='$firstname', ad_lname='$lastname', ad_tel='$tel' WHERE ad_username = '$username' ";
        
            if (mysqli_query($conn, $sql)) {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("แก้ไขข้อมูลบัญชีแอดมินสำเร็จ!");';
                $alert .= 'window.location.href = ""';
                $alert .= '</script>';
                echo $alert;
                exit();
            } else {
                echo "Errror: ". $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn); 
        }
        if(isset($_POST['changepassword'])) {
            // echo '<pre>';
            // echo print_r($_POST);
            // echo '</pre>';
            $oldpassword = mysqli_real_escape_string($conn, sha1(md5($_POST['oldpassword'])));
            $newpassword = mysqli_real_escape_string($conn, sha1(md5($_POST['newpassword'])));
            $confirmpassword = mysqli_real_escape_string($conn, sha1(md5($_POST['confirmpassword'])));
            if(isset($oldpassword) && !empty($oldpassword)) {
                $sql_check = "SELECT * FROM db_admin WHERE ad_username = '$username' AND ad_password = '$oldpassword'";
                $query_check = mysqli_query($conn, $sql_check);
                $row_check = mysqli_num_rows($query_check);
                if ($row_check == 0) {
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("รหัสผ่านเก่าไม่ถูกต้อง!");';
                    $alert .= 'window.location.href = ""';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                } else {
                    if ($newpassword != $confirmpassword) {
                        // echo '<pre>';
                        // echo print_r($newpassword);
                        // echo print_r($confirmpassword);
                        // echo '</pre>';
                        $alert = '<script type="text/javascript">';
                        $alert .= 'alert("รหัสผ่านใหม่ไม่ตรงกัน!");';
                        $alert .= 'window.location.href = ""';
                        $alert .= '</script>';
                        echo $alert;
                        exit();
                    } else {
                        $sql = "UPDATE db_admin SET ad_password = '$newpassword' WHERE ad_username = '$username'";
                        if ($query = mysqli_query($conn, $sql)) {
                            $alert = '<script type="text/javascript">';
                            $alert .= 'alert("เปลี่ยนรหัสผ่านสำเร็จ!");';
                            $alert .= 'window.location.href = ""';
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
            }
        }
    }
    
?>

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">บัญชีผู้จัดการระบบ</h1>
    </div>
    <div class="col-auto">
         
    </div>
</div>
<hr class="mb-4">
<div class="row gy-4">
    <div class="col-12 col-lg-6">
        <form action="" method="post">
            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                            </div><!--//icon-holder-->
                            
                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">ข้อมูลผู้จัดการระบบ</h4>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//app-card-header-->
                <div class="app-card-body px-4 w-100">
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>ชื่อ</strong></div>
                                <div class="item-data"><input type="text" name="ad_name" class="form-control" value=" <?=$result['ad_name']?>"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>นามสกุล</strong></div>
                                <div class="item-data"><input type="text" name="ad_lname" class="form-control" value="<?=$result['ad_lname']?>"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>อีเมล์</strong></div>
                                <div class="item-data"><input type="text" name="ad_email" class="form-control" value="<?=$result['ad_email']?>"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>เบอร์โทรศัพท์</strong></div>
                                <div class="item-data"><input type="text" name="ad_tel" class="form-control" value="<?=$result['ad_tel']?>"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                </div><!--//app-card-body-->
                <div class="app-card-footer p-4 mt-auto">
                    <!-- <input type="hidden" name="profile"> -->
                    <input type="submit" class="btn app-btn-secondary" name="profile" value="บันทึกข้อมูล" />
                </div><!--//app-card-footer-->
                
            </div><!--//app-card-->
        </form>
    </div><!--//col-->
    <div class="col-12 col-lg-6">
        <form action="" method="post">
            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                <div class="app-card-header p-3 border-bottom-0">
                    <div class="row align-items-center gx-3">
                        <div class="col-auto">
                            <div class="app-icon-holder">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z"/>
                                    <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </div><!--//icon-holder-->
                            
                        </div><!--//col-->
                        <div class="col-auto">
                            <h4 class="app-card-title">เปลี่ยนรหัสผ่าน</h4>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//app-card-header-->
                <div class="app-card-body px-4 w-100">
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>รหัสผ่านเก่า</strong></div>
                                <div class="item-data"><input type="password" name="oldpassword" class="form-control" placeholder="รหัสผ่านเก่า"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>รหัสผ่านใหม่</strong></div>
                                <div class="item-data"><input type="password" name="newpassword" class="form-control" placeholder="รหัสผ่านใหม่"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                    <div class="item py-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="">
                                <div class="item-label"><strong>ยืนยันรหัสผ่านใหม่</strong></div>
                                <div class="item-data"><input type="password" name="confirmpassword" class="form-control" placeholder="ยืนยันรหัสผ่านใหม่"></div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//item-->
                </div><!--//app-card-body-->
                
                <div class="app-card-footer p-4 mt-auto">
                    <input type="submit" class="btn app-btn-secondary" name="changepassword" value="เปลี่ยนรหัสผ่าน" />    
                </div><!--//app-card-footer-->
                
            </div><!--//app-card-->
        </form>
    </div>
</div><!--//row-->
			    
