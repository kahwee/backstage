<?php

class DefaultController extends BackstageController {

	public function actionIndex() {
		if (count($this->backstage_models)) {
			$this->redirect(array('model/index', 'name' => $this->backstage_models[0]));
		} else {
			
		}
		Yii::app()->user->setFlash('success', "Data saved!");
		$this->render('index');
	}

}
