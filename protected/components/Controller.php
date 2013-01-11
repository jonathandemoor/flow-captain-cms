<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $layout='main';
	
	public $adminActions  = array();
	
	public function render($template, $variables=array()) {
		
		if (in_array($this->action->id, $this->adminActions) || $this->action->id == 'login') {
            $this->layout = 'admin';
        } else if($this->action->id == 'index') {
			$this->layout = 'home';
		} 
		else {
			$this->layout = 'home';
		}
		
		return parent::render($template, $variables); 
	}
	
}