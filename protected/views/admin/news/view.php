<div class="page-header">
	<p class="btn-toolbar pull-right">    	
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Back',
            'size'  => 'normal',
            'url'   => array('admin/news/index'),
        )); ?>
    </p>
    <h1>News Detail</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array('name' => 'title'),
        array('name' => 'content'),
        array(
        	'name'  => 'date',
        	'type'  => 'raw',
            'value' => date('H:m - d M Y', $model->date)
        ),
        array('name'=>'created_by'),
        array(
        	'name'  => 'updated_on',
        	'type'  => 'raw',
            'value' => date('H:m - d M Y', $model->updated_on)
        ),
        array('name' => 'updated_by'),
        array(
        	'name'  => 'created_on',
        	'type'  => 'raw',
            'value' => date('H:m - d M Y', $model->created_on)
        ),
    ),
)); ?>