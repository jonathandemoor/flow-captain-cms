<?php

class ContentBlock extends ApplicationModel {
        
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'tbl_content_blocks';
    }
    
    public function rules() {
        return array(
            array(
                'name, content, page',
                'required'
            ),
            array(
                'title',
                'safe'
            ),
        );
    }
    
    public function attributeLabels() {
        return array(
            'name'           => 'Name',
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
    
    public function findByName($name) {
        return $this->find(
            'name = :name',
            array('name' => $name)
        );
    }
    
    public function findByCategory($category) {
        return $this->findAll(
        	'category = :category',
        	array('category' => $category)
        );
    }
    
    public function findCategoriesForSelect() {
        $categories = $this->findAll(
            array('select' => 'distinct category', 'order' => 'category')
        );
        return $this->resultForSelect(
            $categories, 'category', 'category', false
        );
    }
        
    public function findAllAdmin($category) {
        $criteria = new CDbCriteria();
        $criteria->order = 'category, name';
        if (!empty($category)) {
            $criteria->condition = 'category = :category';
            $criteria->params    = array('category' => $category);
        }
        return $this->findAll($criteria);
    }
    
}
