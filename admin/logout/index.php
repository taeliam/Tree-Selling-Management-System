<?php
// session_destroy();
unset($_SESSION['user_login']);
$alert = '<script type="text/javascript">';
$alert .= 'window.location.href = "../admin/";';
$alert .= '</script>';
echo $alert;
?>