<?php 
$errors = array('large_file'=>'','wrong_type'=>'','unknown'=>'');
$errors2 = array('exist'=>'');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_product WHERE product_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $product_id = $result['product_id'];
    $ps_size = mysqli_real_escape_string($conn, $_POST['ps_size']);
    $ps_weight = mysqli_real_escape_string($conn, $_POST['ps_weight']);
    $ps_price = mysqli_real_escape_string($conn, $_POST['ps_price']);
    // $ps_number = mysqli_real_escape_string($conn, $_POST['ps_number']);

    $sql_check = "SELECT *
                FROM db_product_size ps
                INNER JOIN db_product p ON ps.product_id = p.product_id
                WHERE ps.product_id = $product_id
                AND ps.ps_size = '$ps_size'";
    $query_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_num_rows($query_check);


    if($row_check > 0) {
        $rows = mysqli_fetch_assoc($query_check);
        $errors2['exist'] = "This size is already in ".$rows['p_name'] ;
        // echo "<pre>";
        // print_r($rows);
        // echo "</pre>";
        } else {
            if (isset($_FILES['ps_pic'])) {
                // echo "<pre>";
                // print_r($_FILES['p_pic']);
                // echo "</pre>";

                $img_name = $_FILES['ps_pic']['name'];
                $img_size = $_FILES['ps_pic']['size'];
                $tmp_name = $_FILES['ps_pic']['tmp_name'];
                $error = $_FILES['ps_pic']['error'];

                if ($error === 0) {
                    if ($img_size > 1250000) {
                        $errors['large_file'] = "Sorry, your file is too large.";
                    } else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
            
                        $allowed_exs = array("jpg", "jpeg", "png"); 
            
                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                            $img_upload_path = 'upload/product_size/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
            
                            // Insert into Database
                            $sql = "INSERT INTO db_product_size(product_id, ps_size, ps_weight, ps_price, ps_pic) 
                                    VALUES ('$product_id', '$ps_size', '$ps_weight', '$ps_price', '$new_img_name')";
                            if (mysqli_query($conn, $sql)) {
                                $alert = '<script type="text/javascript">';
                                $alert .= 'alert("เพิ่มข้อมูลขนาดต้นไม้สำเร็จ!");';
                                $alert .= 'window.location.href = "?page='.$_GET['page'] = 'product_size'.'";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();

                            } else {
                                ?>
                                    <div class="alert alert-warning" role="alert">
                                        เพิ่มข้อมูลขนาดต้นไม้ไม่สำเร็จ!
                                    </div>
                                <?php
                            }
                        }else {
                            $errors['wrong_type'] = "You can't upload files of this type";
                        }
                    }
                } else {
                    $errors['unknown'] = "unknown error occurred!";
                }
            } else {
                $new_img_name = '';
            }
        }    
}

?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เพิ่มข้อมูลขนาดต้นไม้</h1>
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
                            <img id="img"  width="250" height="250"/>
                        </div>
                        <input  type="file" class="form-control" name="ps_pic" placeholder="picture" autocomplete="off" required
                                onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="p-3 mb-2">
                        <label  class="form-label" ><?=$result['p_name']?></label>
                    </div>
                    <div class="text-danger"><?php echo $errors2['exist'];?></div>
                    <div class="form-floating mb-3 col-lg-3">
                        <select name="ps_size" class="form-select" id="floatingSelect" required>
                            <option value="" selected disabled>ขนาดกระถาง</option>
                            <?php
                                for ($i=1; $i<=20; $i++) {   ?> 
                                    <option value="<?=$i."\""?>"><?=$i."\""?></option>
                                    
                            <?php   }?>
                        </select>
                        <label for="floatingSelect">ขนาด</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="number" placeholder="0.00" id="floatingInput" class="form-control" required name="ps_weight" 
                        min="0" value="" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$">
                        <label for="floatingInput">น้ำหนัก(กรัม)</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="number" placeholder="0.00" id="floatingInput" class="form-control" required name="ps_price" 
                        min="0" value="" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$">
                        <label for="floatingInput">ราคา</label>
                    </div>
                    </div>
                    <!-- <div class="form-floating mb-3 col-lg-3">
                        <input type="number" class="form-control" id="floatingInput" name="ps_number" placeholder="20.00" autocomplete="off" required>
                        <label  for="floatingInput">จำนวน</label>
                    </div> -->
                    <button type="submit" class="btn app-btn-primary" >บันทีก</button>
                </form>

            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div>
</div><!--//row-->
<script>

    
</script>