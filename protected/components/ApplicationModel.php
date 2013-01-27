<?php

class ApplicationModel extends CActiveRecord {
   
	public function save($runValidation = true, $attributes = null) {		
		
		$user = User::model()->findActiveByEmail(Yii::app()->user->name);
		
		if ($this->isNewRecord) {
			try {
				$this->created_on = time();				
				$this->created_by = $user->fullname;
			} catch (Exception $e) {
				Yii::log('Failed to insert created_on, created_by', 'error', 'AppModel');				
			}
		}
		
		try {
			$this->updated_on = time();	
			$this->updated_by = $user->fullname;		

		} catch (Exception $e) {
			Yii::log('Failed to update update_on, updated_by', 'error', 'AppModel');
		}
				
		return parent::save($runValidation, $attributes);
	}	
}
