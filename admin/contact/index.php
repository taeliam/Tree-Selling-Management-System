

<?php
    $sql = "SELECT * FROM db_contact";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ข้อมูลการติดต่อ</h1>
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
                        <th scope="col">หัวข้อ</th>
                        <th scope="col">รายละเอียด</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">อีเมล์</th>
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
                            <td class="align-middle"><?=$data['contact_topic']?></td>
                            <td style='vertical-align: top; width: 300px; word-wrap: break-word;' class="align-middle">
                                <div style="width: inherit">
                                    <?=$data['contact_text']?>
                                </div>
                                </td>
                            <td class="align-middle"><?=$data['contact_name']?></td>
                            <td class="align-middle"><?=$data['contact_email']?></td>
                            <td class="align-middle"><?=$data['contact_date']?></td>
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['contact_id']?>" onclick="return confirm('ลบการติดต่อ<?=$data['contact_name']?>?')" 
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
