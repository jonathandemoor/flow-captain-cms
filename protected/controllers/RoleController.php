<?php

class RoleController extends ApplicationController {

	public $adminActions  = array('index', 'view', 'add', 'update', 'delete');

    public function actionIndex() {

        $items = new CActiveDataProvider(
            'Role', array(
                'pagination' => array(
                    'pageSize' => 15,
                ),
            )
        );

        $this->render('index', array('items' => $items));
    }

    public function actionAdd() {

        $item = new Role();
        $item->scenario = 'create';

        if (isset($_POST['Role'])) {
        
            $item->attributes = $_POST['Role'];
            
            if ($item->save()) {
                $this->redirect(array('role/index'));
            }
        }

        $this->render('add', array('item' => $item));

    }

    public function actionUpdate() {

        $item = $this->loadModel();
        $item->scenario = 'update';

        if (isset($_POST['Role'])) {
        
            $item->attributes = $_POST['Role'];
            
            if ($item->save()) {
                $this->redirect(array('role/index'));
            }
        }

        $this->render('update', array('item' => $item));

    }

    public function actionDelete() {
    
        $item = $this->loadModel();
        
        $item->delete();
    }

    protected function loadModel() {
        if (!isset($_GET['id'])) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $item = Role::model()->findByPk($_GET['id']);
        if (!$item) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $item;
    }

}
