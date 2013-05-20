<?php

class FilesController extends ApplicationController {
    
    public $defaultAction = 'index';
    
    public function actionIndex() {
		
		// Change layout	
		$this->layout = 'upload';	
					
		$this->render('index');
    }
}