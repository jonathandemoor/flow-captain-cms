<?php
    $this->pageTitle   = 'Roles';
?>

<div class="page-header">

    <div class="btn-toolbar pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Role',
            'type'  => 'primary',
            'htmlOptions' => array(
                'class' => 'largeButton',
            ),
            'url'   => array('admin/role/add'),
        )); ?>
    </div>

    <h1><?php echo $this->pageTitle ?></h1>

</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'enableSorting' => false,
    'dataProvider'  => $items,
    'columns'       => array(
        array('name' => 'id'),
        array('name' => 'name'),
        array(
            'class'			=> 'bootstrap.widgets.TbButtonColumn',
            'template'		=> '{update} {delete}',
            'htmlOptions'	=> array('style' => 'width: 50px; text-align: center;'),
        ),
    ),
)); ?>
