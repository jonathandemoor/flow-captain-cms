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
	
}