<?php

class ProjectController extends ApplicationController {
    
    public $defaultAction = 'index';
    public $adminActions  = array('index', 'view', 'add', 'update', 'delete');
    
    public function actionIndex() {
		
   		$items = new CActiveDataProvider(
			'Project', array(
			    'pagination' => array(
			        'pageSize' => 15,
			    ),
			)
		);
						
		$this->render('index', array('items' => $items));
    }
    
    public function actionView() {
				
		$this->render('view', array('model' => $this->loadModel()));
    }
    
    public function actionAdd() {
    
    	$model = new Project();
    	    			
		if (isset($_POST['Project'])) {
			$model->attributes = $_POST['Project'];
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
						
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('index'));
			}			
		}
						
		$this->render('add', array('model' => $model));
    } 
    
     public function actionUpdate() {
	    
    	$model = $this->loadModel();
    	    	    			
		if (isset($_POST['Project'])) {
			$model->attributes = $_POST['Project'];
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
									
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('index'));
			}			
		}	
				
		$this->render('update', array('model' => $model));
    } 
    
    public function actionDelete() {
	    
    	$model = $this->loadModel();
    	
    	$model->delete();	
    } 
    
    protected function loadModel() {
        if (!isset($_GET['id'])) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = Project::model()->findByPk($_GET['id']);
        if (!$model) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}