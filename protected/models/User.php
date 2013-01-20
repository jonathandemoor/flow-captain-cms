<?php

class User extends ApplicationModel {
    
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
                'username, password, email',
                'required',
            ),
            array('is_active', 'in', 'range'=>range(0, 1)),
        );
    }
    
    public function attributeLabels() {
        return array(
            'fulname'  	=> 'Full Name',
            'password'  => 'Password',
            'email'     => 'Email',
            'is_active' => 'Enabled',
        );
    }

    public function findActiveByEmail($email) {
        return $this->findByAttributes(
            array(
                'email'     => $email,
                'is_active' => 1
            )
        );
    }
    
}
