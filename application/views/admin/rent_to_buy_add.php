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
		
		<form class="form-horizontal" action="<?php echo $link;?>" method="post" enctype='multipart/form-data'>		 
		    <!-- /.box-body -->
			<div class="box-body">
			<?php if(isset($error['error_exists'])){ ?>
			<div class="alert alert-danger alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
			  <?php echo $error['error_exists'];?>
			</div>
		    <?php } ?>
			<div class="form-group<?php echo isset($error['error_title']) ? " has-error" : "";?>">
			  <label for="input" class="col-sm-2 control-label">Title</label>

			  <div class="col-sm-10">
				<input type="text" class="form-control" name="title" id="input" value="<?php echo $title;?>" placeholder="Title">
			 <?php if(isset($error['error_title'])) { ?>
				  <span class="help-block"><?php echo $error['error_title'] ;?></span>
					<?php } ?>
			 </div>
			</div>

			 <div class="form-group<?php echo isset($error['error_description']) ? " has-error" : "";?>">
			   <label for="priority" class="col-sm-2 control-label">Description</label>
			  <div class="col-lg-10"> 
                   <textarea name="description" class="textarea basic-example" placeholder=""
                            style="width: 100%; height: 225px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$description;?></textarea>
                  <!-- /input-group -->
					<?php if(isset($error['error_description'])) { ?>
							<span class="help-block"><?php echo $error['error_description'] ;?></span>
					<?php } ?>
			   </div>
               </div>	
				<div class="form-group<?php echo isset($error['error_order_id']) ? " has-error" : "";?>">
					  <label for="input" class="col-sm-2 control-label">Rent</label>

					  <div class="col-sm-10">
						<input type="number" class="form-control" name="price" id="input" value="<?php echo $price;?>" placeholder="Rent">
					 <?php if(isset($error['error_order_id'])) { ?>
						  <span class="help-block"><?php echo $error['error_order_id'] ;?></span>
							<?php } ?>
					 </div>
			</div> 
			<div class="form-group<?php echo (isset($error['error_page_id'])) ? " has-error" : "";?>">
				<label for="region" class="col-sm-2 control-label"><?php echo 'Brand';?></label>
				<div class="col-sm-10">
					<select id="region" name="category_id" required class="form-control">
					  <option value="">Select Anyone</option>
					  <?php $page_datas = $this->db->get('category')->result_array();
						  foreach($page_datas as $page_data){
							if($page_data['category_id']===$category_id){
						  ?>
						  <option value="<?php echo $page_data['category_id'];?>" selected><?php echo $page_data['name'];?></option>
							<?php } else {?>
							<option value="<?php echo $page_data['category_id'];?>"><?php echo $page_data['name'];?></option>
						  <?php } } ?>
						  
					</select> 
					 <?php if(isset($error['error_page_id'])) { ?>
						<span class="help-block"><?php echo $error['error_page_id'] ;?></span>
					<?php } ?>
				</div>
			</div> <!-- /.form-group -->
			
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
				
				<div class="form-group<?php echo isset($error['error_slider_desc']) ? " has-error" : "";?>">
					<label for="input" class="col-sm-2 control-label"><?php echo 'Gallery Image';?></label>

			  <div class="col-sm-10">
				<?php $meta_datas = $this->db->get_where('gallery',array('gallery_id'=>$id,'tb_name'=>'rent_to_buy'))->result_array();
                      if(!empty($meta_datas)){				 
				 ?>
				<?php  foreach($meta_datas as $meta_data){ ?>
				
				<div class="col-md-4" style="margin-right:50px;">
					<a href="#" class="" data-href="<?php echo site_url('admin/rent_to_buy/delete_image/'.$meta_data['id'].'/'.$meta_data['gallery_id']);?>" data-toggle="modal" data-target="#confirm-delete">
								<i class="fa fa-trash" style="font-size:18px;"></i></a>
					<img src="<?php echo base_url().$meta_data['image'];?>" style="width:300px;height:150px" class="thumbnail"> 
					
			  </div>	
	<?php }  }?>
				
			 <input type="file" class="form-control" accept="image/*" name="files[]" multiple />
				<?php if(isset($error['error_slider_image'])) { ?>
					<span class="help-block"><?php echo $error['error_slider_image'] ;?></span>
				<?php } ?>
			  </div>
			</div>
				
	
			
			 <label for="input" class="col-sm-2 control-label"><?php echo 'Included List';?></label>
				<div class="col-sm-10">
				
				<table id="myTable" class=" table order-list">
				    <thead>
				        <tr>
							<td>Description</td>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php 
							$tab_datas=$this->db->get_where('rent_to_buy',array('id'=>$id))->result_array();
							if(!empty($tab_datas)) { 
							 $arr_data = json_decode($tab_datas[0]['list_1'],true);
								foreach ($arr_data as $key => $value) 
								//for($p=0;$p<count($arr_data); $p++)
								{
								//	print_r($arr_data);
										
						?>
					   <tr>
				        	<td class="col-sm-3">
				                <input type="text" name="list_1[]" value="<?php  echo $value;?>" class="form-control">
				            </td>
						   
				            <td class="col-sm-2"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete">

				            </td>
				        </tr>

				        <?php 
							} }	 
				        ?>

				    </tbody>
				    <tfoot>
				        <tr>
				            <td colspan="5" style="text-align: left;">
				                <input type="button" class="btn btn-lg btn-block " id="addrow2" value="Add Row" />
				            </td>
				        </tr>
				        <tr>
				        </tr>
				    </tfoot>
				</table>
				</div>
			
		
			 <!-- /.form-group -->
		 
		  
		  
		  
		  
		   <label for="input" class="col-sm-2 control-label"><?php echo 'Notincluded List';?></label>
				<div class="col-sm-10">
				
				<table id="myTable" class=" table order-list_2">
				    <thead>
				        <tr>
							<td>Description</td>
				        </tr>
				    </thead>
				    <tbody>
				    	<?php 
							$tab_datas=$this->db->get_where('rent_to_buy',array('id'=>$id))->result_array();
							if(!empty($tab_datas)) { 
							 $arr_data = json_decode($tab_datas[0]['list_2'],true);
								foreach ($arr_data as $key => $value) 
								//for($p=0;$p<count($arr_data); $p++)
								{
								//	print_r($arr_data);
										
						?>
					   <tr>
				        	<td class="col-sm-3">
				                <input type="text" name="list_2[]" value="<?php  echo $value;?>" class="form-control">
				            </td>
						   
				            <td class="col-sm-2"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete">

				            </td>
				        </tr>

				        <?php 
							} }	 
				        ?>

				    </tbody>
				    <tfoot>
				        <tr>
				            <td colspan="5" style="text-align: left;">
				                <input type="button" class="btn btn-lg btn-block " id="addrow_2" value="Add Row" />
				            </td>
				        </tr>
				        <tr>
				        </tr>
				    </tfoot>
				</table>
				</div>
			
		
			 <!-- /.form-group -->
		  </div>
			
			 <!-- /.form-group -->
		
		  <div class="box-footer">
			<a href="<?php echo $cancel;?>"  class="btn btn-default"><?php echo $button_cancel;?></a>
			<button type="submit" class="btn btn-info pull-right"><?php echo $button_edit;?></button>
		  </div>
		  <!-- /.box-footer -->
		   <input type="hidden" name="<?php echo 'car_type'; ?>" value="<?php echo 'rent_to_buy'; ?>">
		
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</form> <!-- /form -->
	  </div>
    </section>
    <!-- /.content -->
</div>

<?php echo $footer;?>

<script>
$(document).ready(function () {
    var counter = 0;

    $("#addrow2").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="list_1[]"></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});

$(document).ready(function () {
    var counter = 0;

    $("#addrow_2").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="list_2[]"></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list_2").append(newRow);
        counter++;
    });



    $("table.order-list_2").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});




function calculateRow(row) {
    var pack_price = +row.find('input[name^="pack_price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="pack_price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
</script>