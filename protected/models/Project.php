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
}
