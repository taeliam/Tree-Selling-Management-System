
<?php
    $sql = "SELECT * FROM db_product_type";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลประเภทต้นไม้</h1>
    </div>
    <div class="col-auto">
         
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">                      
        <div class="app-card-body">
            <a href="?page=<?=$_GET['page']?>&function=insert" class="btn btn-primary text-white ">เพิ่มข้อมูลประเภทต้นไม้</a>
            <table class="table table-hover table-bordered" id="tableadmin">
                <thead >
                    <tr>
                        <th scope="col">จำนวน</th>
                        <th scope="col">ชื่อประเภทต้นไม้</th>
                        <th scope="col">เมนู</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach($query as $data):
                    ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$data['pt_name']?></td>
                            <td>
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['pt_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['pt_id']?>" onclick="return confirm('ลบข้อมูลประเภท <?=$data['pt_name']?>?')" 
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

<!-- <script>
    $(document).ready( function () {
        $('#tableadmin').DataTable();
    } );
</script> -->
<?php
mysqli_close($conn)
?>
