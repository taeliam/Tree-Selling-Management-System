<?php 
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_product_type WHERE pt_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $producttype_name = mysqli_real_escape_string($conn, $_POST['pt_name']);
    if (!empty($producttype_name)) {
        $sql_check = "SELECT * FROM db_product_type WHERE pt_name = '$producttype_name' AND pt_id != '$id'";
        $query_check = mysqli_query($conn, $sql_check);
        $row_check = mysqli_num_rows($query_check);
        if($row_check > 0) {
            ?>
                <div class="alert alert-warning" role="alert">
                    มีประเภทต้นไม้นี้แล้ว!
                </div>
            <?php
        } else {
            $sql = "UPDATE db_product_type SET pt_name='$producttype_name' WHERE pt_id = '$id' ";
            if (mysqli_query($conn, $sql)) {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("แก้ไขประเภทต้นไม้สำเร็จ!");';
                $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
                $alert .= '</script>';
                echo $alert;
                exit();
            } else {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("แก้ไขประเภทต้นไม้ไม่สำเร็จ!");';
                $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
                $alert .= '</script>';
                echo $alert;
                exit();
            }
            mysqli_close($conn); 
        }
    }
}

?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">แก้ไขข้อมูลประเภทต้นไม้</h1>
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
                            <input type="text" class="form-control" id="floatingInput" name="pt_name" placeholder="seeker" 
                            value="<?=$result['pt_name']?>" autocomplete="off" required >
                            <label  for="floatingInput">ชื่อประเภทต้นไม้</label>
                        </div>
                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->