<?php 
$errors = array('large_file'=>'','wrong_type'=>'','unknown'=>'');

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM db_order WHERE order_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
if  (isset($_POST) && !empty($_POST)) {
    $status = mysqli_real_escape_string($conn, $_POST['order_status']);

    // Insert into Database
    $sql = "UPDATE db_order SET order_status = '$status' WHERE order_id = '$id'";
    // print_r($sql);
    if (mysqli_query($conn, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("อัปเดตสถานะสำเร็จ!");';
        $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        ?>
            <div class="alert alert-warning" role="alert">
            อัปเดตสถานะไม่สำเร็จ!
            </div>
        <?php
    } 
}
    
?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">แก้ไขข้อมูลการสั่งซื้อ</h1>
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
                    <div class="form-floating mb-3 col-lg-3">
                        <input type="text" class="form-control" disabled
                        value="<?=$result['order_id']?>" autocomplete="off" required>
                        <label  for="floatingInput">รหัสการสั่งซื้อ</label>
                    </div>
                    <div class="form-floating mb-3 col-lg-3">
                        <select name="order_status" class="form-select" id="floatingSelect" required>
                            <option value="" selected disabled>เลือกสถานะ</option>
                            <option value="1">รอการชำระเงิน</option>
                            <option value="2">ชำระเงินไม่ถูกต้อง
                            </option>
                            <option value="3">กำลังจัดส่ง</option>
                            <option value="4">จัดส่งสำเร็จ</option>
                        </select>
                        <label for="floatingSelect">สถานะ</label>
                    </div>

                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div>
</div><!--//row-->
