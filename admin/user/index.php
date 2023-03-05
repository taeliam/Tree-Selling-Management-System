
<?php
    $sql = "SELECT * FROM db_member";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ตางรางข้อมูลผู้ใช้</h1>
    </div>
    <div class="col-auto">
         
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
                        <th scope="col">ชื่อผู้ใช้</th>
                        <th scope="col">ชื่อ-นามสกุล</th>
                        <th scope="col">อีเมล์</th>
                        <th scope="col">เบอร์โทรศัพท์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query as $data):?>
                        <tr>
                            <td class="align-middle"><?=$data['m_username']?></td>
                            <td class="align-middle"><?=$data['m_name'].' '.$data['m_lname']?></td>
                            <td class="align-middle"><?=$data['m_email']?></td>
                            <td class="align-middle"><?=$data['m_tel']?></td>

                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['m_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['m_id']?>" onclick="return confirm('ลบผู้ใช้ <?=$data['m_username']?>?')" 
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
