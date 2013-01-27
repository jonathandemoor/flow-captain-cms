<?php

class Page extends ApplicationModel {
        
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'tbl_pages';
    }
    
    public function rules() {
        return array(
            array(
                'name',
                'required'
            ),
        );
    }
    
    public function attributeLabels() {
        return array(
            'name' => 'Name',
        );
    }
    
    public function findByID($id) {
        return $this->find(
            'id = :id',
            array('id' => $id)
        );
    }
    
    public function findAllForFilter() {
	    $pages = $this->findAll();
	    
	    $result = array();
	    
	    // Loop over pages
	    foreach($pages as $page) {
		    $item = array();
		    $item['label'] = $page->name;
		    $item['url'] = array('contentBlock/admin/filter/' . $page->id);
		    
		    $result[] = $item;
	    }
	    
	    // Add separator
	    $result[] = '---';
		
		// Add Reset btn    
		$item = array();
	    $item['label'] = 'All Pages';
	    $item['url'] = array('contentBlock/admin');
	    $item['active'] = false;
	    
	    $result[] = $item;
	    
	    return $result;
    } 
    
    public function findAllForSelect() {
    	$pages = $this->findAll();
	    
	    $result = array();
	    
	    $result[''] = '-- Select Page --';
	    
	    // Loop over pages
	    foreach($pages as $page) {			    
		    $result[$page->id] = $page->name;
	    }
	    
	    return $result;
    }   
}
