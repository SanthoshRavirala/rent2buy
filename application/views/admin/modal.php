<div class="modal modal-danger" id="confirm-delete">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">×</span></button>
		<h4 class="modal-title"><?php echo $text_title?></h4>
	  </div>
	  <div class="modal-body">
		<p><?php echo $text_body;?></p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo $text_close;?></button>
		<a class="btn btn-danger btn-ok"><?php echo $text_delete;?></a>
	  </div>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href') + '<?php echo '/'.$this->security->get_csrf_hash(); ?>');
});
</script>