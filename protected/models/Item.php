<?php

class Item extends ApplicationModel
{
    public $image = '';
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'Item';
    }
 
    public function rules()
    {
        return array(
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'image'       => 'Image',

        );
    }
    
    
    // Save a publication
    /*public function save() {
    	// Create the directory if it doesn't exist
            //TPFileSystem::createDirectory(dirname(dirname($this->getRealPath())));
            //TPFileSystem::createDirectory(dirname($this->getRealPath()));


            // Save the publication file and set the proper file permissions
            $this->image->saveAs(realpath(dirname(__FILE__) . '/../../upload/test.png'));
            @chmod(realpath(dirname(__FILE__) . '/../../upload/test.png', 0777));

   }*/
    
    // Get the publication folder path
    public function getPublicationFolderPath() {
        return Yii::app()->params['dataFolder'] . '/publications/' . $this->publication_identifier;
    }

}