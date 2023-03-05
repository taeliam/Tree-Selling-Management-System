<?php
include('connection/connection.php');
// query type product
$sql = "SELECT * FROM db_product_type";
$query_type_product = mysqli_query($conn, $sql);

// query new product
$sql1 = "SELECT *,
                min(ps.ps_price) as minPrice, 
                max(ps_price) as maxPrice
             FROM db_product_size ps
             INNER JOIN db_product p ON ps.product_id = p.product_id
             GROUP BY ps.product_id
             ORDER BY ps.product_id DESC LIMIT 6";
$query_product_limit = mysqli_query($conn, $sql1);


$sql1 = "SELECT * FROM db_product ORDER BY product_id DESC LIMIT 6";
$query_more_product = mysqli_query($conn, $sql1);


// query best sale product
$sql_bestsale = "SELECT db_product.product_id,db_product.p_name,SUM(db_order_details.detail_qty) AS qty,
                  db_product.p_pic,
                  (SELECT MIN(ps.ps_price) AS minPrice FROM db_product_size ps WHERE db_product.product_id = ps.product_id) AS minPrice,
                  (SELECT MAX(ps.ps_price) AS maxPrice FROM db_product_size ps WHERE db_product.product_id = ps.product_id) AS maxPrice
                FROM db_order_details 
                INNER JOIN db_product ON db_product.product_id = db_order_details.product_id
                INNER JOIN db_order ON db_order.order_id = db_order_details.order_id
                WHERE db_order.order_status IN (3,4)
                GROUP BY db_product.product_id 
                ORDER BY SUM(db_order_details.detail_qty) DESC ";
$query_bestsale = mysqli_query($conn, $sql_bestsale);

// query product 
$sql2 = "SELECT *,
                min(ps.ps_price) as minPrice, 
                max(ps_price) as maxPrice
             FROM db_product_size ps
             INNER JOIN db_product p ON ps.product_id = p.product_id
             GROUP BY ps.product_id";
$query_product = mysqli_query($conn, $sql2);
// foreach ($query_product as $data){
//   print "<pre>";
//   print_r($data);
//   print "</pre>";
// }




?>

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

    <!-- full slider bar--------------------------------------->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="upload/รูปไสลด์1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="upload/รูปไสลด์2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="upload/รูปไสลด์3.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- product catergories --------------------------------------->
    <section>
        <div class="product-cat">
            <strong>ประเภทต้นไม้</strong>
        </div>
        <div class="pt-container">
            <div class="product-type">
                <?php foreach($query_type_product as $data):?>
                <a href="product.php?pt_id=<?=$data['pt_id']?>" class="pt-name"><?=$data['pt_name']?>,</a>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <!-- new arrivals --------------------------------------->
    <div class="container my-3">
      <div class="product-all">
          <strong>ต้นไม้มาใหม่</strong>
      </div>
      <div class="row g-3">
          <?php foreach($query_product_limit as $data):?>
          <div class="col-12 col-md-6 col-lg-2 mt-5">
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
                    <!-- <a href="#" class="p-price"><?=$data1['ps_price']?></a> -->
                </div>
              </div>
          </div>
          <?php endforeach;?>
      </div>
    </div>

    <!-- best slae --------------------------------------->
    <div class="container my-3">
      <div class="product-all">
          <strong>ต้นไม้ขายดี</strong>
      </div>
      <div class="row g-3">
          <?php foreach($query_bestsale as $data):?>
          <div class="col-12 col-md-6 col-lg-2 mt-5">
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
                    <!-- <a href="#" class="p-price"><?=$data1['ps_price']?></a> -->
                </div>
              </div>
          </div>
          <?php endforeach;?>
      </div>
    </div>
    
     <!-- all product --------------------------------------->
    <div class="container my-3">
        <div class="product-all">
            <strong>ต้นไม้ทั้งหมด</strong>
        </div>
        <div class="row g-3">
            <?php foreach($query_product as $data):?>
            <div class="col-12 col-md-6 col-lg-3 mt-5">
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
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>


    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                
    <!-- script --------------------------------------->
    <?php include('include/script.php')?>


    


</body>
</html>