 <!-- Javascript -->          
 <script src="assets/assets/plugins/popper.min.js"></script>
<script src="assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

<!-- Charts JS -->
<script src="assets/assets/plugins/chart.js/chart.min.js"></script> 
<!-- <script src="assets/assets/js/index-charts.js"></script>  -->

<!-- Page Specific JS -->
<script src="assets/assets/js/app.js"></script> 

<!-- Data table JS -->
<!-- <script  type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>  -->

<!-- CKediter -->
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('about_desc',{
        height: '500px',
        filebrowserUploadMethod: 'form',
        filebrowserUploadUrl: 'upload.php'
    });
    CKEDITOR.replace('article_detail',{
        height: '500px',
        filebrowserUploadMethod: 'form',
        filebrowserUploadUrl: 'upload.php'
    });

</script>
 