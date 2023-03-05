<?php include('../connection/connection.php');
session_start(); 

// $sql = "SELECT ad_level FROM db_admin WHERE ad_level = 'super admin'";
// $query_admin = mysqli_query($con, $sql);
// $result = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en"> 

    <?php include('include/head.php') ?>

    <?php if(isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])):?>
        <body class="app">   	
            <?php include('include/header.php') ?>
                <div class="app-wrapper">
                    <div class="app-content pt-3 p-md-3 p-lg-4">
                        <div class="container-xl">
                            <?php if(!isset($_GET['page']) && empty($_GET['page'])) {
                                        include('dashboard/index.php');
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'about') {
                                        include('about/index.php');
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'product') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('product/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'insert_ps') {
                                            include('product_size/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('product/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('product/delete.php');
                                        } else {
                                            include('product/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'product_size') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('product_size/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('product_size/delete.php');
                                        } else {
                                            include('product_size/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'producttype') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('producttype/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('producttype/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('producttype/delete.php');
                                        } else {
                                            include('producttype/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'admin') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('admin/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('admin/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('admin/delete.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'resetpwd') {
                                            include('admin/resetPassword.php');
                                        } else {
                                            include('admin/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'user') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('user/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('user/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('user/delete.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'resetpwd') {
                                            include('user/resetPassword.php');
                                        } else {
                                            include('user/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'bank') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('bank_account/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('bank_account/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('bank_account/delete.php');
                                        } else {
                                            include('bank_account/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'information') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('information/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('information/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('information/delete.php');
                                        } else {
                                            include('information/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'contact') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('contact/delete.php');
                                        } else {
                                            include('contact/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'article_type') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('article_type/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('article_type/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('article_type/delete.php');
                                        } else {
                                            include('article_type/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'article') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'insert') {
                                            include('article/insert.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('article/edit.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('article/delete.php');
                                        } else {
                                            include('article/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'order') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('order/edit.php');
                                        } else {
                                            include('order/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'payment') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'update') {
                                            include('payment/detail.php');
                                        } elseif(isset($_GET['function']) && ($_GET['function']) == 'delete') {
                                            include('payment/delete.php');
                                        } else {
                                            include('payment/index.php');
                                        }
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'report') {
                                        if(isset($_GET['function']) && ($_GET['function']) == 'income') {
                                            include('report/income.php');
                                        } else {
                                            include('report/index.php');
                                        }
                                    } elseif(isset($_GET['function']) && ($_GET['function']) == 'income') {
                                        include('report/income.php');
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'profile') {
                                        include('profile/index.php');
                                    } elseif (isset($_GET['page']) && ($_GET['page']) == 'logout') {
                                        include('logout/index.php'); 
                                    }
                            ?>
                        </div><!--//container-fluid-->
                    </div><!--//app-content-->
                    
                    <?php include('include/footer.php') ?>
                    
                </div><!--//app-wrapper-->    					


        </body>
    <?php else:?>
        <?php include('login/index.php'); ?>
    <?php endif;?>
    <?php include('include/script.php')?>
</html> 

