<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'    => 'verticalForm',
    'type'  =>'horizontal',
    'focus' => array($item, 'name'),
)) ?>

    <fieldset>
        <legend>Role Details</legend>
        <?php echo $form->textFieldRow($item, 'name') ?>
    </fieldset>

    <div class="form-actions">
        <?php echo CHtml::htmlButton(
	        $item->isNewRecord ? 'Add' : 'Save',
	        array('class'=>'btn btn-primary', 'type' => 'submit')
        ) ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Cancel',
            'size'  => 'normal',
            'url'   => array('role/index'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>
