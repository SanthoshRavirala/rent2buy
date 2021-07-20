<?php echo $header;?>
<div class="container">
  <div class="row">
    <div class="panel panel-primary">
	  <div class="panel-heading">
	  	<h3 class="panel-title">
          <span class="glyphicon glyphicon-arrow-right"></span>&nbsp;<?php echo $answer['name']; ?>&nbsp;<a href="<?php echo $link_results;?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>				
	  	</h3>
	  </div>
	  <form action="<?php echo $link_vote;?>" method="post">
	  <div class="panel-body">
	  	<ul class="list-group">
	  	<?php foreach($explanations as $explanation) { ?>	
	  	  <li class="list-group-item">
	  	  	<div class="radio">
	  	      <label>
	  	  		<input type="radio" name="explanation_id" value="<?php echo $explanation['explanation_id'];?>">&nbsp;&nbsp;<?php echo $explanation['name'];?>	  	  			
	  	  	  </label>
	  	  	</div>
	  	  </li>
	  	<?php } ?>
	  	</ul>
	  </div>
	  <div class="panel-footer">
	  	  <button type="submit" class="btn btn-primary btn-sm"><?php echo $text_vote;?></button>
	  </div>
	  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	  </form>
	</div>
  </div><!--/row-->
</div>
<?php echo $footer;?>