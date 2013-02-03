<?php

class UserController extends ApplicationController {
    
    public $defaultAction = 'admin';
    public $adminActions  = array('admin', 'view', 'add', 'update', 'delete');
    
    public function actionAdmin() {
    	    
		$dataProvider = new CActiveDataProvider(
			'User', array(
				'criteria' => array(
					'order'     => 'fullname ASC',
					
			    ),
			    'pagination' => array(
			        'pageSize' => 15,
			    ),
			)
		);
		
		$this->render('admin', array('dataProvider' => $dataProvider));
    }
    
    public function actionView() {
    	    		
		$this->render('view', array('model' => $this->loadModel()));
    } 
    
    public function actionAdd() {
    
    	$model = new User();
    	$model->scenario  = 'create';
    	$model->is_active = 1;
    	    			
		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}			
		}		
		
		$this->render('add', 
						array(
							'model' => $model,
							'roles'	=> Role::model()->findAllForSelect()
						));
    } 
    
     public function actionUpdate() {
	    
    	$model = $this->loadModel();
    	$model->scenario = 'update';
    	    			
		if (isset($_POST['User'])) {
			
			$model->attributes = $_POST['User'];
			$model->password_repeat = $_POST['User']['password_repeat'];	
			
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}
		}		
		
		$this->render('update', 
						array(
							'model' => $model,
							'roles'	=> Role::model()->findAllForSelect()
						));
    } 
    
    public function actionDelete() {
	    
    	$model = $this->loadModel();
    	    	
    	$model->delete();	
    } 
    
    private function generateShortContent($text) {
    	$text_stripped = strip_tags($text);
    	
    	$result = substr($text_stripped, 0, 60) . ' ...';
	    
	    return $result;
    }
    
    protected function loadModel() {
        if (!isset($_GET['id'])) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = User::model()->findByPk($_GET['id']);
        if (!$model) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}