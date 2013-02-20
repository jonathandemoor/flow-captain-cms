<?php $this->renderPartial('../_partials/wysiwyg_editor') ?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'xupluad_form',
    'type'		=>'horizontal',    
    'enableAjaxValidation' => false,
      'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
<legend>Project Details</legend>
<fieldset>
    <?php echo $form->textFieldRow($model, 'title'); ?>
    <?php echo $form->textAreaRow($model, 'content', array('id'=>'wysi_textarea')); ?>
</fieldset>

<legend>Add Images</legend>  
<div id="upload_container">  
    <?php $this->widget('xupload.XUpload', array(
        'url' => Yii::app()->createUrl("/project/upload"),
        'model' => $photos,
        'htmlOptions' => array('id'=>'xupluad_form'),
        'attribute' => 'file',
        'multiple' => true,          
    	'options' => array(
            'maxFileSize' => 1024*1024*10,
            ),		            
         //'formView' => 'application.views.article.viewUpload',
       )    
    ); ?>
</div>
       
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('project/index'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
        // Wysiwyg html editor
        $('#wysi_textarea').wysihtml5({"color": true});
    });
</script>