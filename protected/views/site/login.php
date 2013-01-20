<div class="span3"></div>
<div class="span6 login_main">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal', 
    'htmlOptions'=>array('class'=>'well'),   
)); ?>

	<fieldset>
		<legend>Login - Flow Captain CMS</legend>
		
		<?php echo $form->textFieldRow($model, 'email') ?>
		<?php echo $form->passwordFieldRow($model, 'password') ?>
		<?php echo $form->checkboxRow($model, 'rememberMe') ?>
	</fieldset>

	<div class="form-actions">
		<?php echo CHtml::htmlButton('Login', array('class'=>'btn btn-primary', 'type'=>'submit')) ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Forgot your password',
            'size'  => 'normal',
            'url'   => array('site/passReset&username=' . $model['email']),
        )); ?>
	</div>

<?php $this->endWidget(); ?>
</div>