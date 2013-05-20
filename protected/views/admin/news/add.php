<div class="page-header">
	<p class="btn-toolbar pull-right">    	
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Back',
            'size'  => 'normal',
            'url'   => array('admin/news/index'),
        )); ?>
    </p>
    <h1>Add News</h1>
</div>

<?php $this->renderPartial('_form', array('model' => $model)) ?>