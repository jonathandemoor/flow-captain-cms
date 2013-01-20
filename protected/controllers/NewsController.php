<?php

class NewsController extends ApplicationController {
    
    public $defaultAction = 'view';
    public $adminActions  = array('admin', 'add', 'update', 'delete');
    
    public function actionView() {
    	$model = new News();
    			
		// Validate and save the model
		if (isset($_POST['News'])) {
			$model->attributes = $_POST['News'];
			
		}		
		
		$this->render('view', array('model' => $model));
    } 
    
    public function actionAdd() {
    
    	$model = new News();
    	
    	$model['date'] = date('m/d/Y H:i');
    			
		// Validate and save the model
		if (isset($_POST['News'])) {
			$model->attributes = $_POST['News'];
			
			$model_date = strtotime($model->date);
			
			$model['date'] = date('Y-m-d H:i:s', $model_date);
			
			$model['content_short'] = substr($model->content, 0, 40) . ' ...';
			
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}
			
		}		
		
		$this->render('add', array('model' => $model));
    } 
    
     public function actionUpdate() {
	    
	    if(!isset($_GET['id'])) {
		    $this->render('admin');
	    }
    	$model = News::model()->findByID($_GET['id']);
    	    			
		// Validate and save the model
		if (isset($_POST['News'])) {
			$model->attributes = $_POST['News'];
			
			$model_date = strtotime($model->date);
			
			$model['date'] = date('Y-m-d H:i:s', $model_date);
			
			$model['content_short'] = substr($model->content, 0, 40) . ' ...';
			
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}
			
		}		
		
		$this->render('update', array('model' => $model));
    } 
    
    public function actionDelete() {
	    
	    if(!isset($_GET['id'])) {
		    $this->render('admin');
	    }
	    
    	$model = News::model()->findByID($_GET['id']);
    	
    	$model->delete();	
    } 
    
    public function actionAdmin() {
    	    
	    // Create the data provider
		$dataProvider = new CActiveDataProvider(
			'News', array(
				'criteria' => array(
					'order'     => 'date DESC',
					
			    ),
			    'pagination' => array(
			        'pageSize' => 15,
			    ),
			)
		);
		
		$this->render('admin', array('dataProvider' => $dataProvider));
    }
}