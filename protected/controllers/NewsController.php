<?php

class NewsController extends ApplicationController {
    
    public $defaultAction = 'admin';
    public $adminActions  = array('admin', 'view', 'add', 'update', 'delete');
    
    public function actionAdmin() {
    	    
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
    
    public function actionView() {
    	    		
		$this->render('view', array('model' => $this->loadModel()));
    } 
    
    public function actionAdd() {
    
    	$model = new News();
    	
    	$model['date'] = date('m/d/Y H:i');
    			
		if (isset($_POST['News'])) {
			$model->attributes = $_POST['News'];
			
			$model_date = strtotime($model->date);
			
			$model['date'] = $model_date;
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
			
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}			
		}		
		
		$this->render('add', array('model' => $model));
    } 
    
     public function actionUpdate() {
	    
	    $model = $this->loadModel();
    	    			
		if (isset($_POST['News'])) {
			$model->attributes = $_POST['News'];
			
			$model_date = strtotime($model->date);
			
			$model['date'] = $model_date;
						
			$model['content_short'] = FCTools::generateShortContent($model->content);
			
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
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
        $model = News::model()->findByPk($_GET['id']);
        if (!$model) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}