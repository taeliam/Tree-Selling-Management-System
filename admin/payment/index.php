
<?php
    $sql = "SELECT * 
    FROM db_payment
    INNER JOIN db_bank_account ON db_payment.bank_id = db_bank_account.bank_id";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลการแจ้งชำระ</h1>
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
                        <th scope="col">จำนวน</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">เลขที่ใบสั่งสินค้า</th>
                        <th scope="col">โอนเงินเข้าบัญชี</th>
                        <th scope="col">จำนวนเงินที่โอน</th>
                        <th scope="col">วันที่โอน</th>
                        <th scope="col">เบอร์โทรติดต่อกลับ> </th>
                        <th scope="col">เมนู</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach($query as $data):
                    ?>
                        <tr>
                            <td class="align-middle"><?=$i++?></td>
                            <td class="align-middle"><img src="upload/payment/<?=$data['pay_pic']?>" width="100"></td>
                            <td class="align-middle"><?=$data['order_id']?></td>
                            <td class="align-middle"><?=$data['bank_number']?></td>
                            <td class="align-middle"><?=number_format($data['pay_price'],2)?></td>
                            <td class="align-middle"><?=$data['pay_date']?></td>
                            <td class="align-middle"><?=$data['pay_tel']?></td>
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['pay_id']?>" class="btn btn-sm btn-warning">รายละเอียด</a>
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['pay_id']?>" onclick="return confirm('ลบข้อมูลแจ้งชำระเลขที่ใบสั่งซื้อ  <?=$data['order_id']?> ?')" 
                                class="btn btn-sm btn-danger">ลบ</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
             </table>
        </div><!--//app-card-body-->
    </div><!--//app-card-->
</div>
</div><!--//row-->

<?php
mysqli_close($conn)
?>
