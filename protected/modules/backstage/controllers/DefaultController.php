<?php

class DefaultController extends BackstageController {

	public function actionIndex() {
		if (count($this->models_key)) {
			$this->redirect(array('model/index', 'name' => $this->models_key[0]));
		} else {
			
		}
		Yii::app()->user->setFlash('success', "Data saved!");
		$this->render('index');
	}

}
