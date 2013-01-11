<?php

class TPFileSystem {

	public static function fileExtension($path) {
	    $path_info = pathinfo($path);
	    return strtolower($path_info['extension']);
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

	public static function sizeDirTree($dirPath) {
	    if (!is_dir($dirPath)) {
	        return 0;
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $totalSize = 0;
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            $totalSize += self::sizeDirTree($file);
	        } else {
	            $totalSize += filesize($file);
	        }
	    }
	    return $totalSize;
	}

	public static function formattedFileSize($pathOrSize, $decimals=2) {

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

        // The different units
        $units = array(
            '1000000000000000000' => 'EB',
            '1000000000000000'	  => 'PB',
            '1000000000000'		  => 'TB',
            '1000000000'		  => 'GB',
            '1000000'			  => 'MB',
            '1000'				  => 'KB'
        );

        // If smaller than 1000, return it as bytes
        if ($bytes <= 1000) {
            return $bytes . ' bytes';
        }

        // Check the right format
        foreach ($units as $base => $title) {
            if (floor($bytes / $base) != 0) {
                return number_format(
                	$bytes / $base,
                	Yii::app()->params['num_decimals'],
                	Yii::app()->params['decimals_separator'],
                	Yii::app()->params['thousands_separator']
                ) . ' ' . $title;
            }
        }

	}

	public static function createDirectory($dir) {
        if (!file_exists($dir)) {
            mkdir($dir, Yii::app()->params['filePermissions'], true);
        }
        @chmod($dir, Yii::app()->params['filePermissions']);
	}

	public static function uncompressedZipSize($path) {

		// Open the zip file
        $zipFile = new ZipArchive();
        $result = $zipFile->open($path);

        // If the zipfile failed to open, return 0
        if ($result !== true || $zipFile->numFiles == 0) {
            return filesize($path);
        }

        // Loop over the entries and sum the size
        $size = 0;
        for ($i = 0; $i < $zipFile->numFiles; $i++) {
            $stat = $zipFile->statIndex($i);
			$size += $stat['size'];
        }

        // Close the zip file
        $zipFile->close();

        // Return the size
        return $size;

	}

}
