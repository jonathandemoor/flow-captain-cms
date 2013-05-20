<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'horizontalForm',
    'type'		=>'horizontal',    
)); ?>
 
<fieldset>
  	<?php echo $form->dropDownListRow($model, 'page_id', $pages); ?>
    <?php echo $form->textFieldRow($model, 'name', array('hint'=>'Hint: Reference name')); ?>
    <?php echo $form->textFieldRow($model, 'title', array('hint'=>'Hint: Head title of the page')); ?>
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
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('admin/contentBlock/index'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>
