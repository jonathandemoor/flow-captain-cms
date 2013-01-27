<div class="page-header">
	<p class="btn-toolbar pull-right">    	
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Back',
            'size'  => 'normal',
            'url'   => array('news/admin'),
        )); ?>
    </p>
    <h1>Content Detail</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array('name' => 'name'),
        array('name' => 'title'),
        array('name' => 'pages.name'),
        array(
        	'name'   => 'content',
        	'type'   => 'raw',
        	'value'  => html_entity_decode($model->content, ENT_COMPAT, 'UTF-8')
        ),
        array('name' => 'created_by'),
        array(
        	'name'   => 'updated_on',
        	'type'   => 'raw',
            'value'  => date('H:m - d M Y', $model->updated_on)
        ),
        array('name' => 'updated_by'),
        array(
        	'name'   => 'created_on',
        	'type'   => 'raw',
            'value'  => date('H:m - d M Y', $model->created_on)
        ),
    ),
)); ?>