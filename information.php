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
            <div class="col-12 mt-4">
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-dark">
                        <th scope="col">Number</th>
                        <th scope="col">Header</th>
                        <th scope="col">Date</th>
                        <th scope="col">More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach($query as $data):
                        ?>
                        <tr>
                            <th><?=$i++?></th>
                            <td><?=$data['info_header']?></td>
                            <td><?=$data['info_date']?></td>
                            <td>
                                <a href="information_detail.php" class="btn btn-sm btn-warning">Read More</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                
    <!-- script --------------------------------------->
    <?php include('include/script.php')?>



</body>
</html>