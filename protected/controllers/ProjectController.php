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

	    $photos = new XUploadForm;    
    	$model  = new Project();
    	$model->removeTmpFolder($this->user_main->fullname);
    	
    	Yii::app()->session['project_id'] = 'add';
    	    			
		if (isset($_POST['Project'])) {
			$model->attributes = $_POST['Project'];
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
						
			if($model->validate()) {
				if($model->save()) {
					$model->saveImages($this->user_main->fullname);
				}
				
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
	    
	    Yii::import("xupload.models.XUploadForm");

	    $photos = new XUploadForm;
    	$model  = $this->loadModel();
    	Yii::app()->session['project_id'] = $model->id;
    	    	    			
		if (isset($_POST['Project'])) {
			$model->attributes = $_POST['Project'];
			
			$model['content_short'] = FCTools::generateShortContent($model->content);
									
			if($model->validate()) {
				$model->save();
				
				$this->redirect(array('index'));
			}			
		}	
				
		$this->render('update', 
			array(
				'model'  => $model,
				'photos' => $photos
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
        $model = Project::model()->findByPk($_GET['id']);
        if (!$model) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    
    // Reload existing images
	public function actionReloadImages() {
	
		Yii::import('xupload.models.XUploadForm');
		
		// Project id
		$project = Yii::app()->session['project_id'];
		
		$path 		= '';
		$publicPath = '';
		
		if($project == 'add') {
			$path 	    = FCTools::getRealPath() . 'tmp/';
			$publicPath = FCTools::getPublicPath() . 'tmp/';	
	
		} else {
			$path 	    = FCTools::getRealPath() . 'final/' . $project . '/';
			$publicPath = FCTools::getPublicPath() . 'final/' . $project . '/';	
		}

		// get all file names
		$files = glob($path . 'thumbs/*'); 		
		
		$jsonOutput = array();
		$userImages = array();

		// Loop over all files
		foreach($files as $i => $file) {  		   
		   
		   $imageInfo = array(
		        'name' 				=> basename($file),
		        'type' 				=> 'jpg',
		        'size' 				=> intval(FCTools::getFileSize($path . '/images/' . basename($file))),
		        'url' 				=> $publicPath . 'images/' . basename($file),
		        'thumbnail_url' 	=> $publicPath . 'thumbs/' . basename($file),
		        'delete_url' 		=> $this->createUrl('upload', array(
		            									'_method' => 'delete',
		            									'file' => basename($file)
		            									)),
		        'delete_type' 		=> 'DELETE'
		    );
		    
		    $userImage = array(
                'path' 		=> $publicPath . 'images/' . basename($file),
                'thumb' 	=> $publicPath . 'thumbs/' . basename($file),
                'filename' 	=> basename($file),
                'size' 		=> intval(FCTools::getFileSize($path . '/images/' . basename($file))),
                'mime' 		=> 'image/jpeg',
            );

		    // push to array
		    array_push($jsonOutput, $imageInfo);
		    array_push($userImages, $userImage);  
		}
		
		Yii::app()->session['xupload_images'] = $userImages;
		
		echo json_encode($jsonOutput);		
	}
    
    // Upload images
	public function actionUpload() {
		
		Yii::import("xupload.models.XUploadForm");
	 	
	 	// Project id
		$project = Yii::app()->session['project_id'];
		
		$path 		= '';
		$publicPath = '';
		
		if($project == 'add') {
			$path 	    = FCTools::getRealPath() . 'tmp/';
			$publicPath = FCTools::getPublicPath() . 'tmp/';	
	
		} else {
			$path 	    = FCTools::getRealPath() . 'final/' . $project . '/';
			$publicPath = FCTools::getPublicPath() . 'final/' . $project . '/';	
		}	
	 	
	 	
	 	if($project == 'add') {
		 	if(file_exists($path . $this->user_main->fullname . '/')) {
		 		FCTools::deleteDirTree($path . $this->user_main->fullname . '/');
		 	}
		 	
		 	FCTools::createDirectory($path . $this->user_main->fullname . '/');
		 	
		 	$path 		.= $this->user_main->fullname . '/';
		 	$publicPath .= $this->user_main->fullname . '/';
		 	
		 	// Subfolder: images/thumbs
		 	FCTools::createDirectory($path . 'images/');
		 	FCTools::createDirectory($path . 'thumbs/');
		}	
    
	    // This is for IE which doens't handle 'Content-type: application/json' correctly
	    header('Vary: Accept');
	    if(isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
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
	                
	                // Now we need to save this path to the user's session
	                if(Yii::app()->session['xupload_images']) {
	                    $userImages = Yii::app()->session['xupload_images'];
	                } else {
	                    $userImages = array();
	                }
	                
	                 $userImages[] = array(
	                    'path' 		=> $path . '/images/' . $filename,
	                    'thumb' 	=> $path . '/thumbs/' . $filename,
	                    'filename' 	=> $filename,
	                    'size' 		=> $model->size,
	                    'mime' 		=> $model->mime_type,
	                    'name' 		=> $model->name,
	                );
	                
	                Yii::app()->session['xupload_images'] = $userImages;
	 	 
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