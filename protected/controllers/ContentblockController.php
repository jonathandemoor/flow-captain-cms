<?php

class ContentblockController extends ApplicationController {
    
    public $defaultAction = 'admin';
    public $adminActions  = array('admin', 'view', 'add', 'update', 'delete');
    
    public function actionAdmin() {
    	
		$criteria = new CDbCriteria;
		
		if(isset($_GET['filter'])) {
		    $criteria->condition = 'page_id = ' . $_GET['filter'];
	    }
		
   		$dataProvider = new CActiveDataProvider(
			'ContentBlock', array(
				'criteria' => $criteria,			    
			    'pagination' => array(
			        'pageSize' => 15,
			    ),
			)
		);
		
		$pages = Page::model()->findAllForFilter();
				
		$this->render('admin', array('dataProvider' => $dataProvider, 'pages' => $pages));
    }
    
    public function actionView() {
				
		$this->render('view', array('model' => $this->loadModel()));
    }
    
    public function actionAdd() {
    
    	$model = new ContentBlock();
    	    			
		if (isset($_POST['ContentBlock'])) {
			$model->attributes = $_POST['ContentBlock'];
						
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}			
		}
						
		$this->render('add', array(
								'model' => $model,
								'pages'	=> Page::model()->findAllForSelect()
							 ));
    } 
    
     public function actionUpdate() {
	    
    	$model = $this->loadModel();
    	    	    			
		if (isset($_POST['ContentBlock'])) {
			$model->attributes = $_POST['ContentBlock'];
									
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('admin'));
			}			
		}	
				
		$this->render('update', array(
								'model' => $model,
								'pages'	=> Page::model()->findAllForSelect()
							 ));
    } 
    
    public function actionDelete() {
	    
    	$model = $this->loadModel();
    	
    	$model->delete();	
    } 
    
    protected function loadModel() {
        if (!isset($_GET['id'])) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $model = ContentBlock::model()->findByPk($_GET['id']);
        if (!$model) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}