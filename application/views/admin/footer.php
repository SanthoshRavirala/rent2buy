 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0.0
    </div>
    <strong>Copyright &copy; 2020</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
 
    
<!-- ./wrapper -->
<?php echo $modal;?>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>


<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>


<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script type="text/javascript">
$(function () {
	$('#datetimepicker').datepicker({
		format:'yyyy-mm-dd'	
	});
});
</script>

 <script src='https://cdn.tiny.cloud/1/nvyb224xiw418i88tdld9qdi4emjfwlliy6904isojrabqz2/tinymce/5/tinymce.min.js'></script><script  src="./script.js"></script>
<!--script>
tinymce.init({
  selector: 'textarea.basic-example22',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_css: '//www.tiny.cloud/css/codepen.min.css'
});
</script-->


<script>
tinymce.init({
    selector: 'textarea.basic-example',
    plugins: 'code',
    toolbar: 'undo redo',
    block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3',
    // plugins: 'image code',
    //toolbar: 'undo redo | image code',
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: '<?=base_url();?>admin/course/upload_image',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '<?=base_url();?>admin/course/upload_image');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});
</script>
</body>
</html>