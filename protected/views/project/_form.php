<?php $this->renderPartial('../_partials/wysiwyg_editor') ?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal',    
)); ?>
 
<fieldset>
    <?php echo $form->textFieldRow($model, 'title'); ?>
    <?php echo $form->textAreaRow($model, 'content', array('id'=>'wysi_textarea')); ?>
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('project/admin'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
        // Wysiwyg html editor
        $('#wysi_textarea').wysihtml5({"color": true});
    });
</script>