<?php

class SiteController extends ApplicationController
{
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

		if (Yii::app()->user->isGuest === false) {
			$this->redirect('admin/admin/home');
		}

		$model = new LoginForm();
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			
			if ($model->validate() && $model->login()) {
				$this->redirect(array('admin/admin/home'));
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