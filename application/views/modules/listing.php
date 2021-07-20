<?php $labels = array();?>
<?php foreach($polls as $poll) { ?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><?php echo $poll['name'];?></h4>
		</div>
		<div class="panel-body">
		<br/>
			<div id="chart<?php echo $poll['poll_id'];?>"><?php echo $text_first;?></div>
		</div>
		<div class="panel-footer">
			<a href="<?php echo $poll['link_vote'];?>" class="btn danger"><?php echo $text_vote;?></a>
			<a href="<?php echo $poll['link'];?>" class="btn warning pull-right"><?php echo $text_view_results;?></a>
		</div>
	</div>
</div>
    <?php foreach($poll['votes'] as $vote) {
	    $labels[$poll['poll_id']][] = '{"label":"'. $vote['name'] .'", "value":'. $vote['total'] .'}';
    }
} ?>
<script>
<?php foreach($labels as $key => $label){ ?>
	$('#chart<?php echo $key;?>').html('');
	var data_<?php echo $key;?> = [<?php echo implode(',', $label); ?>];
	createPie([<?php echo implode(',', $label); ?>],'#chart<?php echo $key;?>',180,180,6);
<?php } ?>
</script>			