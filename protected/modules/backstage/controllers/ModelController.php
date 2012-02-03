<?php

class ModelController extends BackstageController {

	public function actionIndex($name=null) {
		$model = new $name('search');
		$this->render('index', compact(array(
				'model',
			)));
	}

	public function actionCreate($name=null) {
		$model = new $name('create');
		if (isset($_POST[$name])) {
			$model->attributes = $_POST[$name];
			if ($model->save()) {
				$this->redirect(array('model/index', 'name' => $name));
			}
		}
		$this->render('create', compact(array(
				'model',
			)));
	}

	public function actionD() {
		$model_names = $this->k_return_models();
		print_r($model_names);
	}

	public function k_return_models() {
		$models_path = Yii::getPathOfAlias('application.models');
		$model_names = array();
		$model_files = CFileHelper::findFiles($models_path, array(
				'level' => 0,
				'fileTypes' => array('php'),
			));
		foreach ($model_files as $model_file) {
			$model_names[] = str_replace(DIRECTORY_SEPARATOR, '', str_replace('.php', '', str_replace($models_path, '', $model_file)));
		}
		return $model_names;
	}

}
