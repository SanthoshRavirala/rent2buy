<?php echo $header;?>
<div class="container">     
  <div class="jumbotron">
    <div class="container">
  	  <h1><?php echo $category['name'];?></h1>
  	  <p><?php echo $text_description;?></p>
  	  <p>Change this text in frontend/view/category.php or change data in controllers/category.php</p>
  	  <p>Add / edit categories in admin -> category.</p>
  	  <p class="text-success">Name of this category is : <?php echo $category['name'];?>.</p>
  	  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
    </div>
  </div>
    	
  <div class="row">
	<div class="col-md-3">
	<?php echo $content_left; ?>
	</div>
	<div class="col-md-9">
	<?php echo $content_top;?>         
	</div>
  </div><!--/row-->
</div><!--/.container-->
<?php echo $footer;?>