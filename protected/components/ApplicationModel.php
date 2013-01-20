<?php

class ApplicationModel extends CActiveRecord {
   
	public function save($runValidation = true, $attributes = null) {
		
		// Check if is new record
		if ($this->isNewRecord) {
			// Set created time
			$this->created_on = new CDbExpression('NOW()');
		}
		
		
		
		// For updated records, set the updated fields
		try {
			// Set updated time
			$this->updated_on = new CDbExpression('NOW()');

			// This doesn't work for console applications
			try {
				$user = User::model()->findActiveByEmail(Yii::app()->user->name);
				$this->updated_by = $user->fullname;
				
			} catch (Exception $e) {				
			}

		} catch (Exception $e) {
		}

		return parent::save($runValidation, $attributes);
	}
	
}
