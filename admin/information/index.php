
<?php
    $sql = "SELECT * FROM db_info";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลข่าวสาร</h1>
    </div>
    <div class="col-auto">
         
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">                      
        <div class="app-card-body">
            <a href="?page=<?=$_GET['page']?>&function=insert" class="btn btn-primary text-white ">เพิ่มข้อมูลข่าวสาร</a>
            <table class="table table-hover table-bordered" id="tableadmin">
                <thead >
                    <tr>
                        <th scope="col">จำนวน</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">หัวข้อ</th>
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
                            <td class="align-middle"><img src="upload/info/<?=$data['info_pic']?>" width="100" ></td>
                            <td class="align-middle"><?=$data['info_header']?></td>
                            <td class="align-middle"><?=$data['info_date']?></td>
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['info_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['info_id']?>" onclick="return confirm('ลบข้อมูลข่าวสาร <?=$data['info_header']?>?')" 
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
