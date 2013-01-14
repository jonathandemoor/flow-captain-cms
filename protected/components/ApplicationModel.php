<?php

class ApplicationModel extends CActiveRecord {
   
	public function save($runValidation = true, $attributes = null) {
		
		// Check if is new record
		if ($this->isNewRecord) {
			// Set created time
			$this->created_on = new CDbExpression('NOW()');
		}
		
		$this->updated_on = new CDbExpression('NOW()');

		return parent::save($runValidation, $attributes);
	}
	
}
