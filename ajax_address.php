<?php
include('connection/connection.php');

if(isset($_POST['function']) && $_POST['function'] == 'province') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE province_id = '$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>กรุณาเลือกอำเภอ</option>';
    foreach($query as $value) {
    echo '<option value="'.$value['id'].'">'.$value['districts_in_thai'].'</option>';
    }
    exit();

}
if(isset($_POST['function']) && $_POST['function'] == 'district') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM subdistricts WHERE district_id = '$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>กรุณาเลือกตำบล</option>';
    foreach($query as $value) {
    echo '<option value="'.$value['id'].'">'.$value['subdistricts_in_thai'].'</option>';
    }
    exit();
}
if(isset($_POST['function']) && $_POST['function'] == 'subdistrict') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM subdistricts WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    echo $result['zip_code'];
    exit();
}
// echo $_POST['function'];
?>