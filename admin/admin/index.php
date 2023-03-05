
<?php
    $user_login = $_SESSION['user_login'];
    $sql = "SELECT * FROM db_admin WHERE ad_username != '$user_login'";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ตารางแอดมิน</h1>
    </div>
    <div class="col-auto">
         
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">
<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">                      
        <div class="app-card-body">
            <a href="?page=<?=$_GET['page']?>&function=insert" class="btn btn-primary text-white ">Add admin</a>
            <table class="table table-hover table-bordered" id="tableadmin">
                <thead >
                    <tr>
                        <th scope="col">ชื่อผู้ใช้</th>
                        <th scope="col">อีเมล์</th>
                        <th scope="col">ชื่อ-นามสกุล</th>
                        <th scope="col">เบอร์โทรศัพท์</th>
                        <th scope="col">ระดับแอดมิน</th>
                        <th scope="col">เมนู</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query as $data):?>
                        <tr>
                            <td class="align-middle"><?=$data['ad_username']?></td>
                            <td class="align-middle"><?=$data['ad_email']?></td>
                            <td class="align-middle"><?=$data['ad_name'].' '.$data['ad_lname']?></td>
                            <td class="align-middle"><?=$data['ad_tel']?></td>
                            <td class="align-middle"><?=$data['ad_level']?></td>
                            <td class="align-middle">
                                <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['ad_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="?page=<?=$_GET['page']?>&function=resetpwd&id=<?=$data['ad_id']?>" class="btn btn-sm btn-light">รีเซ็ตรหัสผ่าน</a>
                                <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['ad_id']?>" onclick="return confirm('Delete this <?=$data['ad_username']?> admin?')" 
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
