<?php

$sql_view = "SELECT SUM(p_view) as view FROM db_product";
$query_view = mysqli_query($conn,$sql_view);
$result_view = mysqli_fetch_assoc($query_view);

$sql_ar_view = "SELECT SUM(article_view) as view FROM db_article";
$query_ar_view = mysqli_query($conn,$sql_ar_view);
$result_ar_view = mysqli_fetch_assoc($query_ar_view);


$sql_product = "SELECT COUNT(product_id) as count_produdct FROM db_product";
$query_product = mysqli_query($conn,$sql_product);
$result_product = mysqli_fetch_assoc($query_product);

?>

<hr class="mb-4">
<div class="row g-4 settings-section">
<div class="col-12 col-md-12">
    <div class="app-card app-card-settings shadow-sm p-4">                      
        <div class="app-card-body">

			<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
						<div class="inner">
							<div class="app-card-body p-3 p-lg-4">
								<h3 class="mb-3">ยินดีต้อนรับ, <a href="?page=profile"><?=$_SESSION['user_login']?></a></h3>
								<h3 class="mb-3">สถานะ: <?=$_SESSION['level_login']?></h3>
								<!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
							</div><!--//app-card-body-->
							
						</div><!--//inner-->
					</div><!--//app-card-->
			</div><!--//app-card-body-->

		</div><!--//app-card-->
	</div>
</div><!--//row-->
