<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal',    
)); ?>
 
<fieldset>  
    <?php echo $form->textFieldRow($model, 'fullname'); ?>
    <?php echo $form->textFieldRow($model, 'email'); ?> 
    <?php if ($model->isNewRecord) { ?>
    	<?php echo $form->passwordFieldRow($model, 'password'); ?>
    <?php } else { ?>
    	<?php echo $form->passwordFieldRow($model, 'password_new'); ?>
    <?php } ?>
    <?php echo $form->passwordFieldRow($model, 'password_repeat'); ?>
    <?php echo $form->dropDownListRow($model, 'role_id', $roles); ?>
    <?php echo $form->checkboxRow($model, 'is_active'); ?> 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('admin/user/index'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>