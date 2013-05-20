<div class="page-header">
    <p class="btn-toolbar pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add News',
            'size'  => 'normal',
            'url'   => array('admin/news/add'),
            'type'	=> 'primary'
        )); ?>
    </p>

	<h1>News</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'enableSorting' => false,
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'title'),
        array('name' => 'content_short'),
        array(
        	'name'  => 'date',
        	'type'  => 'raw',
            'value' => "date('H:m - d M Y', \$data->date)"
        ),
        array(
            'class'			=> 'bootstrap.widgets.TbButtonColumn',
            'template'		=> '{view} {update} {delete}',
            'htmlOptions'	=>  array('style' => 'width: 50px; text-align: center;'),
        ),
    ),
)); ?>