<?php 
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_member WHERE m_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $firstname = mysqli_real_escape_string($conn, $_POST['m_name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['m_lname']);
    $email = mysqli_real_escape_string($conn, $_POST['m_email']);
    $tel = mysqli_real_escape_string($conn, $_POST['m_tel']);

    

    $sql = "UPDATE db_member SET m_name='$firstname', m_lname='$lastname', m_email = '$email', m_tel='$tel' WHERE m_id = '$id' ";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("แก้ไขข้อมูลผู้ใช้สำเร็จ");';
        $alert .= 'window.location.href = "?page=user";';
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
        <h1 class="app-page-title mb-0">แก้ไขข้อมูลผู้ใช้</h1>
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
                            <input type="text" class="form-control" id="floatingInput" name="m_username" placeholder="seeker" 
                            value="<?=$result['m_username']?>" autocomplete="off" required disabled>
                            <label  for="floatingInput">ชื่อผู้ใช้</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="m_name" placeholder="seeker" 
                            value="<?=$result['m_name']?>" autocomplete="off" required >
                            <label  for="floatingInput">ชื่อ</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="m_lname" placeholder="seeker" 
                            value="<?=$result['m_lname']?>" autocomplete="off" required >
                            <label  for="floatingInput">นามสกุล</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="email" class="form-control" id="floatingInput" name="m_email" placeholder="seeker" 
                            value="<?=$result['m_email']?>" autocomplete="off" required >
                            <label  for="floatingInput">อีเมล์</label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3">
                            <input type="text" class="form-control" id="floatingInput" name="m_tel" placeholder="seeker" 
                            value="<?=$result['m_tel']?>" autocomplete="off" required >
                            <label  for="floatingInput">เบอร์โทร</label>
                        </div>
                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->