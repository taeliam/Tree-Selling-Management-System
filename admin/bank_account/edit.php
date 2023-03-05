<?php 
$errors = array('large_file'=>'','wrong_type'=>'','unknown'=>'');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_bank_account WHERE bank_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $bank_number = mysqli_real_escape_string($conn, $_POST['bank_number']);
    $bank_owner = mysqli_real_escape_string($conn, $_POST['bank_owner']);
    $bank_branch = mysqli_real_escape_string($conn, $_POST['bank_branch']);

    if (isset($_FILES['bank_pic'])) {
        // echo "<pre>";
        // print_r($_FILES['p_pic']);
        // echo "</pre>";

        $img_name = $_FILES['bank_pic']['name'];
        $img_size = $_FILES['bank_pic']['size'];
        $tmp_name = $_FILES['bank_pic']['tmp_name'];
        $error = $_FILES['bank_pic']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                $errors['large_file'] = "Sorry, your file is too large.";
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'upload/bank/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert into Database
                    $sql = "UPDATE db_bank_account 
                    SET bank_name = '$bank_name', bank_number = '$bank_number', bank_owner = '$bank_owner', bank_branch = '$bank_branch',bank_pic = '$new_img_name'
                    WHERE bank_id = '$id'";
        
                    if (mysqli_query($conn, $sql)) {
                        $alert = '<script type="text/javascript">';
                        $alert .= 'alert("แก้ไขข้อมูลบัญชีธนาคารสำเร็จ!");';
                        $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
                        $alert .= '</script>';
                        echo $alert;
                        exit();
                    } else {
                        ?>
                            <div class="alert alert-warning" role="alert">
                            แก้ไขข้อมูลบัญชีธนาคารไม่สำเร็จ!
                            </div>
                        <?php
                    } 
                }else {
                    $errors['wrong_type'] = "You can't upload files of this type";
                }
            }
        }else {
            $errors['unknown'] = "unknown error occurred!";
        }
    } else {
        echo 'errors';
    } 
}

$sql1 = "SELECT * FROM db_bank_account";
$query1 = mysqli_query($conn, $sql1);
?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">แก้ไขข้อมูลธนาคาร</h1>
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
                <form action="" method="post" enctype='multipart/form-data'>
                    <div class="mb-3 col-lg-3">
                        <label  class="form-label">รูปภาพ</label>
                        <?php foreach($errors as $data):?>
                            <p class="text-danger"><?php echo $data; ?></p>
                        <?php endforeach; ?>
                        <div>
                            <img id="img" src="upload/bank/<?=$result['bank_pic']?>"  width="250" height="250"/>
                        </div>
                        <input  type="file" class="form-control" name="bank_pic" placeholder="picture" autocomplete="off" required
                                onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="text" class="form-control" id="floatingInput" name="bank_name" placeholder="seeker" 
                        value="<?=$result['bank_name']?>" autocomplete="off" required>
                        <label  for="floatingInput">ชื่อธนาคาร</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="text" class="form-control" id="floatingInput" name="bank_number" placeholder="seeker" 
                        value="<?=$result['bank_number']?>" autocomplete="off" required>
                        <label  for="floatingInput">เลขที่บัญชี</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="text" class="form-control" id="floatingInput" name="bank_owner" placeholder="seeker" 
                        value="<?=$result['bank_owner']?>" autocomplete="off" required>
                        <label  for="floatingInput">ชื่อเจ้าของบัญชี</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="text" class="form-control" id="floatingInput" name="bank_branch" placeholder="seeker" 
                        value="<?=$result['bank_branch']?>" autocomplete="off" required>
                        <label  for="floatingInput">สาขาบัญชี</label>
                    </div>
                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div>
</div><!--//row-->
