<?php
$errors = array('wentwrong'=>'','invalid'=>'');

if(isset($_POST) && !empty($_POST)) {
	// echo print_r($_POST);
	$username = mysqli_real_escape_string($conn, $_POST['ad_username']);
	$password = mysqli_real_escape_string($conn, sha1(md5($_POST['ad_password'])));
	$sql = "SELECT * FROM db_admin WHERE ad_username = '$username' AND ad_password = '$password'";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_num_rows($query);
	

	if ($row > 0) {
		$result = mysqli_fetch_assoc($query);
		if ($result['ad_level'] == 'super admin') {
			$_SESSION['user_login'] = $result['ad_username'];
			$_SESSION['level_login'] = $result['ad_level'];
			$alert = '<script type="text/javascript">';
			$alert .= 'window.location.href = "";';
			$alert .= '</script>';
			echo $alert;
		} elseif ($result['ad_level'] == 'admin') {
			$_SESSION['user_login'] = $result['ad_username'];
			$_SESSION['level_login'] = $result['ad_level'];
			$alert = '<script type="text/javascript">';
			$alert .= 'window.location.href = "";';
			$alert .= '</script>';
			echo $alert;
		} else {
			$errors['wentwrong'] = "บางอย่างผิดพลาด.";
		}
	} else {
		$errors['invalid'] = "รหัสผ่านหรือชื่อผู้ใช้ไม่ถูกต้อง!";
	}
}

?>
<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4">
					</div>
					<h2 class="auth-heading text-center mb-5">เข้าสู่ระบบ</h2>
			        <div class="auth-form-container text-start">
						<form action="" method="post" class="auth-form login-form">
							<?php foreach($errors as $data):?>
								<p class="text-danger"><?php echo $data; ?></p>
							<?php endforeach; ?>      
							<div class="email mb-3">
								<!-- <label class="sr-only" for="signin-email">Email</label> -->
								<input name="ad_username" type="text" class="form-control signin-email" placeholder="ชื่อผู้ใช้" autocomplete="off" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<!-- <label class="sr-only" for="signin-password">Password</label> -->
								<input name="ad_password" type="password" class="form-control signin-password" placeholder="รหัสผ่าน" autocomplete="off" required="required">
								<div class="extra mt-3 row justify-content-between">
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">เข้าสู่ระบบ</button>
							</div>
						</form>
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
			        <small class="copyright"> <a class="app-link" target="_blank"></a></small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

