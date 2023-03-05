<?php 

$id = 1;
$sql = "SELECT * FROM db_about WHERE about_id = '$id'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);

if  (isset($_POST) && !empty($_POST)) {
    $name = mysqli_real_escape_string($conn, $_POST['about_name']);
    $description = mysqli_real_escape_string($conn, $_POST['about_desc']);
    $address = mysqli_real_escape_string($conn, $_POST['about_address']);
    $email = mysqli_real_escape_string($conn, $_POST['about_email']);
    $tel = mysqli_real_escape_string($conn, $_POST['about_tel']);
    

    $sql = "UPDATE db_about SET about_name='$name', about_desc='$description', about_address='$address',
         about_email='$email', about_tel='$tel' WHERE about_id = '$id' ";

    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("แก้ไขข้อมูลเกี่ยวกับเราสำเร็จ");';
        $alert .= 'window.location.href = "";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Errror: ". $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn); 
}

?> 

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เกี่ยวกับเรา</h1>
    </div>
</div>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">                      
                <div class="app-card-body">
                    <form action="" method="post">
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">ชื่อเว็บไซต์</label>
                            <input type="text" class="form-control" name="about_name" laceholder="" 
                            value="<?=$result['about_name']?>" autocomplete="off" required>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label  class="form-label">รายละเอียด</label><br>
                            <textarea name="about_desc" id="about_desc" class="form-control" style="height: 150px"><?=$result['about_desc']?></textarea>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">ที่อยู่</label><br>
                            <textarea name="about_address" class="form-control" style="height: 70px"><?=$result['about_address']?></textarea>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">อีเมล์</label>
                            <input type="text" class="form-control" name="about_email" laceholder="" 
                            value="<?=$result['about_email']?>" autocomplete="off" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label  class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="about_tel" laceholder="" 
                            value="<?=$result['about_tel']?>" autocomplete="off" required>
                        </div>

                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->