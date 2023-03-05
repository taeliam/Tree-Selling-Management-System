<?php
session_start();
// session_destroy();
unset($_SESSION['user_id']);
$alert = '<script type="text/javascript">';
// $alert .= 'alert("Logout successfully!");';
$alert .= 'window.location.href = "index.php";';
$alert .= '</script>';
echo $alert;
?>