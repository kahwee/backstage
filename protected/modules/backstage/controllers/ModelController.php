<?php

class ModelController extends Controller
{
	public function actionIndex($name=null)
	{
		print_r($name);
		echo "s";
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
