<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/js/jquery.fancybox.js'; ?>"></script>

<legend>Add Images</legend>  
<div id="upload_container">  
    <?php $this->widget('xupload.XUpload', array(
        'url' 		  => Yii::app()->createUrl("/project/upload"),
        'model' 	  => $photos,
        'htmlOptions' => array('id' => 'xupluad_form'),
        'attribute'   => 'file',
        'multiple'    => true,          
    	'options' 	  => array(
            				'maxFileSize' => 1024*1024*10,
            			 ),		            
         //'formView' => 'application.views.article.viewUpload',
       )    
    ); ?>
</div>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'		=>'xupluad_form',
    'type'		=>'horizontal',    
    'enableAjaxValidation' => false,
      'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
<legend>Project Details</legend>
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
</fieldset>


       
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Save')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('admin/project/index'),
        )); ?>
</div>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
        
        /*
$("legend").click(function(){
        	var wysihtml5Editor = $('#wysi_textarea').data("wysihtml5").editor;
        	wysihtml5Editor.composer.commands.exec("insertImage", "http://midwestresearchswine.com/wp-content/uploads/2011/02/pigSingleLarge.jpg");
  		});
*/
		
		fc_base_url = '<?php echo Yii::app()->request->baseUrl; ?>';
		
		
		$("legend").click(function(){
			// Open fancy box for image upload
			$.fancybox.open({
				//minHeight : $(document).height() * 0.75,
				minHeight : 720,
				autoDimensions : false, 
				href : fc_base_url + '/admin/files/index',
				type : 'iframe',
				padding : 0,
				autoScale : false,
				autoHeight : false,
				beforeClose  : function(){  },
			});
		});	
        
    });
</script>