<?php
include('connection/connection.php');
// query about us
$id = 1;
$sql = "SELECT * FROM db_about WHERE about_id = '$id'";
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
            <strong>เกี่ยวกับเรา</strong>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <div class="about-us">
                    <h2><p class="about-name">ชื่อเว็บไซต์</p></h2>
                    <p><?=nl2br($result['about_name'])?></p>
                    <br>
                    <h2><p class="about-name">รายละเอียดเว็บไซต์</p></h2>
                    <p><?=nl2br($result['about_desc'])?></p>
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