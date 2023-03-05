<?php
include('connection/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>
    <?php
    if(isset($_GET['action'])){
        if($_GET['action'] == 'delete'){
            foreach($_SESSION['shopping_cart'] as $keys => $values){
                if($values['item_p_id'] == $_GET['product_id'] && $values['item_ps_id'] == $_GET['ps_id']){
                    unset($_SESSION['shopping_cart'][$keys]);
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("ลบไอเทมสินค้าสำเร็จ!");';
                    $alert .= 'window.location.href = ""';
                    $alert .= '</script>';
                    echo $alert;
                }
            }
        }
    }
    $sql_tran = "SELECT * FROM db_transport WHERE transport_id = 1";
    $query_tran = mysqli_query($conn, $sql_tran);
    $result_tran = mysqli_fetch_assoc($query_tran);

    //query address
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        $id = ($_SESSION['user_id']);
        $sql = "SELECT * FROM db_member_address t1
            INNER JOIN provinces t2 ON t1.m_address_pro = t2.id
            INNER JOIN districts t3 ON t1.m_address_amp = t3.id
            INNER JOIN subdistricts t4 ON t1.m_address_dist = t4.id WHERE t1.m_id = '$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }
    

    // query address
    $sql_province = "SELECT * FROM provinces ORDER BY provinces_in_thai ASC";
    $query_province = mysqli_query($conn, $sql_province);
    ?>
    
    <!-- about us --------------------------------------->
    <div class="container">
        <div class="product-cat">
            <strong>ตะกร้าสินค้า</strong>
        </div>
        <div class="row">
            <div class="col-lg-7 mt-4">
                <table class="table table-bordered mb-5">
                    <thead class="text-center">
                            <tr class="table-dark">
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อต้นไม้</th>
                            <th scope="col">ขนาดต้นไม้</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">น้ำหนัก</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">ราคารวม</th>
                            <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            if(!empty($_SESSION['shopping_cart'])) {
                                $total=0;
                                $total_weight=0;
                                $i=1;
                                foreach($_SESSION['shopping_cart'] as $key => $value){
                                    $total=$total+($value['item_price'] * $value['item_quan']);
                                    $total_weight=$total_weight+($value['item_weight'] * $value['item_quan']);
                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $value['item_name'] ?></td>
                                            <td><?php echo $value['item_size'] ?>"</td>
                                            <td><?php echo $value['item_quan']?></td>
                                            <td><?php echo $value['item_weight']?></td>
                                            <td>฿<?php echo number_format($value['item_price'],2) ?></td>
                                            <td>฿<?php echo number_format($value['item_price'] * $value['item_quan'],2) ?></td>
                                            <td><a href="cart_detail.php?action=delete&product_id=<?php echo $value['item_p_id'] ?>&ps_id=<?php echo $value['item_ps_id']?>"><button class='btn btn-sm btn-outline-danger'>ลบ</button></a></td>
                                        </tr>
                        <?php
                                    $i++;
                                }
                            }
                            else {?>
                                <div class="alert alert-dark" role="alert">
                                    <p class="text-center">ไม่มีสินค้าในตะกร้า</p>
                                </div>
                        <?php } ?>
                        

                    </tbody>
                </table>
            </div>

            <div class="col-lg-5 mt-4 ">
                <div class="col-lg-12 border bg-light rounded p-4">
                    <div class="col mt-4">
                        <h4>น้ำหนักรวม:  <label class="text-success"><?php if(!empty($total_weight)){ echo $total_weight; }?> กรัม</label></h4> 
                    </div>
                    <div class="col mt-4">
                        <h4>ราคารวม:  <label class="text-success">฿
                        <?php if(!empty($total)){ 
                        $_SESSION['price_total'] = $total;
                        echo number_format($total,2); }?></label></h4> 
                    </div>
                    <form action="checkout.php" method="post">
                        <div class="col mt-4">
                            <input type="hidden" name="total" value="<?php if(!empty($total)){ echo number_format($total,2);}?>">
                            <?php 
                            if(isset($total_weight) && !empty($total_weight)){
                                
                                // for normal
                                $sql_normal = "SELECT t1.transport_id,t1.transport_name,t2.normal_price
                                            FROM db_transport t1 
                                            INNER JOIN thaipost_normalrate t2 ON t1.transport_id = t2.transport_id
                                            WHERE $total_weight BETWEEN t2.normal_weight_from AND t2.normal_weight_to";
                                $query_normal = mysqli_query($conn, $sql_normal);
                                $result_normal = mysqli_fetch_assoc($query_normal);
                                // print_r($result_normal);
                                
                            }
                            ?>

                            <?php if(isset($result_normal) && !empty($result_normal)):
                                $last_price = $total+$result_normal['normal_price'];
                                ?>
                                <input type="hidden" name="freight_price" value="<?php echo $result_normal['normal_price']?>">
                                <input type="hidden" name="last_price" value="<?php echo $last_price?>" >
                                <input type="hidden" name="tran_id" value="1" >
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"   name="weight_price" value="<?php echo number_format($result_normal['normal_price'],2);?>">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <?php echo $result_normal['transport_name'].' +'.$result_normal['normal_price'];?>
                                            </label>
                                        </div>
                                <?php elseif (isset($total_weight) && !empty($total_weight && ($total_weight > 11000 && $total_weight <= 200000))):
                                                $weight1 = $total_weight-11000;
                                                $multi_price = ($weight1/1000)*15;
                                                $grand_price_weight = $multi_price+170;
                                                $last_price = $total+$grand_price_weight;
                                ?>              <input type="hidden" name="freight_price" value="<?php echo $grand_price_weight ?>">
                                                <input type="hidden" name="last_price" value="<?php echo $last_price?>" >
                                                <input type="hidden" name="tran_id" value="1" >
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"  name="weight_price" value="<?php echo number_format($grand_price_weight,2)?>">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        <?php echo $result_tran['transport_name'].' +'.$grand_price_weight;?>
                                                    </label>
                                                </div>
                                    
                                
                                <?php  elseif(isset($total_weight) && !empty($total_weight && $total_weight>200)) :?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        <?php echo "น้ำหนักเกินขนาด (Max=200kg)"?>
                                                    </label>
                                            </div>
                                <?php       
                                endif;
                                ?>


                                           
                        </div>
                        <div class="col mt-5">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h4 class="mb-2 text-success">ที่อยู่ผู้รับ</h4>
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
                                                <select name="province" class="form-select" id="province" required >
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
                                                autocomplete="off" value="" required>
                                                <label for="floatingInput">รหัสไปรษณีย์</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="tel" placeholder="name@example.com" 
                                                autocomplete="off" value="<?php if(isset($result['m_address_tel']) && !empty($result['m_address_tel'])) 
                                                { echo $result['m_address_tel'];}?>" required>
                                                <label for="floatingInput">เบอร์โทร</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
                            <div class="col mt-4">
                                <div class="row gutters">
                                    <div class="col-xl-12 mb-4">
                                        <div class="text-center">
                                            <button type="submit" id="submit" name="submit" class="btn btn-success">สั่งซื้อ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            </div>
                        </div>
                    </form>
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