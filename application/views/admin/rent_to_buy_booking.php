<?php echo $header;?>
<?php echo $sidebar;?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $title;?></h3>
	      </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;" >
		  <?php //print_r($users);?>
            <table id="example2" class="table table-bordered table-hover " >
              <thead>
              <tr>
                <th><?php echo $text_id;?></th>
				<th><?php echo 'Date';?></th>
				<th><?php echo 'Car name';?></th>
                <th><?php echo 'Name';?></th>
				<th><?php echo 'Email';?></th>
				<th><?php echo 'Phone';?></th>
				<th><?php echo 'Message';?></th>
			    <th><?php echo $text_delete;?></th>
              </tr>
              </thead>
              <tbody>
		      <?php  foreach($users as $user) { ?>
              <tr>
                <td><?php echo $user['id'];?></td>
				 <td><?php echo date("d-M-y", strtotime($user['published'])); ?></td>
                <td><?php 
					echo $pro_name=$this->db->get_where('rent_to_buy',array('id'=>$user['product_id']))->row()->title;
					?></td> 
				<td><?php echo $user['name'];?></td>	
				<td><?php echo $user['email'];?></td>
				<td><?php echo $user['phone'];?></td>
				<td><?php echo $user['message'];?></td>
				
                <td>
		        <div class="tools">
                <a href="#" data-href="<?php echo $user['delete_link'];?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                </div>
		        </td>                
              </tr>
            <?php } ?>
              </tbody>
            </table>
		  </div> <!-- /.box-body -->
		  <div class="box-footer">
			<div class="row">
			  <div class="col-sm-5"><div><?php echo $text_showing;?></div></div>			 
			  <div class="col-sm-7"><div><ul class="pagination"><?php echo $pagination;?></ul></div></div>
			</div>
		  </div> <!-- /.box-footer --> 
        </div><!-- /.box -->        
	  </div>     <!-- /.col -->
    </div><!-- /.row -->     
  </section>   
</div><!-- /.content -->
<?php echo $footer;?>