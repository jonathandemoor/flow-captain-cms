<div class="page-header">
	<div class="btn-toolbar pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Project',
            'size'  => 'normal',
            'url'   => array('admin/project/add'),
            'type'	=> 'primary'
        )); ?>
        
    </div>

	<h1>Projects</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'enableSorting' => false,
    'dataProvider' => $items,
    'columns'=>array(
        array('name' => 'title'),
        array('name' => 'content_short'),
        array(
            'class'		  => 'bootstrap.widgets.TbButtonColumn',
            'template'	  => '{view} {update} {delete}',
            'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
        ),
    ),
)); ?>