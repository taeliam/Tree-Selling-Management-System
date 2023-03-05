<?php 
include('connection/connection.php');

// query about us
$id = 1;
$sql = "SELECT * FROM db_about WHERE about_id = '$id'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);

if  (isset($_POST) && !empty($_POST)) {
    $name = mysqli_real_escape_string($conn, $_POST['contact_name']);
    $email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $topic = mysqli_real_escape_string($conn, $_POST['contact_topic']);
    $text = mysqli_real_escape_string($conn, $_POST['contact_text']);

    $sql1 = "INSERT INTO db_contact(contact_name, contact_email, contact_topic, contact_text) 
    VALUES ('$name', '$email', '$topic', '$text')";
        if (mysqli_query($conn, $sql1)) {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("ส่งข้อความสำเร็จ!");';
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
    mysqli_close($conn);
}
?> 

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

    <!-- contact us --------------------------------------->
    <div class="container">
        <div class="row">
            <div class="product-cat">
                <strong>ติดต่อเรา</strong>
            </div>
            <div class="col mt-5">
                <h2 class="contact-us">ส่งข้อความถึงเรา</h2>
                <form action="" method="post">
                    <div class="form-floating mt-5 mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="contact_name"  required>
                        <label for="floatingInput">ชื่อ</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingPassword" name="contact_email" required>
                        <label for="floatingPassword">อีเมล์</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="contact_topic" required>
                        <label for="floatingInput">หัวข้อ</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="contact_text" required></textarea>
                        <label for="floatingTextarea">รายระเอียด</label>
                    </div>
                    <button type="submit" class="btn btn-success">ส่ง</button>
                </form>
            </div>
            <div class="col mt-5">
                <h2 class="contact-us">ติดต่อเรา</h2>
                <div class="contact-at mt-5 ">
                    <h2><p class="about-name">เบอร์โทรศัพท์</p></h2>
                    <p><?=nl2br($result['about_tel'])?></p>
                    <h2><p class="about-name">อีเมล์</p></h2>
                    <p><?=nl2br($result['about_email'])?></p>
                    <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9176.605322815796!2d103.24918680901081!3d16.244600796162583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a6a4f3069f8b%3A0xf02b541f28931c0!2sMahasarakham%20University!5e0!3m2!1sen!2sth!4v1632999659983!5m2!1sen!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></p>
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