<?php

class DefaultController extends BackstageController {

	public function actionIndex() {
		$models = array_keys(Yii::app()->controller->module->models);
		if (count($models)) {
			$this->redirect(array('model/index', 'name' => $models[0]));
		}
		Yii::app()->user->setFlash('success', "Data saved!");
		$this->render('index');
	}
	public function actionFaq() {
		$this->render('faq');
	}

}
