<?php 
    if  (isset($_POST) && !empty($_POST)) {
        $producttype_name = mysqli_real_escape_string($conn, $_POST['producttype_name']);

        if (!empty($producttype_name)) {
            $sql_check = "SELECT * FROM db_product_type WHERE pt_name = '$producttype_name'";
            $query_check = mysqli_query($conn, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if($row_check > 0) {
                ?>
                <div class="alert alert-warning" role="alert">
                    มีประเภทต้นไม้นี้แล้ว!
                </div>
                <?php
            } else {  
                $sql = "INSERT INTO db_product_type(pt_name) VALUES ('$producttype_name')";
                if (mysqli_query($conn, $sql)) {
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("เพิ่มข้อมูลประเภทต้นไม้สำเร็จ!");';
                    $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                } else {
                    echo "error";
                } 
            }
        }

        
        mysqli_close($conn);
    }
?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">เพิ่มข้อมูลประเภทต้นไม้</h1>
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
                            <input type="text" class="form-control" id="floatingInput" name="producttype_name" placeholder="seeker" autocomplete="off" required>
                            <label  for="floatingInput">ชื่อประเภทต้นไม้</label>
                        </div>
                        <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                    </form>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->