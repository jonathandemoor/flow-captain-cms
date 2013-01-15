
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal',    
)); ?>
 
<fieldset>
  	<?php echo $form->textFieldRow($model, 'page_id'); ?>
    <?php echo $form->textFieldRow($model, 'name', array('hint'=>'Hint: Reference name')); ?>
    <?php echo $form->textFieldRow($model, 'title', array('hint'=>'Hint: Head title of the page')); ?>
    <?php echo $form->textAreaRow($model, 'content'); ?>
    

 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('contentBlock/admin'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>