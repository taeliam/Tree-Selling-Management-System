<?php 
$errors = array('large_file'=>'','wrong_type'=>'','unknown'=>'');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_article WHERE article_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $article_name = mysqli_real_escape_string($conn, $_POST['article_name']);
    $t_article_id = mysqli_real_escape_string($conn, $_POST['t_article_id']);
    $article_detail = mysqli_real_escape_string($conn, $_POST['article_detail']);

    if (isset($_FILES['article_pic'])) {
        // echo "<pre>";
        // print_r($_FILES['p_pic']);
        // echo "</pre>";

        $img_name = $_FILES['article_pic']['name'];
        $img_size = $_FILES['article_pic']['size'];
        $tmp_name = $_FILES['article_pic']['tmp_name'];
        $error = $_FILES['article_pic']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                $errors['large_file'] = "Sorry, your file is too large.";
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'upload/article/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
    
                    // Insert into Database
                    $sql = "UPDATE db_article 
                    SET article_name = '$article_name', t_article_id = '$t_article_id', article_detail = '$article_detail', article_pic = '$new_img_name'
                    WHERE article_id = '$id'";
        
                    if (mysqli_query($conn, $sql)) {
                        $alert = '<script type="text/javascript">';
                        $alert .= 'alert("แก้ไขข้อมูลบทความสำเร็จ!");';
                        $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
                        $alert .= '</script>';
                        echo $alert;
                        exit();
                    } else {
                        ?>
                            <div class="alert alert-warning" role="alert">
                            แก้ไขข้อมูลบทความไม่สำเร็จ!
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

$sql1 = "SELECT * FROM db_type_article";
$query1 = mysqli_query($conn, $sql1);
?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">แก้ไขข้อมูลบทความ</h1>
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
                            <img id="img" src="upload/article/<?=$result['article_pic']?>"  width="250" height="250"/>
                        </div>
                        <input  type="file" class="form-control" name="article_pic" placeholder="picture" autocomplete="off" required
                                onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="text" class="form-control" id="floatingInput" name="article_name" placeholder="seeker" 
                        value="<?=$result['article_name']?>" autocomplete="off" required>
                        <label  for="floatingInput">ชื่อบทความ</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <select name="t_article_id" class="form-control">
                            <option value="" disabled>เลือกประเภทบทความ</option>
                            <?php foreach($query1 as $data):?>
                            <option value="<?=$data['t_article_id']?>" <?=$result['t_article_id'] == $data['t_article_id'] ? 'selected' : '' ?>><?=$data['t_article_name']?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingSelect">ประเภทบทความ</label>
                    </div>
                    <div class="mb-3 col-lg-12">
                    <label for="floatingTextarea">รายละเอียด</label>
                        <textarea class="form-control" name="article_detail" placeholder="Leave a comment here" id="article_detail" style="height: 150px"><?=$result['article_detail']?></textarea>
                    </div>
                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div>
</div><!--//row-->
<script>

    
</script>

























































































































































