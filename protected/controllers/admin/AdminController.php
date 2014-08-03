<?php

class AdminController extends ApplicationController {
        
    public function actionHome() 
    {		
		$this->render('home');
    }
    
    public function actionProfile() 
    {    	
	    $model = $this->user_main;
    	$model->scenario = 'update';
    	    			
		if (isset($_POST['User'])) 
		{			
			$model->attributes = $_POST['User'];
			$model->password_repeat = $_POST['User']['password_repeat'];	
			
			if ($model->validate()) 
			{
				$model->save();
				
				$this->redirect(array('home'));
			}
		}		
		
		$this->render('profile', array('model' => $model));
    }  
}