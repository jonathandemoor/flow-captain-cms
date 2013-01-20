<?php

class ApplicationController extends CController
{
	public $layout			= 'main';
	public $user_main       = null;
	public $adminActions  	= array();
	
	// Enable access controler
	public function filters() {
        return array(
            'accessControl',
        );
    }
	
	public function beforeAction($action) {

    	// Get the current user details
        try {
            $this->user_main = User::model()->findActiveByEmail(Yii::app()->user->name);
            
        } catch (Exception $e) {
            $this->user_main = false;
        }
                
        return true;
    }
    
    public function accessRules() {
        $rules = array(
            array(
                'allow',
                'actions' => array('login'),
                'users' => array('*'),
            ),
            array(
                'allow',
                'users' => array('*'),
            ),
        );
        
        if (sizeof($this->adminActions) > 0) {
            array_unshift(
                $rules,
                array(
                    'deny',
                    'actions' => $this->adminActions,
                    'expression' => 'Yii::app()->user->isGuest',
                )
            );
        }
        return $rules;
    }
    
    public function render($template, $variables=array()) {
		
		if (in_array($this->action->id, $this->adminActions) || $this->action->id == 'login') {
            $this->layout = 'admin';
        } else if($this->action->id == 'index') {
			$this->layout = 'main';
		} 
		else {
			$this->layout = 'main';
		}
		
		return parent::render($template, $variables); 
	}
}