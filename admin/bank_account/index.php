
<?php
    $sql = "SELECT * FROM db_bank_account";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลบัญชีธนาคาร</h1>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">                      
        <div class="app-card-body">
            <a href="?page=<?=$_GET['page']?>&function=insert" class="btn btn-primary text-white ">เพิ่มข้อมูลบัญชีธนาคาร</a>
            <table class="table table-hover table-bordered" id="tableadmin">
                <thead >
                    <tr>
                        <th scope="col">จำนวน</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ชื่อธนาคาร</th>
                        <th scope="col">เลขที่บัญชี</th>
                        <th scope="col">ชื่อเจ้าของบัญชี</th>
                        <th scope="col">สาขาบัญชี</th>
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
                            <td class="align-middle"><img src="upload/bank/<?=$data['bank_pic']?>" width="100"></td>
                            <td class="align-middle"><?=$data['bank_name']?></td>
                            <td class="align-middle"><?=$data['bank_number']?></td>
                            <td class="align-middle"><?=$data['bank_owner']?></td>
                            <td class="align-middle"><?=$data['bank_branch']?></td>
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['bank_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['bank_id']?>" onclick="return confirm('ลบข้อมูลบัญชีธนาคาร <?=$data['bank_name']?> ?')" 
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
