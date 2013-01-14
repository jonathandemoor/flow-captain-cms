<div class="page-header">
	<div class="btn-toolbar pull-right">

		<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
	        'buttons'=>array(
	            array('label'=>'Filter on page', 'items'=>array(
	                array('label'=>'Action', 'url'=>'#'),
	                array('label'=>'Another action', 'url'=>'#'),
	                array('label'=>'Something else', 'url'=>'#'),
	                '---',
	                array('label'=>'Separate link', 'url'=>'#'),
	            )),
	        ),
	    )); ?>
	    
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Add Content Block',
            'size'  => 'normal',
            'url'   => array('contentblock/add'),
            'type'	=>'primary'
        )); ?>
        
    </div>

	<h1>Content Blocks</h1>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered',
    'enableSorting' => false,
    'dataProvider' => $dataProvider,
    'columns'=>array(
    	array('name'=>'name', 'header'=>'Name'),
        array('name'=>'title', 'header'=>'Title'),
        array('name'=>'page', 'header'=>'Page'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>' {update} {delete}',
            'htmlOptions'=>array('style'=>'width: 50px; text-align: center;'),
        ),
    ),
)); ?>