<?php echo $header;?>
<div class="container">
  <div class="box box-info">
	<div class="box-header with-border">
	  <h3 class="box-title"><?php echo $text_form;?></h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	<form class="form-horizontal" action="<?php echo $link;?>" method="post">		 
		<!-- /.box-body -->
		<div class="box-body">
		<?php if(isset($error['error_exists'])){ ?>
		<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
		  <?php echo $error['error_exists'];?>
		</div>
		<?php } ?>
		<div class="form-group<?php echo (isset($error['error_firstname'])) ? " has-error" : "";?>">
			<label for="first-name" class="col-sm-3 control-label"><?php echo $text_firstname;?></label>
			<div class="col-sm-9">
				<input type="text" name="firstname" id="first-name" value="<?php echo $firstname;?>" placeholder="<?php echo $text_firstname;?>" class="form-control" autofocus>
				<?php if(isset($error['error_firstname'])) { ?>
					<span class="help-block"><?php echo $error['error_firstname'] ;?></span>
				<?php } ?>
			</div>			
		</div>	
		<div class="form-group<?php echo (isset($error['error_lastname'])) ? " has-error" : "";?>">
			<label for="last-name" class="col-sm-3 control-label"><?php echo $text_lastname;?></label>
			<div class="col-sm-9">
				<input type="text" name="lastname" id="last-name" value="<?php echo $lastname;?>" placeholder="<?php echo $text_lastname;?>" class="form-control">
				<?php if(isset($error['error_lastname'])) { ?>
					<span class="help-block"><?php echo $error['error_lastname'] ;?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group<?php echo (isset($error['error_email'])) ? " has-error" : "";?>">
			<label for="email" class="col-sm-3 control-label"><?php echo $text_email;?></label>
			<div class="col-sm-9">
				<input type="email" name="email" id="email"  value="<?php echo $email;?>" placeholder="<?php echo $text_email;?>" class="form-control">
				<?php if(isset($error['error_email'])) { ?>
					<span class="help-block"><?php echo $error['error_email'] ;?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group<?php echo (isset($error['error_password'])) ? " has-error" : "";?>">
			<label for="password" class="col-sm-3 control-label"><?php echo $text_password;?></label>
			<div class="col-sm-9">
				<input type="password" name="password" id="password"  value="<?php echo $password;?>" placeholder="<?php echo $text_password;?>" class="form-control">
				<?php if(isset($error['error_password'])) { ?>
					<span class="help-block"><?php echo $error['error_password'] ;?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group<?php echo (isset($error['error_date_birth'])) ? " has-error" : "";?>">
			<label for="birth-date" class="col-sm-3 control-label"><?php echo $text_date_birth;?></label>
			<div class="col-sm-9">
				<div class='input-group date' id='datetimepicker'>
				  <input type="date" name="date_birth" id="birth-date"  value="<?php echo $date_birth;?>" class="form-control">
				  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                       
				</div>
				<?php if(isset($error['error_date_birth'])) { ?>
					<span class="help-block"><?php echo $error['error_date_birth'] ;?></span>
				<?php } ?>
			</div>
		</div>
		<div class="form-group<?php echo (isset($error['error_region'])) ? " has-error" : "";?>">
			<label for="region" class="col-sm-3 control-label"><?php echo $text_region;?></label>
			<div class="col-sm-9">
				<select id="region" name="region_id" class="form-control">
				  <option value='0'><?php echo $text_select_region;?></option>
				  <?php foreach($regions as $region) {?>
					<option value="<?php echo $region['region_id'];?>" <?php if($region['region_id'] == $region_id) echo 'selected';?>><?php echo $region['name'];?></option>
				  <?php } ?>
				 
				</select> 
				<?php if(isset($error['error_region'])) { ?>
					<span class="help-block"><?php echo $error['error_region'] ;?></span>
				<?php } ?>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group<?php echo (isset($error['error_nation'])) ? " has-error" : "";?>">
			<label for="nation" class="col-sm-3 control-label"><?php echo $text_nation;?></label>
			<div class="col-sm-9">
				<select name="nation_id" id="nation" class="form-control">
				  <option value='0'><?php echo $text_select_nation;?></option>
				  <?php foreach($nations as $nation) {?>
					<option value="<?php echo $nation['nation_id'];?>" <?php if($nation['nation_id'] == $nation_id) echo 'selected';?>><?php echo $nation['name'];?></option>
				  <?php } ?>
				</select>
				<?php if(isset($error['error_nation'])) { ?>
					<span class="help-block"><?php echo $error['error_nation'] ;?></span>
				<?php } ?>
			</div>
		</div> <!-- /.form-group -->
		<div class="form-group<?php echo (isset($error['error_gender'])) ? " has-error" : "";?>">
			<label class="control-label col-sm-3"><?php echo $text_gender;?></label>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-6">
						<label class="radio-inline">
							<input type="radio" name="gender" id="female" value="1" <?php if($gender == '1') echo 'checked="checked"';?>>&nbsp;&nbsp;<?php echo $text_female;?>
						</label>
					</div>
					<div class="col-sm-6">
						<label class="radio-inline">
							<input type="radio" name="gender" id="male" value="2" <?php if($gender == '2') echo 'checked="checked"';?>>&nbsp;&nbsp;<?php echo $text_male;?>
						</label>
					</div>
				</div>
				<?php if(isset($error['error_gender'])) { ?>
					<span class="help-block"><?php echo $error['error_gender'] ;?></span>
				<?php } ?>
			</div>
		</div> <!-- /.form-group -->
	  </div>
	  <div class="box-footer">
		<button type="submit" class="btn btn-info pull-right"><?php echo $text_register;?></button>
	  </div>
	  <!-- /.box-footer -->
	 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	</form> <!-- /form -->
  </div>
</div> <!-- ./container -->
<?php echo $footer;?>