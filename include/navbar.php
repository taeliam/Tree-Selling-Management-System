<?php
include('connection/connection.php');
session_start();
$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$url = explode('.', $url[2]);

// register
if(isset($_POST['register']) && !empty($_POST['register'])){
    if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirmpsw']) && !empty(['confirmpsw'])) {
        $password = mysqli_real_escape_string($conn, sha1(md5($_POST['password'])));
        $conpsw = mysqli_real_escape_string($conn, sha1(md5($_POST['confirmpsw'])));
        if($password != $conpsw){
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("รหัสผ่านไม่ตรงกัน!");';
            $alert .= 'window.location.href = "";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, sha1(md5($_POST['password'])));

            $sql_check = "SELECT * FROM db_member WHERE m_username = '$username'";
            $query_check = mysqli_query($conn, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if($row_check > 0) {
                $alert = '<script type="text/javascript">';
                $alert .= 'alert("มี Username นี้อยู่ในระบบแล้ว!!");';
                $alert .= 'window.location.href = "";';
                $alert .= '</script>';
                echo $alert;
                exit();
            }else{
                $sql = "INSERT INTO db_member(m_username,m_password) VALUE('$username','$password')";
                $query = mysqli_query($conn, $sql);
                // echo $sql;
                if($query){
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("สมัครสมาชิกสำเร็จ!!");';
                    $alert .= 'window.location.href = "";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                    // echo "สมัครสมาชิกสำเร็จ";
                }else{
                    $alert = '<script type="text/javascript">';
                    $alert .= 'alert("สมัครสมาชิกไม่สำเร็จ ลองใหม่อีกครั้ง!");';
                    $alert .= 'window.location.href = "";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                }
            }
        }
    } else {
        echo 'errror';
    }
}


// login
if(isset($_POST['login']) && !empty($_POST['login'])) {
    // print_r($_POST);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, sha1(md5($_POST['password'])));

    $sql = "SELECT * FROM db_member WHERE m_username='$username' AND m_password='$password'";
    // print_r($sql);
    $query = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($query);
    if($row > 0){
        $result = mysqli_fetch_assoc($query);
        $_SESSION['user_id'] = $result['m_id'];
        // echo "เข้าสู่ระบบ";
        $alert = '<script type="text/javascript">';
        // $alert .= 'alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!");';
        $alert .= 'window.location.href = "";';
        $alert .= '</script>';
        echo $alert;
        exit();
    }else{
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!");';
        $alert .= 'window.location.href = "";';
        $alert .= '</script>';
        echo $alert;
        exit();
    }
}

// tel
$sql_tel = "SELECT about_tel FROM db_about WHERE about_id = 1";
$query_tel = mysqli_query($conn, $sql_tel);
$result_tel = mysqli_fetch_assoc($query_tel);
?>


<nav>
    <!-- social link and phone number---------->
    <div class="social-call">
        <div class="social">
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
        <div class="phone">
            <span>โทร <?=(isset($result_tel['about_tel']) && !empty($result_tel['about_tel'])) ? $result_tel['about_tel'] : '-'?></span>
        </div>
    </div>

    <!-- menu bar --------------------------------------->
    <div class="navigation">
        <a href="" class="logo">
            <img src="upload/5.png" alt="">
        </a>
        <!-- menu icon ----->
        <div class="toggle"></div>
        <!-- menu --------------------------------------->
        <ul class="menu">
            <li><a class="<?= $url[0] == '' || $url[0] == 'index' ? 'active-munu-custom' : '' ?>" href="index.php">หน้าหลัก</a></li>
            <li><a class="<?= in_array($url[0],array('product','product_detail')) ? 'active-munu-custom' : '' ?>" href="product.php">สินค้า</a>
                <span class="sale-label">Sale</span>
            </li>
            <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
            <li><a class="<?= $url[0] == 'payment_bank' ? 'active-munu-custom' : '' ?>" href="payment_bank.php">แจ้งชำระเงิน</a></li>
            <?php endif;?>
            <li><a class="<?= in_array($url[0],array('article','article_detail')) ? 'active-munu-custom' : '' ?>" href="article.php">บทความ</a></li>
            <li><a class="<?= in_array($url[0],array('information','information_detail')) ? 'active-munu-custom' : '' ?>" href="information.php">ข้อมูลข่าวสาร</a></li>
            <li><a class="<?= $url[0] == 'about' ? 'active-munu-custom' : '' ?>" href="about.php">เกี่ยวกับเรา</a></li>
            <li><a class="<?= $url[0] == 'contact' ? 'active-munu-custom' : '' ?>" href="contact.php">ติดต่อเรา</a></li>
        </ul>
        <!-- right menu --------------------------------------->
        <div class="right-menu">
            <!-- <a href="javascript:void(0)" class="search">
                <i class="fas fa-search"></i>
            </a> -->
            <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])):?>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">โปรไฟล์</a></li>
                    <li><a class="dropdown-item" href="user_add_address.php">เพิ่มที่อยู่ผู้รับ</a></li>
                    <li><a class="dropdown-item" href="user_address.php">ที่อยู่ผู้รับ</a></li>
                    <li><a class="dropdown-item" href="payment.php">รายการสั่งซื้อ</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
                </ul>
            </div>

            <?php else: ?>
            <a href="javascript:void(0)" class="user">
                <i class="fas fa-user"></i>
            </a>
            <?php endif;?>
            <a href="cart_detail.php">
                <i class="fas fa-shopping-cart">
                    <span class="num-cart-product"><?php if(isset($_SESSION['shopping_cart'])){echo count($_SESSION['shopping_cart']);} else {echo '0';} ?></span>
                </i>
            </a>
        </div>
    </div>
