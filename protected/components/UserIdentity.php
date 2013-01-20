<?php

class UserIdentity extends CUserIdentity
{
	private $id;
    
    public function authenticate() {
        $record = User::model()->findActiveByEmail($this->name);
        
        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($record->password !== sha1($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->id    	    = $record->id;
            $this->username			= $record->email;
            $this->errorCode	= self::ERROR_NONE;
        }
        
        return !$this->errorCode;        
    }
    
    public function getId(){
        return $this->id;
    }
}