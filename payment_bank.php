

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

    <!-- php -->
    <?php
    include('connection/connection.php');
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $m_id = $_SESSION['user_id'];
    }
    $sql_bank = "SELECT * FROM db_bank_account";
    $query_bank = mysqli_query($conn, $sql_bank);

    if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }

    $errors = array('large_file'=>'','wrong_type'=>'','unknown'=>'');

    if(isset($_POST) && !empty($_POST)) {

        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
        $bank_id = mysqli_real_escape_string($conn, $_POST['bank_id']);
        $pay_price = mysqli_real_escape_string($conn, $_POST['pay_price']);
        $pay_date = $_POST['pay_date'];
        $pay_contact = mysqli_real_escape_string($conn, $_POST['pay_contact']);
        $pay_tel = mysqli_real_escape_string($conn, $_POST['pay_tel']);

        $sql_check = "SELECT * FROM db_order WHERE order_id = '$order_id' AND m_id = '$m_id'";
        $sql_check_query = mysqli_query($conn, $sql_check);
        $result_check = mysqli_fetch_assoc($sql_check_query);
        $sql_check_num = mysqli_num_rows($sql_check_query);
        if($sql_check_num > 0){
            if($result_check['order_status'] == '1') {
                if (isset($_FILES['pay_pic'])) {
    
                    $img_name = $_FILES['pay_pic']['name'];
                    $img_size = $_FILES['pay_pic']['size'];
                    $tmp_name = $_FILES['pay_pic']['tmp_name'];
                    $error = $_FILES['pay_pic']['error'];
     
                    if ($error === 0) {
                        if ($img_size > 1250000) {
                            $errors['large_file'] = "Sorry, your file is too large.";
                        }else {
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                            $img_ex_lc = strtolower($img_ex);
                
                            $allowed_exs = array("jpg", "jpeg", "png"); 
                
                            if (in_array($img_ex_lc, $allowed_exs)) {
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = 'admin/upload/payment/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);
                
                                // Insert into Database
                                $sql = "INSERT INTO db_payment(order_id, bank_id, pay_price, pay_date, pay_contact, pay_tel, pay_pic) 
                                        VALUES ('$order_id', '$bank_id', '$pay_price','$pay_date','$pay_contact','$pay_tel', '$new_img_name')";
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script type="text/javascript">';
                                    $alert .= 'alert("แจ้งชำระเงินสำเร็จ!");';
                                    $alert .= 'window.location.href = "payment.php";';
                                    $alert .= '</script>';
                                    echo $alert;
                                    exit();
                    
                                } else {
                                    ?>
                                        <div class="alert alert-warning" role="alert">
                                        แจ้งชำระเงินไม่สำเร็จ!
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
                    echo 'ereeer';
                    $new_img_name = '';
                }
            } elseif($result_check['order_status'] == '2') {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("เลขที่ใบสั่งสินค้ามีปัญหา โปรดติดต่อร้านค้า!");';
                $alert .= 'window.location.href = "contac.php";';
                $alert .= '</script>';
                echo $alert;
            } elseif($result_check['order_status'] == '3' || $result_check['order_status'] == '4') {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("เลขที่ใบสั่งสินค้านี้ชำระเงินเรียบร้อยแล้ว!");';
                $alert .= 'window.location.href = "";';
                $alert .= '</script>';
                echo $alert;
            } else {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("แจ้งชำระเงินไม่สำเร็จ!");';
                $alert .= 'window.location.href = "";';
                $alert .= '</script>';
                echo $alert;
            }
        } else {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("ไม่มีเลขที่ใบสั่งสินค้านี้!");';
            $alert .= 'window.location.href = "";';
            $alert .= '</script>';
            echo $alert;
        }
    }
    ?>
    
    <div class="container">
        <div class="product-cat">
            <strong>แจ้งชำระเงิน</strong>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 mt-4">
                <table class="table table-hover table-bordered ">
                    <thead>
                        <tr class="table-success">
                        <th scope="col" class="align-middle text-center">ลำดับ</th>
                        <th scope="col" class="align-middle text-center">รูปภาพ</th>
                        <th scope="col" class="align-middle text-center">ชื่อธนาคาร</th>
                        <th scope="col" class="align-middle text-center">เลขบัญชี</th>
                        <th scope="col" class="align-middle text-center">ชื่อเจ้าของบัญชี</th>
                        <!-- <th scope="col" class="align-middle text-center">เมนู</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php if(isset($query_bank) && !empty($query_bank)):
                        $i = 1;
                                foreach($query_bank as $item):?>
                        <tr>
                            <td class="align-middle"><?=$i++?></td>
                            <td class="align-middle"><img src="admin/upload/bank/<?=$item['bank_pic']?>" width="100" ></td>
                            <td class="align-middle"><?=$item['bank_name'] ?></td>
                            <td class="align-middle"><?=$item['bank_number'] ?></td>
                            <td class="align-middle"><?=$item['bank_owner'] ?></td>                            
                        </tr>
                                        <?php endforeach;?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <div class="card-body">
                    <form action="" method="post"  enctype='multipart/form-data'>
                        <div class="row gutters">
                            <div class="col-xl-12 ">
                                <h4 class="mb-2 text-secondary">แจ้งชำระเงิน</h4>
                            </div>
                            <div class="col-xl-6 mt-3 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="order_id" placeholder="name@example.com" id="cleartext"
                                    autocomplete="off" value="<?=(isset($order_id) && !empty($order_id) ? $order_id : '')?>" required>
                                    <label for="floatingInput">เลขที่ใบสั่งสินค้า<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="mb-3 col-xl-12">
                                <label  class="form-label">ภาพใบเสร็จการโอน<span class="text-danger">*</span></label>
                                    <?php foreach($errors as $data):?>
                                    <p class="text-danger"><?php echo $data; ?></p>
                                <?php endforeach; ?>
                                <div>
                                    <img id="img"  width="250" height="250"/>
                                </div>
                                <input  type="file" class="form-control" name="pay_pic" placeholder="picture" autocomplete="off" required
                                        onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="form-floating mb-3 col-xl-6">
                                <select name="bank_id" class="form-select" id="floatingSelect" required>
                                    <option value="" selected disabled>เลือกบัญชีที่โอนเข้า<span class="text-danger">*</span></option>
                                    <?php foreach($query_bank as $data):?>
                                    <option value="<?=$data['bank_id']?>"><?=(isset($data['bank_name']) && !empty($data['bank_number']) ? $data['bank_name'].' '.$data['bank_number'] : '')?></option>
                                    <?php endforeach; ?>    
                                </select>
                                <label for="floatingSelect">โอนเงินเข้าบัญชี<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="pay_price" placeholder="name@example.com" id="cleartext"
                                    autocomplete="off" min="0" value="" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" required>
                                    <label for="floatingInput">จำนวนเงินที่โอน<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="pay_date" placeholder="name@example.com" id="cleartext"
                                    autocomplete="off" required>
                                    <label for="floatingInput">วันที่โอน<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="pay_tel" placeholder="name@example.com" id="cleartext"
                                    autocomplete="off" maxlength="14" required>
                                    <label for="floatingInput">เบอร์โทรติดต่อกลับ<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <div class="form-floating mb-3">
                                    <textarea type="date" class="form-control" name="pay_contact" placeholder="name@example.com" style="height: 150px"></textarea>                                   
                                    <label for="floatingInput">รายละเอียดอื่นๆถึงร้านค้า</label>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </form>
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