<?php

class SiteController extends ApplicationController
{
	public function actions() {
	
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex() {
		$this->render('index');	
	}

	public function actionError() {
	
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin() {
	
		// User already logged in, redirect to the base url
		if (Yii::app()->user->isGuest === false) {
			$this->redirect(Yii::app()->baseUrl);
		}

		// Perform the login
		$model = new LoginForm();
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			
			if ($model->validate() && $model->login()) {
				$this->redirect(array('admin/home'));
			}
		}

		$this->render(
			'login',
			array(
				'model' => $model
			)
		);
	}

	public function actionLogout() {
	
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}