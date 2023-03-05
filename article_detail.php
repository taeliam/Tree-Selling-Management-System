

<!DOCTYPE html>
<html lang="en">
<?php include('include/head.php')?>
<body>
    <!-- nav bar --------------------------------------->
    <?php include('include/navbar.php')?>

    <?php 
    include('connection/connection.php');

    if(isset($_SESSION['user_id'])) {
        $m_id = $_SESSION['user_id'];
        $sql_user = "SELECT * FROM db_member WHERE m_id = '$m_id'";
        $user_query = mysqli_query($conn, $sql_user);
        $result_user = mysqli_fetch_assoc($user_query);
    }
    if(isset($_GET['article_id']) && !empty($_GET['article_id'])) {
        $id = $_GET['article_id'];
        $sql = "SELECT * FROM db_article t1 INNER JOIN db_type_article t2 ON t1.t_article_id = t2.t_article_id
                WHERE t1.article_id = $id";

        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);

        $sql_view = "UPDATE db_article SET article_view = article_view+1 WHERE article_id = '$id'";
        $query_article_view = mysqli_query($conn, $sql_view);
    }

    
    ?>

    <div class="container">
        <div class="product-cat">
            <strong>บทความ</strong>
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <div class="text-center">
                    <h5><p>ชื่อบทความ: <?=($result['article_name'])?></p></h5>
                    <h5><p>ประเภทบทความ: <a href="article.php?t_article_id=<?=($result['t_article_id'])?>" class="p-name"><?=($result['t_article_name'])?></a></p></h5>
                </div>
                <p><?=($result['article_detail'])?></p>
            </div>
            <div class="col-12 mt-5 mb-5">
                <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
                <form method="POST" id="comment_form">
                    <div class="form-group col-xl-12 mt-3">
                        <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="ชื่อ" />
                    </div>
                    <div class="form-group col-xl-12 mt-3">
                        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="ความคิดเห็น" rows="5"></textarea>
                    </div>
                    <div class="form-group col-xl-3 mt-3">
                        <input type="hidden" name="comment_id" id="comment_id" value="0" />
                        <input type="submit" name="submit" id="submit" value="เพิ่ม" />
                    </div>
                </form>
                <span id="comment_message"></span>
                <br />
                <div id="display_comment"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <!-- footer --------------------------------------->
    <?php include('include/footer.php')?>
                


    <!-- script --------------------------------------->
    <?php include('include/script.php')?>
    
    <script>
    $(document).ready(function(){
 
    $('#comment_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
    $.ajax({
        url:"add_comment.php",
        method:"POST",
        data:form_data,
        dataType:"JSON",
        success:function(data)
        {
            if(data.error != '')
            {
                $('#comment_form')[0].reset();
                $('#comment_message').html(data.error);
                $('#comment_id').val('0');
                load_comment();
            }
        }
        })
        });

        load_comment();

    function load_comment()
    {
        $.ajax({
            url:"fetch_comment.php",
            method:"POST",
            success:function(data)
            {
                $('#display_comment').html(data);
            }
        })
    }

        $(document).on('click', '.reply', function(){
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
            });
        
        });
    </script>



</body>
</html>