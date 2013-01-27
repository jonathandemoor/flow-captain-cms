<?php

class User extends ApplicationModel {
	
	public $password_new;
	public $password_repeat;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'tbl_users';
    }
    
    public function rules() {
        return array(
            array(
                'password',
                'length', 'max' => 35, 'min' => 3,
                'on' => 'create'
            ),
            array(
                'password_new',
                'length', 'max' => 35, 'min' => 3,
                'on' => 'update'
            ),
            array(
                'password, password_repeat',
                'required',
                'on' => 'create'
            ),
            array(
            	'password', 
            	'compare', 'compareAttribute'=>'password_repeat',
            	'on' => 'create'
            ),
           array(
            	'password_new', 
            	'compare', 'compareAttribute'=>'password_repeat',
            	'on' => 'update'
            ),
            array(
                'email',
                'unique', 'caseSensitive' => false,
                'on' => 'create',
            ),
            array(
            	'email', 
            	'email'
            ),
            array(
                'fullname, email',
                'required',
            ),
            array('is_active', 'in', 'range'=>range(0, 1)),
        );
    }
    
    public function attributeLabels() {
        return array(
            'fullname'  		=> 'Full Name',
            'password'  		=> 'Password',
            'password_repeat'  	=> 'Repeat Password',
            'password_new'  	=> 'Password',
            'email'     		=> 'Email',
            'is_active' 		=> 'Enabled',
        );
    }
    
    // Before we save a user
    protected function beforeSave() {    

    	$password_save = '';
    		
        if ($this->isNewRecord) {
            $password_save  = $this->password;
            $this->password = sha1($password_save);
        } else {
            if (!empty($this->password_new)) {
                $password_save  = $this->password_new;
                $this->password = sha1($password_save);
            }
        }
       
        return true;
    }

    public function findActiveByEmail($email) {
        return $this->findByAttributes(
            array(
                'email'     => $email,
                'is_active' => 1
            )
        );
    }
    
    public function findByID($id) {
        return $this->find(
            'id = :id',
            array('id' => $id)
        );
    }
    
}
