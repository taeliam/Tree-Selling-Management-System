<?php
// print_r($_FILES);

if(isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])){
    $target = '../upload/';
    $filename = $_FILES['upload']['name'];
    $filetmp = $_FILES['upload']['tmp_name'];
    if(!file_exists($target.$filename)) {
        if(move_uploaded_file($filetmp,$target.$filename)) {
            $filename = $filename;
        }
    } else {
        $newfilename = time().$filename;
        if(move_uploaded_file($filetmp,$target.$newfilename)) {
            $filename = $newfilename;
        }
    }
    $function_number = $_GET['CKEditorFuncNum'];
    $url = 'http://localhost/growinggreen1/upload/'.$filename;
    $message = '';
    echo '<script>';
    echo 'window.parent.CKEDITOR.tools.callFunction("'.$function_number.'","'.$url.'","'.$message.'")';
    echo '</script>';
}
?>