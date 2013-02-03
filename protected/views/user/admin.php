<div class="page-header">
    <p class="btn-toolbar pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add User',
            'size'  => 'normal',
            'url'   => array('user/add'),
            'type'	=>'primary'
        )); ?>
    </p>

	<h1>Users</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered',
    'enableSorting' => false,
    'dataProvider' => $dataProvider,
    'columns' => array(
        array('name' => 'fullname', 'header'=>'Name'),
        array('name' => 'email', 'header'=>'Email'),
        array(
        	'name'  => 'role',
        	'type'  => 'raw',
            'value' => '$data->role->name'
        ),
        array(
            'class'			=> 'bootstrap.widgets.TbButtonColumn',
            'template'		=> '{view} {update} {delete}',
            'htmlOptions'	=> array('style' => 'width: 50px; text-align: center;'),
        ),
    ),
)); ?>