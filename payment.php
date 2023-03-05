

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
        $sql = "SELECT *
                FROM db_order t1
                INNER JOIN db_member t2 ON t1.m_id = t2.m_id
                INNER JOIN db_transport t3 ON t1.transport_id
                INNER JOIN provinces t4 ON t4.id = t1.order_prov
                INNER JOIN districts t5 ON t5.id = t1.order_dist
                INNER JOIN subdistricts t6 ON t6.id = t1.order_subdist
                WHERE t1.m_id='$m_id' ORDER BY t1.order_status";
        $query = mysqli_query($conn, $sql);
        // $result = mysqli_fetch_assoc($query);
        // print "<pre>";
        // print_r($query);
        // print "</pre>";
    }
    ?>
    
    <div class="container">
        <div class="product-cat">
            <strong>รายการที่สั่ง</strong>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <table class="table table-hover table-bordered ">
                    <thead>
                        <tr class="table-success">
                        <th scope="col" class="align-middle text-center">ลำดับ</th>
                        <th scope="col" class="align-middle text-center">เลขที่ใบสั่งสินค้า</th>
                        <th scope="col" class="align-middle text-center">บัญชีผู้ใช้</th>
                        <th scope="col" class="align-middle text-center">ชื่อ-นามสกุล</th>
                        <th scope="col" class="align-middle text-center">ขนส่ง</th>
                        <th scope="col" class="align-middle text-center">ราคารวม</th>
                        <th scope="col" class="align-middle text-center">ที่จัดส่ง</th>
                        <th scope="col" class="align-middle text-center">รหัสไปรษณีย์</th>
                        <th scope="col" class="align-middle text-center">สถานะ</th>
                        <th scope="col" class="align-middle text-center">วันที่สั่ง</th>
                        <th scope="col" class="align-middle text-center">เมนู</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php if(isset($query) && !empty($query)):
                        $i = 1;
                                foreach($query as $key => $item):?>
                        <tr>
                            <td class="align-middle"><?=$i++?></td>
                            <td class="align-middle"><?=$item['order_id'] ?></td>
                            <td class="align-middle"><?=$item['m_username'] ?></td>
                            <td class="align-middle"><?=$item['order_name'] ?> <?=$item['order_lname'] ?></td>
                            <td class="align-middle"><?=$item['transport_name'] ?></td>
                            <td class="align-middle"><?=number_format($item['order_total'],2) ?></td>
                            <td class="align-middle">เลขที่ <?=$item['order_hnumber']?> หมู่ <?=$item['order_moo']?> ตำบล<?=$item['subdistricts_in_thai']?> 
                            อำเภอ<?=$item['districts_in_thai']?> จังหวัด<?=$item['provinces_in_thai']?> รหัสไปรษณีย์ <?=$item['zip_code']?></td>
                            <td class="align-middle"><?=$item['zip_code']?></td>
                            <td class="align-middle">
                                <?php if($item['order_status'] == '1'): ?>
                                        <label class="text-warning">รอการชำระเงิน</label>
                                <?php   elseif($item['order_status'] == '2'): ?>
                                        <label class="text-danger">ชำระเงินไม่ถูกต้อง</label>
                                        
                                <?php       elseif($item['order_status'] == '3'): ?>
                                        <label class="text-secondary">กำลังจัดส่ง</label>
                                        
                                <?php      elseif($item['order_status'] == '4'): ?>
                                        <label class="text-success">จัดส่งสำเร็จ</label>
                                        
                                        
                                        
                                <?php endif; ?>
                            </td>
                            <td class="align-middle"><?=$item['order_date']?></td>
                            
                            <td class="align-middle"><a href="payment_bank.php?order_id=<?php echo $item['order_id']?>"><button class='btn btn-sm btn-outline-success'>ชำระเงิน</button></a></td>
                        </tr>
                                        <?php endforeach;?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                
    <!-- script --------------------------------------->
    <?php include('include/script.php')?>


    


</body>
</html>