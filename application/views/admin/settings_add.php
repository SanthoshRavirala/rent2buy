<?php echo $header;?>
<?php echo $sidebar;?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content-header">
	  <div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo $text_edit;?></h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form class="form-horizontal" action="<?php echo $link;?>" method="POST">
		  <div class="box-body">
		  <!-- /.box-body -->
		  <?php  $data_settings=$this->db->get('settings')->result_array(); 

		  foreach ($data_settings as $data_setting) {?>
		  
			<div class="form-group">
			  <label for="input" class="col-sm-2 control-label"><?php echo str_replace('_', ' ',$data_setting['option']);?></label>
              
			  <div class="col-sm-10">
				<input type="text" class="form-control" name="<?php echo $data_setting['option'];?>" id="input" value="<?php echo $data_setting['value'];?>" placeholder="<?php echo 'value';?>"  autocomplete="off">
				<?php if(isset($error['error_menu_name'])) { ?>
					<span class="help-block"><?php echo $error['error_menu_name'] ;?></span>
				<?php } ?>
			  </div>
			</div>
			
		  <?php } ?>
			
			
			
			
			 
		  </div>
		  <div class="box-footer"> 
			<button type="submit" class="btn btn-info pull-right"><?php echo 'Update';?></button>
		  </div>
		  <!-- /.box-footer -->
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</form>
	  </div>
    </section>
    <!-- /.content -->
</div>
<?php echo $footer;?>