

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

	<!-- php query --------------------------------------->
	<?php
		include('connection/connection.php');
		// unset($_SESSION['shopping_cart']);
		// query product
		$sql = "SELECT * FROM (SELECT pt.pt_id,pt.pt_name,p.product_id,p.p_name,p.p_place,p.p_detail,p.p_pic,ps.ps_size,ps.ps_pic,ps.ps_weight,
									min(ps.ps_price) as minPrice, 
									max(ps_price) as maxPrice
								FROM db_product_size ps
								INNER JOIN db_product p ON ps.product_id = p.product_id
								INNER JOIN db_product_type pt ON p.pt_id = pt.pt_id
								GROUP BY p.product_id) AS tbl";
		if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
			$id = $_GET['product_id'];
			$sql .= " WHERE product_id = '$id'";

			// query for view product
			$sql_view = "UPDATE db_product SET p_view = p_view+1 WHERE product_id = '$id'";
			$query_product_view = mysqli_query($conn, $sql_view);
		}
		$query_product = mysqli_query($conn, $sql);
		$result = mysqli_fetch_assoc($query_product);

		// query for more product
		$sql1 = "SELECT *,
						min(ps.ps_price) as minPrice, 
						max(ps_price) as maxPrice
					FROM db_product_size ps
					INNER JOIN db_product p ON ps.product_id = p.product_id
					WHERE p.product_id != $id
					GROUP BY ps.product_id
					ORDER BY ps.product_id DESC LIMIT 6";
		$query_more_product = mysqli_query($conn, $sql1);

		// query for image product size
		$sql2 = "SELECT * 
				FROM db_product_size ps
				INNER JOIN db_product p ON ps.product_id = p.product_id";
		if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
			$id = $_GET['product_id'];
			$sql2 .= " WHERE ps.product_id = '$id'";
			$_SESSION['id_ps'] = $id;
		}
		$query_product_size = mysqli_query($conn, $sql2);

		// for add to cart
		// if (isset($_POST['add']) && isset($_SESSION['user_id'])){
		// 	echo "yess";
		// }
		if (isset($_POST['add'])){
			$product_id = $_POST['hidden_product_id'];
			$ps_id = $_POST['ps_id'];

			$sql_cart = "SELECT *
						FROM db_product t1
						INNER JOIN db_product_size t2 ON t1.product_id = t2.product_id
						WHERE t1.product_id = $product_id AND t2.ps_id = $ps_id";
			$query = mysqli_query($conn, $sql_cart);
			$result_cart = mysqli_fetch_assoc($query);
			

			if(isset($_SESSION['shopping_cart'])) {
				$count=count($_SESSION['shopping_cart']);
					$item_array = array(
						'item_p_id' => $result_cart['product_id'],
						'item_ps_id' => $result_cart['ps_id'],
						'item_name' => $result_cart['p_name'],
						'item_price' => $result_cart['ps_price'],
						'item_size' => $result_cart['ps_size'],
						'item_weight' => $result_cart['ps_weight'],
						'item_quan' => $_POST['ps_number']
					);
					$_SESSION['shopping_cart'] [$count] = $item_array;

					$alert = '<script type="text/javascript">';
					$alert .= 'alert("เพิ่มสินค้าสำเร็จ");';
					$alert .= 'window.location.href = ""';
					$alert .= '</script>';
					echo $alert;
			}
			else {
				$item_array = array(
					'item_p_id' => $result_cart['product_id'],
					'item_ps_id' => $result_cart['ps_id'],
					'item_name' => $result_cart['p_name'],
					'item_price' => $result_cart['ps_price'],
					'item_size' => $result_cart['ps_size'],
					'item_weight' => $result_cart['ps_weight'],
					'item_quan' => $_POST['ps_number']
				);
				$_SESSION["shopping_cart"] [0] = $item_array;

				$alert = '<script type="text/javascript">';
				$alert .= 'alert("เพิ่มสินค้าสำเร็จ");';
				$alert .= 'window.location.href = ""';
				$alert .= '</script>';
				echo $alert;
			}
		}
				
	?>

     <!-- product detail --------------------------------------->
	 <div class="container-product-details">
		<div class="product-details">
			<strong>รายละเอียดสินค้า</strong>
		<div id="content-wrapper">
			<div class="column">
				<img id=featured src="admin/upload/product/<?=$result['p_pic']?>">
				<div id="slide-wrapper" >
					<img id="slideLeft" class="arrow" src="upload/arrow-left.png">
					<div id="slider">
						<img class="thumbnail" src="admin/upload/product/<?=$result['p_pic']?>">
						<?php foreach($query_product_size as $data_ps):?>
						<img class="thumbnail" src="admin/upload/product_size/<?=$data_ps['ps_pic']?>">
						<?php endforeach;?>
					</div>
					<img id="slideRight" class="arrow" src="upload/arrow-right.png">
				</div>
			</div>
			<div class="column">
				<form action="" method="post">
					<h1><?=$result['p_name'] ?></h1>
					<hr>
					<div id="data-price" name="data_price" class="price-text">
						<p>฿<?=$result['minPrice']?> - ฿<?=$result['maxPrice']?></p>
					</div>
					
					<p class="p-detail text-break"><?=$result['p_detail']?></p>
					<p>ประเภทสินค้า : <a class="pt-name" href="product.php?pt_id=<?=$result['pt_id']?>"><?=$result['pt_name']?></a></p>
					<p>สถานที่สำหรับปลูก : <?=$result['p_place']?></p>
					
					<p class="size-select mb-0">เลือกขนาดเพื่อดูราคา:</p>
					<div class="form-floating data-size mb-3 col-lg-3">
						<select name="ps_id" class="form-select" id="floatingSelect" required onchange="my_fun(this.value);">
							<option value="" selected disabled>ขนาดกระถาง</option>
							<?php
								foreach($query_product_size as $data_ps):   ?> 
									<option value="<?=$data_ps['ps_id']."\""?>">กระถาง <?=$data_ps['ps_size']."\""?></option>
									
							<?php endforeach;?>
						</select>
						<label for="floatingSelect">ขนาด</label>
					</div>
					<p class="size-select mb-0">เลือกสินค้าได้มากสุด 10 ชิ้น:</p>
					<div class="form-floating mb-3 col-lg-3">
						<input value=1 type="number" class="form-control" id="floatingInput" name="ps_number" placeholder="20.00" autocomplete="off" 
						min="1" max="10" required>
						<label  for="floatingInput">จำนวน</label>
					</div>
					<input type="hidden" name="hidden_name" value="<?=$result['p_name']?>" >
					<input type="hidden" name="hidden_product_id" value="<?php if(isset($_GET['product_id']) && !empty($_GET['product_id'])): $id = $_GET['product_id']; echo $id; endif;?>">
					<input type="hidden" name="hidden_weight" value="<?=$result['ps_weight']?>">
					<button class="btn-add-cart" type="submit" name="add" >เพิ่มในตะกร้า <i class="fas fa-shopping-cart"></i></button>
				</form>
			</div>
		</div>

		<div class="row g-3 ">
			<div class="more-product">
				<strong>สินค้าเพิ่มเติม</strong>
			</div>
            <?php foreach($query_more_product as $data):?>
            <div class="col-12 col-md-6 col-lg-2 mt-3 mb-5">
                <div class="card p-2">
					<div class="product-img">
					<a href="product_detail.php?product_id=<?=$data['product_id']?>">
						<img src="admin/upload/product/<?=$data['p_pic']?>" class="card-img-top">
					</a>
					</div>
					<div class="product-details">
						<a href="product_detail.php?product_id=<?=$data['product_id']?>" class="p-name">฿<?=$data['minPrice']?> - ฿<?=$data['maxPrice']?></a>
					</div>
					<div class="product-details">
						<a href="product_detail.php?product_id=<?=$data['product_id']?>" class="p-name"><?=$data['p_name']?></a>
					</div>
					<div class="product-price">
						<p></p>
					</div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
	</div>
	


    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                


    <!-- script --------------------------------------->
    <?php include('include/script.php')?>
    <script type="text/javascript">
		let thumbnails = document.getElementsByClassName('thumbnail')

		let activeImages = document.getElementsByClassName('active')

		for (var i=0; i < thumbnails.length; i++){

			thumbnails[i].addEventListener('click', function(){
				console.log(activeImages)
				
				if (activeImages.length > 0){
					activeImages[0].classList.remove('active')
				}
				

				this.classList.add('active')
				document.getElementById('featured').src = this.src
			})
		}


		let buttonRight = document.getElementById('slideRight');
		let buttonLeft = document.getElementById('slideLeft');

		buttonLeft.addEventListener('click', function(){
			document.getElementById('slider').scrollLeft -= 180
		})

		buttonRight.addEventListener('click', function(){
			document.getElementById('slider').scrollLeft += 180
		})

		// get price
		function my_fun(str){
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActioveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function(){
			if (this.readyState==4 && this.status==200) {
				document.getElementById ('data-price').innerHTML = this.responseText;
				// var x = document.getElementById('data-price').value;

			}
		}
		xmlhttp.open("GET","product_detail_select.php?value="+str, true);
		xmlhttp.send();
		}


	</script>
    
    


</body>
</html>