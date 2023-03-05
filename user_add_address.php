
<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>
    <?php
    include('connection/connection.php');

    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM db_member_address WHERE m_id = '$id'";
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
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("คุณได้เพิ่มที่อยู่ผู้รับแล้วแล้ว!");';
            $alert .= 'window.location.href = "user_address.php";';
            $alert .= '</script>';
            echo $alert;
        } else {
            $sql = "INSERT INTO db_member_address(m_id,m_address_name,m_address_lname,m_address_num,m_address_moo,
                    m_address_dist,m_address_amp,m_address_pro,m_address_email,m_address_tel,m_address_zip)
                     VALUE('$id','$name','$lname','$h_number','$moo','$subdistrict','$district','$province','$email','$tel','$zipcode')";
            if (mysqli_query($conn, $sql)) {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("เพิ่มที่อยู่สำเร็จ!");';
                $alert .= 'window.location.href = "user_address.php";';
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
                <strong>เพิ่มที่อยู่ผู้รับ</strong>
            </div>

            <div class="col mt-5">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-2 text-secondary">เพิ่ม</h4>
                                </div>
                                <div class="col-xl-6 mt-3 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="name@example.com" 
                                        autocomplete="off" required>
                                        <label for="floatingInput">ชื่อ</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mt-3 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="lname" placeholder="name@example.com" 
                                        autocomplete="off" required>
                                        <label for="floatingInput">นามสกุล</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="h_number" placeholder="name@example.com" 
                                        autocomplete="off" required>
                                        <label for="floatingInput">เลขที่</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="moo" placeholder="name@example.com" 
                                        autocomplete="off" required>
                                        <label for="floatingInput">หมู่</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <select name="province" class="form-select" id="province" required>
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
                                        <select name="district" class="form-select" id="district" required>
                                            
                                        </select>
                                        <label for="floatingSelect">อำเภอ</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <div class="form-floating mb-3">
                                        <select name="subdistrict" class="form-select" id="subdistrict" required>
                                            
                                        </select>
                                        <label for="floatingSelect">ตำบล</label>
                                    </div>
                                </div>
                                <div class="col-xl-6  mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="zipcode" placeholder="name@example.com" id="zipcode"
                                        autocomplete="off" required>
                                        <label for="floatingInput">รหัสไปรษณีย์</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="name@example.com" 
                                        autocomplete="off" required>
                                        <label for="floatingInput">อีเมล์</label>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="tel" placeholder="name@example.com" 
                                        autocomplete="off" required>
                                        <label for="floatingInput">เบอร์โทร</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12">
                                    <div class="text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-success">เพิ่มที่อยู่</button>
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