</nav>
<!-- search bar--------------------------------------->
<div class="search-bar">
    <div class="search-input">
        <input type="text" placeholder="Search For Product">
        <a href="javascript:void(0)" class="search-cancel">
            <i class="fas fa-times"></i>
        </a>
    </div>
</div>
<!-- login logout--------------------------------------->
<div class="form">
    <div class="login-form">
        <a href="javascript:void(0)" class="form-cancel">
            <i class="fas fa-times"></i>
        </a>
        <form action="" method="post">
            <h1>เข้าสู่ระบบ</h1>
            <div class="txt_field">
                <input type="text" name="username" autocomplete="off" required>
                <span></span>
                <label>ชื่อผู้ใช้</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>รหัสผ่าน</label>
            </div>
            <!-- <div class="pass">Forgot Password?</div> -->
            <input type="submit" name="login" value="เข้าสู่ระบบ">
            <div class="signup_link">
                ยังไม่เป็นสมาชิก? <a href="javascript:void(0)" class="signup-btn">สมัครสมาชิก</a>
            </div>
        </form>
    </div>
    <div class="signup-form">
        <a href="javascript:void(0)" class="form-cancel">
            <i class="fas fa-times"></i>
        </a>
        <form action="" method="post">
            <h1>สมัครสมาชิก</h1>
            <div class="txt_field">
                <input type="text" name="username" autocomplete="off" required>
                <span></span>
                <label>ชื่อผู้ใช้</label>
            </div>
            <div class="txt_field">
                <input type="password" name = "password" required>
                <span></span>
                <label>รหัสผ่าน</label>
            </div>
            <div class="txt_field">
                <input type="password" name = "confirmpsw" required>
                <span></span>
                <label>ยืนยันรหัสผ่าน</label>
            </div>
            <input type="submit" name="register" value="สมัครสมาชิก">
            <div class="signup_link">
                เป็นสมาชิกแล้ว? <a href="javascript:void(0)" class="signin-btn">เข้าสู่ระบบ</a>
            </div>
        </form>
    </div>
</div>