<?php 
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * 
                FROM db_payment
                INNER JOIN db_bank_account ON db_payment.bank_id = db_bank_account.bank_id WHERE pay_id ='$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

?> 
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">รายระเอียดการแจ้งชำระ</h1>
    </div>
    <div class="col-auto">
         <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
    <hr class="mb-4">
    <div class="row g-4 settings-section justify-content-center">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">                      
                <div class="app-card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 ">
                            <h4 class="mb-2 text-secondary">แจ้งชำระเงิน</h4>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h6 class="mb-2 text-muted">เลขที่ใบสั่งสินค้า</h6>
                            <?php if(isset($result['order_id'])):?>
                            <pre class="fs-5">   <?=$result['order_id']?> </pre>
                            <?php else: ?>
                            <pre class="fs-5">   - </pre>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h6 class="mb-2 text-muted">ภาพใบเสร็จการโอน</h6>
                            <?php if(isset($result['pay_pic'])):?>
                            <pre class="fs-5">   <img src="upload/payment/<?=$result['pay_pic']?>" width="300"> </pre>
                            <?php else: ?>
                            <pre class="fs-5">   - </pre>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h6 class="mb-2 text-muted">โอนเงินเข้าบัญชี</h6>
                            <?php if(isset($result['pay_pic'])):?>
                            <pre class="fs-5"> <?=$result['bank_name']?>  <?=$result['bank_number']?> </pre>
                            <?php else: ?>
                            <pre class="fs-5">   - </pre>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h6 class="mb-2 text-muted">จำนวนเงินที่โอน</h6>
                            <?php if(isset($result['pay_pic'])):?>
                            <pre class="fs-5"> <?=$result['pay_price']?> บาท</pre>
                            <?php else: ?>
                            <pre class="fs-5">   - </pre>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h6 class="mb-2 text-muted">วันที่โอน</h6>
                            <?php if(isset($result['pay_pic'])):?>
                            <pre class="fs-5"> <?=$result['pay_date']?> </pre>
                            <?php else: ?>
                            <pre class="fs-5">   - </pre>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-12 mt-3">
                            <h6 class="mb-2 text-muted">รายละเอียดอื่นๆถึงร้านค้า</h6>
                            <?php if(isset($result['pay_contact'])):?>
                            <pre class="fs-5"> <?=$result['pay_contact']?>- </pre>
                            <?php else: ?>
                            <pre class="fs-5">   - </pre>
                            <?php endif; ?>
                        </div>
                    </div>

                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->