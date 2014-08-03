<?php

class News extends ApplicationModel 
{
    public static function model($className=__CLASS__) 
    {
        return parent::model($className);
    }
    
    public function tableName() 
    {
        return 'tbl_news';
    }
    
    public function rules() 
    {
        return array(
            array(
                'title, content',
                'required'
            ),
            array(
                'date, content_short',
                'safe'
            ),
        );
    }
    
    public function attributeLabels() 
    {
        return array(
            'content' 		 => 'Content',
            'title' 		 => 'Title',
            'date'			 => 'News date',
            'content_short'	 => 'Content Preview'
        );
    }
    
    public function findByID($id) 
    {
        return $this->find('id = :id', array('id' => $id));
    }
}
