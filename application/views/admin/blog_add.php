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
			  <label for="input" class="col-sm-2 control-label">Title</label>

			  <div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="input" value="<?php echo $name;?>" placeholder="Title">
			  </div>
			</div>			
		    <div class="form-group">
			   <label for="priority" class="col-sm-2 control-label">Description</label>
			  <div class="col-lg-10">
                   <textarea name="description"  class="textarea basic-example" placeholder=""
                            style="width: 100%; height: 225px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$description;?></textarea>
                  <!-- /input-group -->
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
