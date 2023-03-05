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
$sql_total = "SELECT * FROM db_article";
$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_num_rows($query_total);
$page_total = ceil($row_total/$record_show);

// query type product
$sql = "SELECT * FROM db_type_article";
$query_type_article = mysqli_query($conn, $sql);

// query product
$sql1 = "SELECT * FROM db_article";
if(isset($_GET['t_article_id']) && !empty($_GET['t_article_id'])){
    $sql1 .= " WHERE t_article_id = '".$_GET['t_article_id']."'";
}

// foreach ($query_product as $data){
//     print "<pre>";
//     print_r($data);
//     print "</pre>";
// }

// for search
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $sql1 .= " WHERE article_name LIKE '%".$_GET['search']."%'";
}

// for pagination
$sql1 .= " LIMIT $offset, $record_show";
$query_article = mysqli_query($conn, $sql1);
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
            <strong>บทความ</strong>
        </div>
        <div class="product-search">
            <div class="col-md-3">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="ค้นหาบทความ"
                        value="<?=(isset($_GET['search']) ? $_GET['search'] : '')?>">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <ul class="list-group mt-5">
                    <li class="list-cat">ประเภทบทความ</li>
                    <a href="article.php" class="list-group-item <?=!isset($_GET['t_article_id'])
                    ? 'active-list-menu-custom' : '' ?>">บทความทั้งหมด</a>
                    <?php foreach($query_type_article as $data):?>
                    <a href="?t_article_id=<?=$data['t_article_id']?>" class="list-group-item <?=isset($_GET['t_article_id']) && 
                    $_GET['t_article_id'] == $data['t_article_id'] ? 'active-list-menu-custom' : ''?>">
                    <?=$data['t_article_name']?></a>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php if(mysqli_num_rows($query_article)):?>
                        <?php foreach($query_article as $data):?>
                        <div class="col-12 col-md-6 col-lg-4 mt-5">
                            <div class="card p-2">
                                <div class="product-img">
                                <a href="article_detail.php?article_id=<?=$data['article_id']?>">
                                    <img src="admin/upload/article/<?=$data['article_pic']?>" class="card-img-top">
                                </a>
                                </div>
                                <div class="product-details">
                                    <a href="article_detail.php?article_id=<?=$data['article_id']?>" class="p-name"><?=$data['article_name']?></a>
                                </div>
                                <div class="product-details">
                                    <a href="article_detail.php?article_id=<?=$data['article_id']?>" class="p-name">การอ่าน: 
                                    <?=(isset($data['article_view']) && !empty($data['article_view']) ? $data['article_view'] : '0')?> ครั้ง</a>
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
                                <h3>ไม่พบบทความ</h3>
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