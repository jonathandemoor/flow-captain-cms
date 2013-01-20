<?php

class ContentblockController extends ApplicationController {
    
    public $defaultAction = 'admin';
    public $adminActions  = array('admin', 'add', 'update', 'delete');
    
    public function actionAdd() {
    
    	$model = new ContentBlock();
    	    			
		// Validate and save the model
		if (isset($_POST['ContentBlock'])) {
			$model->attributes = $_POST['ContentBlock'];
			
			//$model['content_short'] = substr($model->content, 0, 40) . ' ...';
			
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
    	$model = ContentBlock::model()->findByID($_GET['id']);
    	    	    			
		// Validate and save the model
		if (isset($_POST['ContentBlock'])) {
			$model->attributes = $_POST['ContentBlock'];
						
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
	    
    	$model = ContentBlock::model()->findByID($_GET['id']);
    	
    	$model->delete();	
    } 
    
    public function actionAdmin() {
    	
    	// Relation Pages    
		$criteria = new CDbCriteria;
		$criteria->with = array('pages');
		
		if(isset($_GET['filter'])) {
		    $criteria->condition = 'page_id = ' . $_GET['filter'];
	    }
		
    	    
	    // Create the data provider
		$dataProvider = new CActiveDataProvider(
			'ContentBlock', array(
				'criteria' => $criteria,			    
			    'pagination' => array(
			        'pageSize' => 15,
			    ),
			)
		);
		
		$pages = Page::model()->findAllForSelect();
				
		$this->render('admin', array('dataProvider' => $dataProvider, 'pages' => $pages));
    }
}