<div class="page-header">
    <p class="btn-toolbar pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Page',
            'size'  => 'normal',
            'url'   => array('page/add'),
            'type'	=> 'primary'
        )); ?>
    </p>

	<h1>Pages</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'enableSorting' => false,
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'id'),
        array('name' => 'name'),
        array(
            'class'			=> 'bootstrap.widgets.TbButtonColumn',
            'template'		=> '{view} {update} {delete}',
            'htmlOptions'	=> array('style' => 'width: 50px; text-align: center;'),
        ),
    ),
)); ?>