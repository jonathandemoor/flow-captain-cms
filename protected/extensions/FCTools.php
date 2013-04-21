<?php

class FCTools {

	public static function generateShortContent($text) {
		$replacements = array(
							"<br>" => " ", 
							"<br/>" => " ", 
							"<br />" => " ", 
							"&nbsp;" => " "
						 );
						 
		$text_convert = strtr($text, $replacements);
		
    	$text_stripped = strip_tags($text_convert);
    	
    	$result = substr($text_stripped, 0, 60) . ' ...';
	    
	    return $result;
    }
    
    public static function getRealPath() {
		return Yii::app()->getBasePath() . '/../data/project_images/';
	}
	
	public static function getPublicPath() {
		return Yii::app()->getBaseUrl() . '/data/project_images/';
	}
	
	public static function createDirectory($dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        @chmod($dir, 0777);
	}
	
	public static function deleteDirTree($dirPath) {
	    if (!is_dir($dirPath)) {
	    	return;
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $iterator = new RecursiveIteratorIterator(
	    	new RecursiveDirectoryIterator($dirPath),
	    	RecursiveIteratorIterator::CHILD_FIRST
	    );
		foreach ($iterator as $file) {
		    if (is_dir($file)) {
		        @rmdir($file);
		    } else {
		        @unlink($file);
		    }
		}
	    @rmdir($dirPath);
	}
	
	public static function getFileSize($pathOrSize) {

		// You can either use bytes or a file path
		if (!is_numeric($pathOrSize)) {
			if (file_exists($pathOrSize)) {
				$bytes = filesize($pathOrSize);
			} else {
				$bytes = 0;
			}
		} else {
			$bytes = $pathOrSize;
		}
		
		return $bytes;
	}
	
}