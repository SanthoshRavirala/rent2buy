<div class="jumbotron">
  <div class="container">
	<h1>Hello, world!</h1>
	<p><?php echo $text_description;?></p>
	<p>Change this text in views/modules/latest.php or change data in libraries\modules\Latest.php</p>
	<p>Find this module in admin -> modules and disable or delete if you want</p>
	<p class="text-success">Regions in your database are : <?php echo implode(', ', $demo_data);?>.</p>
  </div>
</div>		