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
    	
    	Yii::import("xupload.models.XUploadForm");
		
		// Remove layout	
		$this->layout = 'upload';

	    $photos = new XUploadForm;
	    
    
    	$model = new Project();
    	    			
		if (isset($_POST['Project'])) {
			$model->attributes = $_POST['Project'];
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
						
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('index'));
			}			
		}
						
		$this->render('add', 
			array(
				'model'  => $model,
				'photos' => $photos
			));
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
    
    // Upload images
	public function actionUpload() {
		
		Yii::import("xupload.models.XUploadForm");
		
	 	$path 	    = FCTools::getRealPath() . 'tmp/';
	 	$publicPath = FCTools::getPublicPath() . 'tmp/';	
	 	
	 	FCTools::createDirectory($path . $this->user_main->fullname . '/');
	 	
	 	$path 		.= $this->user_main->fullname . '/';
	 	$publicPath .= $this->user_main->fullname . '/';
	 	
	 	// Subfolder: images/thumbs
	 	FCTools::createDirectory($path . 'images/');
	 	FCTools::createDirectory($path . 'thumbs/');	
    
	    // This is for IE which doens't handle 'Content-type: application/json' correctly
	    header('Vary: Accept');
	    if( isset($_SERVER['HTTP_ACCEPT']) 
	        && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
	        header('Content-type: application/json');
	    } else {
	        header('Content-type: text/plain');
	    }	    
	 
	    // Here we check if we are deleting and uploaded file
	    if(isset($_GET['_method'])) {
	        if($_GET['_method'] == 'delete') {
	            if($_GET['file'][0] !== '.') {
	            	// Delete function
	            	$this->actionDeleteImage($_GET['file']);         
	            }
	            echo json_encode(true);
	        }
	    } else {
	        $model = new XUploadForm;

	        $model->file = CUploadedFile::getInstance($model, 'file');        
	        
	        // Check that the file was successfully uploaded
	        if( $model->file !== null ) {
	            // Grab some data
	            $model->mime_type = $model->file->getType( );
	            $model->size 	  = $model->file->getSize();
	            $model->name 	  = $model->file->getName();
	            
	            //  Generate a random file name
	            $filename  = time() . '_' . substr($model->name, 0,strrpos($model->name,'.'));
	            $filename .= '.' . $model->file->getExtensionName();
	            if($model->validate()) {
	            	
	                // Move image to the temporary dir
	                $model->file->saveAs($path . '/images/' . $filename);
	                chmod($path . '/images/' . $filename, 0777);	                
	                
	                // Move thumb to the temporary dir
	                $image = Yii::app()->image->load($path . '/images/' . $filename);
	                $image->resize(100, 100)->quality(75);
	                $image->save($path . '/thumbs/' . $filename);
	                chmod($path. '/thumbs/' . $filename, 0777);
	                
	 	 
	                // Now we need to tell our widget that the upload was succesfull
	                // We do so, using the json structure defined in
	                echo json_encode( array( array(
	                        'name' 				=> $model->name,
	                        'type' 				=> $model->mime_type,
	                        'size' 				=> $model->size,
	                        'url' 				=> $publicPath . '/images/' . $filename,
	                        'thumbnail_url' 	=> $publicPath .'/thumbs/' . $filename,
	                        'delete_url' 		=> $this->createUrl('upload', array(
	                            									'_method' => 'delete',
	                            									'file' => $filename
	                            									)),
	                        'delete_type' 		=> 'POST'
	                    )));
	            } else {
	            
	                // If the upload failed for some reason we log some data and let the widget know
	                echo json_encode( array( 
	                    array('error' => $model->getErrors('file'),
	                )));
	                Yii::log('XUploadAction: '.CVarDumper::dumpAsString( $model->getErrors()),
	                    CLogger::LEVEL_ERROR, 'xupload.actions.XUploadAction' 
	                );
	            }
	        } else {
	            throw new CHttpException( 500, 'Could not upload file' );
	        }
	    }
	}
}