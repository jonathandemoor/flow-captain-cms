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
                'username',
                'unique', 'caseSensitive' => false,
                'on' => 'create',
            ),
            array('email', 'email'),
            array(
                'username, password, email',
                'required',
            ),
            array('is_active', 'in', 'range'=>range(0, 1)),
        );
    }
    
    public function attributeLabels() {
        return array(
            'username'  => 'User Name',
            'password'  => 'Password',
            'email'     => 'Email',
            'is_active' => 'Enabled',
        );
    }
    
    public function findActiveUserByName($name) {
    
        return $this->findByAttributes(
            array('username' => $name, 'is_active' => 1)
        );
    }
    
}
