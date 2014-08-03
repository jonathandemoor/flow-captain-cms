<?php

class Contact extends ApplicationModel 
{    
    public static function model($className=__CLASS__) 
    {
        return parent::model($className);
    }
    
    public function tableName() 
    {
        return 'tbl_contacts';
    }
    
    public function rules() 
    {
        return array(
            array('email', 'email','message' => 'E-mail adres is niet geldig'),
            array('name', 'required', 'message' => 'Vul uw naam in'),
            array('email', 'required', 'message' => 'Vul uw E-mail adres in'),
            array('message', 'required', 'message' => 'Laat een boodschap achter'),
            array('company', 'safe')
        );
    }
    
    public function attributeLabels() 
    {
        return array(
            'name'       => 'Name',
            'email'      => 'Email Address',
            'message'    => 'Message',
            'company'	 => 'Company',
            'created_on' => 'When',
        );
    }
    
    public function findAllAdmin() 
    {
        return parent::findAll(array('order' => 'created_on desc'));
    }
}
