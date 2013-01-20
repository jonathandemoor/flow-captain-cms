<?php

class AdminController extends ApplicationController {
    
    public $defaultAction = 'login';
    public $adminActions  = array('home');
    public $pageTitle     = 'Home';
    
    public function actionHome() {
    	$model = new Item();
		
		// Validate and save the model
		if (isset($_POST['Item'])) {
			$model->attributes       = $_POST['Item'];

			$model->image = CUploadedFile::getInstance($model, 'image');			

            $model->image->saveAs(dirname(__FILE__) . '/../../upload/' . 'test.png');
            $model->save();
            
            //resize
            
            $image = Yii::app()->image->load(dirname(__FILE__) . '/../../upload/' . 'test.png'); // Instantiate the library
			$image->resize(400, NULL); // apply image manipulations	
			$image->save();
		}		

		$this->render('home', array('model' => $model));
    }
    
    public function actionLogin() {
        
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('admin/home'));
        }
        
        $form = new LoginForm();
        if (isset($_POST['LoginForm'])) {        
        
            $form->attributes = $_POST['LoginForm'];
            
            if ($form->validate() && $form->login()) {
                $this->redirect(array('admin/home'));
            }
        }
        
        $this->render('login',array('form' => $form));
        
    }
    
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    
}