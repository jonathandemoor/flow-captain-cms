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
	
}