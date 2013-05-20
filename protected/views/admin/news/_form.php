<?php $this->renderPartial('../_partials_admin/jquery_ui') ?>
	
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal',    
)); ?>
 
<fieldset>  
    <?php echo $form->textFieldRow($model, 'title'); ?>
    <div class="control-group">
    	<div class="controls">
		    <?php $this->widget('ext.redactor.ERedactorWidget',array(
			    'model'=> $model,
			    'attribute' => 'content',
			    'options'=>array(
			        'fileUpload'=>Yii::app()->createUrl('publication/fileUpload',array(
			            'attr'=>'description'
			        )),
			        'fileUploadErrorCallback'=>new CJavaScriptExpression(
			            'function(obj,json) { alert(json.error); }'
			        ),
			        'imageUpload'=>Yii::app()->createUrl('publication/imageUpload',array(
			            'attr'=>'description'
			        )),
			        'imageGetJson'=>Yii::app()->createUrl('publication/imageList',array(
			            'attr'=>'description'
			        )),
			        'imageUploadErrorCallback'=>new CJavaScriptExpression(
			            'function(obj,json) { alert(json.error); }'
			        ),
			    ),
			)); ?>
    	</div>
    </div>
    <?php echo $form->textFieldRow($model, 'date', array('id'=>'datepicker')); ?> 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('admin/news/index'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
    	// jQuery UI
        $('#datepicker').datetimepicker();
    });
</script>