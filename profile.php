

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>
    <?php
    include('connection/connection.php');
    // query about us
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM db_member WHERE m_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    // print_r($result);

    if(isset($_POST) && !empty($_POST)){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);

        $sql_update = "UPDATE db_member SET m_name ='$name', m_lname = '$lname', m_email = '$email', m_tel = '$tel' WHERE m_id = '$id'";
        if (mysqli_query($conn, $sql_update)) {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("แก้ไขข้อมูลผู้ใช้สำเร็จ!");';
            $alert .= 'window.location.href = "";';
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
    ?>

    <!-- profile --------------------------------------->
    <div class="container">
        <div class="row">
            <div class="product-cat">
                <strong>ข้อมูลผู้ใช้</strong>
            </div>
            <div class="col mt-5">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h4 class="mb-2 text-success">ข้อมูลส่วนตัว</h4>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">ชื่อผู้ใช้</h6>
                                <?php if(isset($result['m_username']) && !empty($result['m_username'])):?>
                                <pre class="fs-5">   <?=$result['m_username']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">ชื่อ-นามสกุล</h6>
                                <?php if(isset($result['m_name']) && !empty($result['m_name']) && isset($result['m_lname']) && !empty($result['m_lname'])):?>
                                <pre class="fs-5">   <?=$result['m_name']?> <?=$result['m_lname']?></pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">อีเมล์</h6>
                                <?php if(isset($result['m_email']) && !empty($result['m_email'])):?>
                                <pre class="fs-5">   <?=$result['m_email']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">เบอร์โทร</h6>
                                <?php if(isset($result['m_tel']) && !empty($result['m_tel'])):?>
                                <pre class="fs-5">   <?=$result['m_tel']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col mt-5">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row gutters">
                                <div class="col-xl-12 ">
                                    <h4 class="mb-2 text-secondary">แก้ไขข้อมูลส่วนตัว</h4>
                                </div>
                                <div class="col-xl-6 mt-3 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="name@example.com" id="cleartext"
                                        autocomplete="off" required>
                                        <label for="floatingInput">ชื่อ</label>
                                    </div>
                                </div>
                                <div class="col-xl-6  mt-3 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="lname" placeholder="name@example.com" id="cleartext"
                                        autocomplete="off" required>
                                        <label for="floatingInput">นามสกุล</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="name@example.com" id="cleartext"
                                        autocomplete="off" required>
                                        <label for="floatingInput">อีเมล์</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="tel" placeholder="name@example.com" id="cleartext"
                                        autocomplete="off" required>
                                        <label for="floatingInput">เบอร์โทร</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12">
                                    <div class="text-center">
                                        <button onclick="document.getElementById('cleartext').value = ''" class="btn btn-secondary">ล้างข้อมูล</button>
                                        <button type="submit" id="submit" name="submit" class="btn btn-success">แก้ไข</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                
    <!-- script --------------------------------------->
    <?php include('include/script.php')?>


    


</body>
</html>