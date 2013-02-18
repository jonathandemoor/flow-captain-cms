<?php

class ContentblockController extends ApplicationController {
    
    public $defaultAction = 'index';
    public $adminActions  = array('index', 'view', 'add', 'update', 'delete');
    
    public function actionIndex() {
    	
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
						
		$this->render('index', array(
								'dataProvider' => $dataProvider, 
								'pages_list'   => Page::model()->findAllForList(),
								));
    }
    
    public function actionView() {
				
		$this->render('view', array('model' => $this->loadModel()));
    }
    
    public function actionAdd() {
    
    	$model = new ContentBlock();
    	    			
		if (isset($_POST['ContentBlock'])) {
			$model->attributes = $_POST['ContentBlock'];
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
						
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('index'));
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
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
									
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('index'));
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