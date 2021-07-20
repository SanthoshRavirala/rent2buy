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
			<div class="pull-right"><a class="btn btn-default" href="<?php echo $link_add;?>"><i class="fa fa-plus"></i>&nbsp;<?php echo $text_add;?></a></div>
          </div>
            <!-- /.box-header -->
          <div class="box-body">
		    <table id="example2" class="table table-bordered table-hover">
			  <thead>
			  <tr>
			    <th><?php echo $text_id;?></th>
			    <th><?php echo $text_name;?></th>
			    <th><?php echo $text_edit_delete;?></th>
			  </tr>
			  </thead>
			  <tbody>
			  <?php foreach($menus as $menu) { ?>
			  <tr>
			    <td><?php echo $menu['menu_id'];?></td>
			    <td><?php echo $menu['menu_name'];?></td>             
			    <td>
			     <div class="tools">
			  	   <a href="<?php echo $menu['link'];?>" class="btn btn-primary" ><i class="fa fa-edit"></i></a>
			  	   <a href="#" class="btn btn-danger" data-href="<?php echo $menu['delete_link'];?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
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