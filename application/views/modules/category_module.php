<div class="list-group">
  <?php foreach($categories as $category){ ?>
	<a href="<?php echo $category['link'];?>" class="list-group-item"><?php echo $category['name'];?></a>
  <?php } ?>
</div>