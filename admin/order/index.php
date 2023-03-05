
<?php
    $sql = "SELECT *
            FROM db_order t1
            INNER JOIN db_member t2 ON t1.m_id = t2.m_id
            INNER JOIN db_transport t3 ON t1.transport_id
            INNER JOIN provinces t4 ON t4.id = t1.order_prov
            INNER JOIN districts t5 ON t5.id = t1.order_dist
            INNER JOIN subdistricts t6 ON t6.id = t1.order_subdist
            ORDER BY t1.order_id";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลการสั่งสินค้า</h1>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">                      
        <div class="app-card-body">
            <table class="table table-hover table-bordered" id="tableadmin">
                <thead >
                    <tr>
                        <th scope="col" class="align-middle text-center">ลำดับ</th>
                        <th scope="col" class="align-middle text-center">รหัสใบสั่งสินค้า</th>
                        <th scope="col" class="align-middle text-center">บัญชีผู้ใช้</th>
                        <th scope="col" class="align-middle text-center">ชื่อ-นามสกุล</th>
                        <th scope="col" class="align-middle text-center">ขนส่ง</th>
                        <th scope="col" class="align-middle text-center">ราคารวม</th>
                        <th scope="col" class="align-middle text-center">ที่จัดส่ง</th>
                        <th scope="col" class="align-middle text-center">รหัสไปรษณีย์</th>
                        <th scope="col" class="align-middle text-center">เบอร์โทรศัพท์</th>
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
                            <td class="align-middle"><?=$item['order_tel']?></td>
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
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$item['order_id']?>" class="btn btn-sm btn-warning">อัปเดตสถานะ</a>
                            </td>
                        </tr>
                                        <?php endforeach;?>
                        <?php endif; ?>
                    </tbody>
             </table>
        </div><!--//app-card-body-->
    </div><!--//app-card-->
</div>
</div><!--//row-->

<?php
mysqli_close($conn)
?>
