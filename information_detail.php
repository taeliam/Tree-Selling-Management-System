<?php
include('connection/connection.php');
// query about us
$sql = "SELECT * FROM db_info";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

    <!-- about us --------------------------------------->
    <div class="container">
        <div class="product-cat">
            <strong>ข้อมูลข่าวสาร</strong>
        </div>
        <div class="row">
            <div class="col mt-4">
                <div class="img">
                    <img src="admin/upload/info/<?=$result['info_pic']?>" class="border align" align="right" width="400px">
                </div>
            </div>
            <div class="col mt-4">
                <div class="detail">
                    <p><?=nl2br($result['info_detail'])?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                
    <!-- script --------------------------------------->
    <?php include('include/script.php')?>



</body>
</html>