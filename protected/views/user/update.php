<div class="page-header">
	<p class="btn-toolbar pull-right">    	
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Back',
            'size'  => 'normal',
            'url'   => array('user/admin'),
        )); ?>
    </p>
    <h1>Update User</h1>
</div>

<?php $this->renderPartial('_form', array('model' => $model)) ?>
<?php $this->renderPartial('../_partials/additional_info', array('model' => $model)) ?>

