<?php

class ContentBlock extends ApplicationModel 
{
    public static function model($className=__CLASS__) 
    {
        return parent::model($className);
    }
    
    public function tableName() 
    {
        return 'tbl_content_blocks';
    }
    
    public function rules() 
    {
        return array(
            array(
                'name, content, page_id',
                'required'
            ),
            array(
                'title, content_short',
                'safe'
            ),
        );
    }
    
    public function attributeLabels() 
    {
        return array(
            'name'           => 'Name',
            'content' 		 => 'Content',
            'title' 		 => 'Title',
            'page_id'		 => 'Page',
            'pages.name'	 => 'Page',
            'content_short'	 => 'Content Preview'
        );
    }
    
    public function relations()
    {
        return array(
            'pages'=>array(self::BELONGS_TO, 'Page', 'page_id'),
        );
    }
    
    public function findByID($id) 
    {
        return $this->find(
            'id = :id',
            array('id' => $id)
        );
    }
    
    public function findByName($name) 
    {
        return $this->find(
            'name = :name',
            array('name' => $name)
        );
    }
}
