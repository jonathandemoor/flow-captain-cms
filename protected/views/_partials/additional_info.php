<p class="pull-right">
<?php 
	if(!empty($model->updated_on)) {
		$this->widget('bootstrap.widgets.TbLabel', array(
		    'type'	=>'default',
		    'label'	=> 'Updated on: ' . date('H:m - d M Y', $model->updated_on),
		)); 
	}
?>


<?php 
	if(!empty($model->updated_by)) {
		$this->widget('bootstrap.widgets.TbLabel', array(
		    'type'	=>'default',
		    'label'	=> 'Updated by: ' . $model->updated_by,
		)); 
	}
?>
</p>