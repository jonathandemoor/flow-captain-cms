<div class="page-header">
    <p class="btn-toolbar pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add News',
            'size'  => 'normal',
            'url'   => array('news/add'),
            'type'	=>'primary'
        )); ?>
    </p>

	<h1>News</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered',
    'enableSorting' => false,
    'dataProvider' => $dataProvider,
    'columns'=>array(
        array('name'=>'title', 'header'=>'Title'),
        array('name'=>'content_short', 'header'=>'Content'),
        array('name'=>'date', 'header'=>'Date'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {update} {delete}',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
        ),
    ),
)); ?>