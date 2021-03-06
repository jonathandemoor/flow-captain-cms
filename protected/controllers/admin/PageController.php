<?php

class PageController extends ApplicationController {
    
    public $defaultAction = 'index';
    
    public function actionIndex() 
    {  
		$dataProvider = new CActiveDataProvider(
			'Page', array(
				'criteria' => array(
					'order'     => 'id ASC',
					
			    ),
			    'pagination' => array(
			        'pageSize' => 15,
			    ),
			)
		);
		
		$this->render('index', array('dataProvider' => $dataProvider));
    } 
    
    public function actionView() 
    {		
		$this->render('view', array('model' => $this->loadModel()));
    } 
    
    public function actionAdd() 
    {
    	$model = new Page();
    	    			
		if (isset($_POST['Page'])) 
		{
			$model->attributes = $_POST['Page'];
			
			if ($model->validate()) 
			{
				$model->save();
				
				$this->redirect(array('index'));
			}			
		}		
		
		$this->render('add', array('model' => $model));
    } 
    
     public function actionUpdate() 
     {
	    $model = $this->loadModel();
    	    			
		if (isset($_POST['Page'])) 
		{
			$model->attributes = $_POST['Page'];
			
			if ($model->validate()) 
			{
				$model->save();
				
				$this->redirect(array('index'));
			}			
		}		
		
		$this->render('update', array('model' => $model));
    } 
    
    public function actionDelete() 
    {
    	$model = $this->loadModel();
    	
    	$model->delete();	
    } 
    
    protected function loadModel() 
    {
        if (!isset($_GET['id'])) 
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        $model = Page::model()->findByPk($_GET['id']);

        if (!$model) 
        {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        
        return $model;
    }
}