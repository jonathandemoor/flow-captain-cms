<?php

class ApplicationController extends CController
{
	public $layout			= 'main';
	public $user_main       = null;
	
	// Enable access controler
    
	public function filters() 
    {
		return array('accessControl');
	}
	
	public function beforeAction($action) 
    {
    	// Get the current user details

        try 
        {
            $this->user_main = User::model()->findActiveByEmail(Yii::app()->user->name);
            
        } 
        catch (Exception $e) 
        {
            $this->user_main = false;
        }
                
        return true;
    }
    
    public function accessRules() 
    {
        // Get the user

        try 
        {
            $this->user_main = User::model()->findActiveByEmail(Yii::app()->user->name);
        } 
        catch (Exception $e) 
        {
            $this->user_main = false;
        }
        
        // Authorized users can see everything

        if (Yii::app()->user->isGuest === false && $this->user_main) 
        {
            return array(
                array(
                    'allow',
                    'users' => array('@'),
                ),
            );
        }

        // Return the default properties
        
        return array(
            array(
                'allow',
                'controllers' => array('site'),
                'users'       => array('*'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );

    }
    
    public function render($template, $variables=array()) 
    {	
		if ($this->id == 'files') 
        {
			$this->layout = 'files';
		} 
        elseif ($this->id == 'site' && $this->action->id != 'login') 
        {
            $this->layout = 'main';
        } 
        else 
        {
			$this->layout = 'admin';
		}
		
		return parent::render($template, $variables); 
	}
}