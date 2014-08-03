<?php

class Role extends ApplicationModel 
{
    public static function model($className=__CLASS__) 
    {
        return parent::model($className);
    }

    public function tableName() 
    {
        return 'tbl_roles';
    }

    public function rules() 
    {
        return array(
        	array(
                'name',
                'required'
            ),
        );
    }

    public function attributeLabels() 
    {
        return array(
        	'id'   => '#',
        	'name' => 'Name',
        );
    }

    public function relations() 
    {
        return array(
            'users' => array(self::HAS_MANY, 'User', 'role_id'),
        );
    }

    public function findAllForSelect() 
    {
	    $roles = $this->findAll();
	    
	    $result = array();
	    
	    $result[''] = '-- Select Role --';
	    
	    // Loop over pages

	    foreach ($roles as $role) 
        {
		    $result[$role->id] = $role->name;
	    }
	    	    	    
	    return $result;
    }
}
