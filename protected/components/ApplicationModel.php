<?php

class ApplicationModel extends CActiveRecord {
   
	public function save($runValidation = true, $attributes = null) {		
		// Check if is new record
		if ($this->isNewRecord) {
			// Set created time
			try {
				$this->created_on = new CDbExpression('NOW()');
			} catch (Exception $e) {
				Yii::log('Failed to insert created_on', 'error', 'AppModel');				
			}
		}
		
		// Updating record
		try {
			// Set updated time
			$this->updated_on = new CDbExpression('NOW()');			

		} catch (Exception $e) {
			Yii::log('Failed to update update_on', 'error', 'AppModel');
		}
		
		// Updating record
		try {
			// Set updated user
			$user = User::model()->findActiveByEmail(Yii::app()->user->name);
			$this->updated_by = $user->fullname;
			
		} catch (Exception $e) {
			Yii::log('Failed to update update_on', 'error', 'AppModel');				
		}
		
		return parent::save($runValidation, $attributes);
	}	
}
