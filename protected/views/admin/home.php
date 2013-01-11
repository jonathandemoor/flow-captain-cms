<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'          => 'uploadPublicationForm',
    'type'        => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)) ?>

    <div class="row">
        <div class="span6">
            <fieldset>
                <legend>Publication Details</legend>
				<?php echo $form->fileFieldRow($model, 'image', array('hint'=>'iWork documents should always be zipped before uploading')) ?>
            </fieldset>

        </div>
    </div>
    
    <div class="form-actions">
        <?php echo CHtml::htmlButton('Add Publication',
            array('class'=>'btn btn-primary', 'type'=>'submit', 'id' => 'uploadPublication')
        ) ?>
    </div>

<?php $this->endWidget(); ?>