

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>
    <?php
    include('connection/connection.php');
    // query address 
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM db_member_address t1
            INNER JOIN provinces t2 ON t1.m_address_pro = t2.id
            INNER JOIN districts t3 ON t1.m_address_amp = t3.id
            INNER JOIN subdistricts t4 ON t1.m_address_dist = t4.id WHERE t1.m_id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    // print_r($result);

    if(isset($_POST) && !empty($_POST)){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $h_number = mysqli_real_escape_string($conn, $_POST['h_number']);
        $moo = mysqli_real_escape_string($conn, $_POST['moo']);
        $subdistrict = mysqli_real_escape_string($conn, $_POST['subdistrict']);
        $district = mysqli_real_escape_string($conn, $_POST['district']);
        $province = mysqli_real_escape_string($conn, $_POST['province']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

        $row_check = mysqli_num_rows($query);
        if($row_check > 0) {
            $sql_update = "UPDATE db_member_address SET m_address_name ='$name', m_address_lname = '$lname', m_address_num = '$h_number', m_address_moo = '$moo',
                            m_address_email = '$email', m_address_tel = '$tel', m_address_pro = '$province', m_address_amp = '$district', m_address_dist = '$subdistrict',
                            m_address_zip = '$zipcode' WHERE m_id = '$id'";
            if (mysqli_query($conn, $sql_update)) {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("แก้ไขที่อยู่ผู้รับสำเร็จ!");';
                $alert .= 'window.location.href = "";';
                $alert .= '</script>';
                echo $alert;
                exit();
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                        บางอย่างผิดพลาด!
                </div>
            <?php
            }
           
        } else {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("กรุณาเพิ่มที่อยู่ผู้รับ!");';
            $alert .= 'window.location.href = "user_add_address.php";';
            $alert .= '</script>';
            echo $alert;
        }
    }

    // query address
    $sql_province = "SELECT * FROM provinces ORDER BY provinces_in_thai ASC";
    $query_province = mysqli_query($conn, $sql_province);

    ?>

    <!-- address --------------------------------------->
    <div class="container">
        <div class="row">
            <div class="product-cat">
                <strong>ที่อยู่ผู้รับ</strong>
            </div>
            <div class="col mt-5">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h4 class="mb-2 text-success">ที่อยู่</h4>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">ชื่อ-นามสกุล</h6>
                                <?php if(isset($result['m_address_name']) && !empty($result['m_address_name']) && isset($result['m_address_lname']) && !empty($result['m_address_lname'])):?>
                                <pre class="fs-5">   <?=$result['m_address_name']?> <?=$result['m_address_lname']?></pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">เลขที่</h6>
                                <?php if(isset($result['m_address_num']) && !empty($result['m_address_num'])):?>
                                <pre class="fs-5">   <?=$result['m_address_num']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">หมู่</h6>
                                <?php if(isset($result['m_address_moo']) && !empty($result['m_address_moo'])):?>
                                <pre class="fs-5">   <?=$result['m_address_moo']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">ตำบล</h6>
                                <?php if(isset($result['subdistricts_in_thai']) && !empty($result['subdistricts_in_thai'])):?>
                                <pre class="fs-5">   <?=$result['subdistricts_in_thai']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">อำเภอ</h6>
                                <?php if(isset($result['districts_in_thai']) && !empty($result['districts_in_thai'])):?>
                                <pre class="fs-5">   <?=$result['districts_in_thai']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">จังหวัด</h6>
                                <?php if(isset($result['provinces_in_thai']) && !empty($result['provinces_in_thai'])):?>
                                <pre class="fs-5">   <?=$result['provinces_in_thai']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">รหัสไปรษณีย์</h6>
                                <?php if(isset($result['m_address_zip']) && !empty($result['m_address_zip'])):?>
                                <pre class="fs-5">   <?=$result['m_address_zip']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">อีเมล์</h6>
                                <?php if(isset($result['m_address_email']) && !empty($result['m_address_email'])):?>
                                <pre class="fs-5">   <?=$result['m_address_email']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <h6 class="mb-2 text-muted">เบอร์โทร</h6>
                                <?php if(isset($result['m_address_tel']) && !empty($result['m_address_tel'])):?>
                                <pre class="fs-5">   <?=$result['m_address_tel']?> </pre>
                                <?php else: ?>
                                <pre class="fs-5">   - </pre>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col mt-5">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-2 text-secondary">แก้ไขที่อยู่</h4>
                                </div>
                                <div class="col-xl-6 mt-3 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="name@example.com" 
                                        autocomplete="off" required value="<?php if(isset($result['m_address_name']) && !empty($result['m_address_name'])) 
                                        { echo $result['m_address_name'];}?>">
                                        <label for="floatingInput">ชื่อ</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mt-3 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="lname" placeholder="name@example.com" 
                                        autocomplete="off" required value="<?php if(isset($result['m_address_lname']) && !empty($result['m_address_lname'])) 
                                        { echo $result['m_address_lname'];}?>">
                                        <label for="floatingInput">นามสกุล</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="h_number" placeholder="name@example.com" 
                                        autocomplete="off" required value="<?php if(isset($result['m_address_num']) && !empty($result['m_address_num'])) 
                                        { echo $result['m_address_num'];}?>">
                                        <label for="floatingInput">เลขที่</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="moo" placeholder="name@example.com" 
                                        autocomplete="off" required value="<?php if(isset($result['m_address_moo']) && !empty($result['m_address_moo'])) 
                                        { echo $result['m_address_moo'];}?>">
                                        <label for="floatingInput">หมู่</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <select name="province" class="form-select" id="province" value="<?=$result['m_address_pro']?>" required >
                                            <option value="" selected disabled>กรุณาเลือกจังหวัด</option>
                                            <?php foreach ($query_province as $value) { ?>
                                                <option value="<?=$value['id']?>"><?=$value['provinces_in_thai']?></option>
                                                    
                                            <?php   }?>
                                        </select>
                                        <label for="floatingSelect">จังหวัด</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <select name="district" class="form-select" id="district" value="<?=$result['m_address_amp']?>" required>
                                            
                                        </select>
                                        <label for="floatingSelect">อำเภอ</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <select name="subdistrict" class="form-select" id="subdistrict" value="<?=$result['m_address_dist']?>" required>
                                            
                                        </select>
                                        <label for="floatingSelect">ตำบล</label>
                                    </div>
                                </div>
                                <div class="col-xl-6  mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="zipcode" placeholder="name@example.com" id="zipcode"
                                        autocomplete="off" value="" required>
                                        <label for="floatingInput">รหัสไปรษณีย์</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="name@example.com" 
                                        autocomplete="off" value="<?php if(isset($result['m_address_email']) && !empty($result['m_address_email'])) 
                                        { echo $result['m_address_email'];}?>" required>
                                        <label for="floatingInput">อีเมล์</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="tel" placeholder="name@example.com" 
                                        autocomplete="off" value="<?php if(isset($result['m_address_tel']) && !empty($result['m_address_tel'])) 
                                        { echo $result['m_address_tel'];}?>" required>
                                        <label for="floatingInput">เบอร์โทร</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12">
                                    <div class="text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-secondary">แก้ไขที่อยู่</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                
    <!-- script --------------------------------------->
    <?php include('include/script.php')?>


    <script type="text/javascript">
        $('#province').change(function(){
            var id_province = $(this).val();
            $.ajax({
                url: "ajax_address.php",
                type: "post",
                data: {id:id_province,function:'province'} ,
                success: function (data) {
                    $('#district').html(data);
                    $('#subdistrict').html('');
                    $('#zipcode').val('');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
        });
        $('#district').change(function(){
            var id_district = $(this).val();
            $.ajax({
                url: "ajax_address.php",
                type: "post",
                data: {id:id_district,function:'district'} ,
                success: function (data) {
                    $('#subdistrict').html(data);
                    $('#zipcode').val('');
                    // console.log(data)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
        });
        $('#subdistrict').change(function(){
            var id_subdistrict = $(this).val();
            $.ajax({
                url: "ajax_address.php",
                type: "post",
                data: {id:id_subdistrict,function:'subdistrict'} ,
                success: function (data) {
                    // console.log(data)
                    $('#zipcode').val(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
        });
       
    </script>


</body>
</html>