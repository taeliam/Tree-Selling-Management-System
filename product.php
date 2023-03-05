<?php
include('connection/connection.php');

// pagination
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$record_show = 6;
$offset = ($page - 1) * $record_show;
$sql_total = "SELECT * FROM db_product";
$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_num_rows($query_total);
$page_total = ceil($row_total/$record_show);

// query type product
$sql = "SELECT * FROM db_product_type";
$query_type_product = mysqli_query($conn, $sql);

// query product
$sql1 = "SELECT * FROM (SELECT pt.pt_id,p.product_id,p.p_name,p.p_pic,
                            min(ps.ps_price) as minPrice, 
                            max(ps_price) as maxPrice
                        FROM db_product_size ps
                        INNER JOIN db_product p ON ps.product_id = p.product_id
                        INNER JOIN db_product_type pt ON p.pt_id = pt.pt_id
                        GROUP BY p.product_id) AS tbl";
// $sql1 = "SELECT * FROM db_product";
if(isset($_GET['pt_id']) && !empty($_GET['pt_id'])){
    $sql1 .= " WHERE pt_id = '".$_GET['pt_id']."'";
}

// foreach ($query_product as $data){
//     print "<pre>";
//     print_r($data);
//     print "</pre>";
// }

// for search
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $sql1 .= " WHERE p_name LIKE '%".$_GET['search']."%'";
}

// for pagination
$sql1 .= " LIMIT $offset, $record_show";
$query_product = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

     <!-- product --------------------------------------->
    <div class="container my-3">
        <div class="product-all">
            <strong>ต้นไม้</strong>
        </div>
        <div class="product-search">
            <div class="col-md-3">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="ค้นหาต้นไม้"
                        value="<?=(isset($_GET['search']) ? $_GET['search'] : '')?>">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="d-flex">
            <div class="mx-auto">
                <div class="justify-content-end">
                    <input type="text" class="form-control" placeholder="Search Product">
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-3">
                <ul class="list-group mt-5">
                    <li class="list-cat">ประเภทต้นไม้</li>
                    <a href="product.php" class="list-group-item <?=!isset($_GET['pt_id'])
                    ? 'active-list-menu-custom' : '' ?>">ต้นไม้ทั้งหมด</a>
                    <?php foreach($query_type_product as $data):?>
                    <a href="?pt_id=<?=$data['pt_id']?>" class="list-group-item <?=isset($_GET['pt_id']) && 
                    $_GET['pt_id'] == $data['pt_id'] ? 'active-list-menu-custom' : ''?>">
                    <?=$data['pt_name']?></a>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php if(mysqli_num_rows($query_product)):?>
                        <?php foreach($query_product as $data):?>
                        <div class="col-12 col-md-6 col-lg-4 mt-5">
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
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-5">
                                <li class="page-item">
                                    <a class="page-link" href="?page=1" tabindex="-1" aria-disabled="true">หน้าแรก</a>
                                </li>
                                <li class="page-item <?= $page > 1 ? '' : 'disabled' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php for($i=1; $i <= $page_total; $i++):?>
                                    <?php if($page <= 2): ?>
                                        <?php if($i <= 5): ?>
                                            <li class="page-item <?=$page == $i ? 'active' : ''?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                                        <?php endif; ?>
                                        <?php elseif($page > 2):?>
                                            <?php if($i <= $page+2 && $i >= $page-2): ?>
                                                <li class="page-item <?=$page == $i ? 'active' : ''?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                                            <?php endif;?>
                                    <?php endif; ?>
                                <?php endfor;?>
                                <li class="page-item <?= $page < $page_total ? '' : 'disabled'?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <a class="page-link" href="?page=<?=$page_total?>">หน้าสุดท้าย</a>
                                </li>
                            </ul>
                        </nav>
                    <?php else:?>
                        <div class="col-12 mt-5 text-center">
                            <div class="card p-2">
                                <h3>ไม่พบสินค้า</h3>
                            </div>
                        </div>
                    <?php endif;?>
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