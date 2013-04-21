<?php

class Project extends ApplicationModel {
                
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'tbl_projects';
    }
    
    public function rules() {
        return array(
            array(
                'title, content',
                'required'
            ),
        );
    }
    
    public function attributeLabels() {
        return array(
            'content' 		 => 'Content',
            'title' 		 => 'Title',
        );
    }
    
    public function findByID($id) {
        return $this->find(
            'id = :id',
            array('id' => $id)
        );
    }
    
    public function removeTmpFolder($username) {
	    $pathTmp = FCTools::getRealPath() . 'tmp/' . $username . '/';
	    
	    // Remove tmp folder
		if(file_exists($pathTmp)) {
			FCTools::deleteDirTree($pathTmp);
		}
    }
    
    public function saveImages($username) {
    
    	$pathTmp   = FCTools::getRealPath() . 'tmp/' . $username . '/';
    	$pathFinal = FCTools::getRealPath() . 'final/' . $this->id . '/';
    	
    	// Create directories
    	FCTools::createDirectory($pathFinal);
    	FCTools::createDirectory($pathFinal . 'images');
    	FCTools::createDirectory($pathFinal . 'thumbs');
    	
    	// Copy images to final
    	$filesImages = scandir($pathTmp . 'images/');
    	
		foreach($filesImages as $file) {
			if(($file != '.') && ($file != '..')) {	
				if(!is_dir($file)) {	
					copy($pathTmp . 'images/' . $file, $pathFinal . 'images/' . $file);
				}
			}
		}
		
		// Copy thumbs to final
		$filesThumbs = scandir($pathTmp . 'thumbs/');
    	
		foreach($filesThumbs as $file) {
			if(($file != '.') && ($file != '..')) {	
				if(!is_dir($file)) {				
					copy($pathTmp . 'thumbs/' . $file, $pathFinal . 'thumbs/' . $file);
				}
			}
		}
		
		// Remove tmp folder
		$this->removeTmpFolder($username);
    }
    
    public function moveToTempFolder($username) {
    	
    	// Create dir if not exists
    	$path = FCTools::getRealPath() . 'tmp/';
    	
    	FCTools::createDirectory($path . $this->user_main->fullname . '/');
    	
    	// Paths to tmp and final dir
    	$pathTmp   = FCTools::getRealPath() . 'tmp/' . $username . '/';
    	$pathFinal = FCTools::getRealPath() . 'final/' . $this->id . '/';
    	
    	// Copy images to tmp
    	$filesImages = scandir($pathFinal . 'images/');
    	
		foreach($filesImages as $file) {
			if(($file != '.') && ($file != '..')) {	
				if(!is_dir($file)) {			
					copy($pathFinal . 'images/' . $file, $pathTmp . 'images/' . $file);
				}
			}
		}
		
		// Copy thumbs to tmp
		$filesThumbs = scandir($pathFinal . 'thumbs/');
    	
		foreach($filesThumbs as $file) {		
			if(($file != '.') && ($file != '..')) {	
				if(!is_dir($file)) {
					copy($pathFinal . 'thumbs/' . $file, $pathTmp . 'thumbs/' . $file);
				}
			}
		}
    }
}
