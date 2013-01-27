<?php

class AdminController extends ApplicationController {
    
    public $adminActions  = array('home');
    public $pageTitle     = 'Home';
    
    public function actionHome() {		
		$this->render('home');
    }    
}