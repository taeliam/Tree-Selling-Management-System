

<?php
    $sql = "SELECT * 
            FROM db_product_size ps
            INNER JOIN db_product pt ON ps.product_id = pt.product_id";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลขนาดต้นไม้</h1>
    </div>
    <div class="col-auto">
         <a href="?page=<?=$_GET['page'] = 'product'?>" class="btn app-btn-primary">ข้อมูลต้นไม้</a>
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
                        <th scope="col">ชื่อต้นไม้</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ขนาด</th>
                        <th scope="col">น้ำหนัก</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">วันที่เพิ่ม</th>
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
                            <td class="align-middle"><?=$data['p_name']?></td>
                            <td class="align-middle"><img src="upload/product_size/<?=$data['ps_pic']?>" width="100" ></td>
                            <td class="align-middle">กระถาง <?=$data['ps_size']?>"</td>
                            <td class="align-middle"><?=$data['ps_weight']?> กรัม</td>
                            <td class="align-middle">฿<?=number_format($data['ps_price'],2)?></td>
                            <td class="align-middle"><?=$data['ps_date']?></td>
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page'] = 'product_size'?>&function=update&id=<?=$data['ps_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="?page=<?=$_GET['page'] = 'product_size'?>&function=delete&id=<?=$data['ps_id']?>" onclick="return confirm('ลบข้อมูลขนาดต้นไม้ <?=$data['p_name']?>?')" 
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
