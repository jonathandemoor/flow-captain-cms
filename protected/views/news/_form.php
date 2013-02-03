<?php $this->renderPartial('../_partials/jquery_ui') ?>
<?php $this->renderPartial('../_partials/wysiwyg_editor') ?>
	
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal',    
)); ?>
 
<fieldset>  
    <?php echo $form->textFieldRow($model, 'title'); ?>
    <?php echo $form->textAreaRow($model, 'content', array('id'=>'wysi_textarea')); ?> 
    <?php echo $form->textFieldRow($model, 'date', array('id'=>'datepicker')); ?> 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('news/index'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
    	// jQuery UI
        $('#datepicker').datetimepicker();
        // Wysiwyg html editor
        $('#wysi_textarea').wysihtml5({"color": true});
    });
</script>