<div class="page-header">
	<p class="btn-toolbar pull-right">    	
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Back',
            'size'  => 'normal',
            'url'   => array('admin/user/index'),
        )); ?>
    </p>
    <h1>Add User</h1>
</div>

<?php $this->renderPartial('_form', array(
										'model' => $model,
										'roles' => $roles
									)) ?>