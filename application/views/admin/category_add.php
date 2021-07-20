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
		<form class="form-horizontal" action="<?php echo $link;?>" method="POST" enctype='multipart/form-data'>
		  <div class="box-body">
		  <!-- /.box-body -->
			<div class="form-group<?php echo isset($error['error_name']) ? " has-error" : "";?>">
			  <label for="input" class="col-sm-2 control-label"><?php echo $text_name;?></label>

			  <div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="input" value="<?php echo $name;?>" placeholder="<?php echo $text_name;?>">
				<?php if(isset($error['error_name'])) { ?>
					<span class="help-block"><?php echo $error['error_name'] ;?></span>
				<?php } ?>
			  </div>
			</div>
			<div class="form-group<?php echo isset($error['error_name']) ? " has-error" : "";?>">
			  <label for="input" class="col-sm-2 control-label">Image</label>
			  <div class="col-sm-10">
			  	<?php if(isset($image)){ ?>
			  		<img src="<?php echo base_url().$image;?>" style="width:300px;height:150px" class="thumbnail">
			  		<input type="hidden" class="form-control" name="image2" id="input" value="<?=$image;?>">
			  <?php } ?>
				<input type="file" accept="image/*" class="form-control" name="image" id="input" <?php if(!isset($image)){ ?>required=""<?php } ?>>

			  </div>
			    </div>
		    <div class="form-group" hidden>
			  <label for="priority" class="col-sm-2 control-label"><?php echo $text_priority;?></label>

			  <div class="col-sm-10">
				<input type="text" class="form-control" name="priority" id="priority" value="<?php echo $priority;?>" placeholder="<?php echo $text_priority;?>"/>
			  </div>
			</div>
		  </div>
		  <div class="box-footer">
			<a href="<?php echo $cancel;?>"  class="btn btn-default"><?php echo $button_cancel;?></a>
			<button type="submit" class="btn btn-info pull-right"><?php echo $button_edit;?></button>
		  </div>
		  <!-- /.box-footer -->
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</form>
	  </div>
    </section>
    <!-- /.content -->
</div>
<?php echo $footer;?>