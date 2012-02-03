<?php
class BackstageHelper {

	public static function getModels() {
		$models_path = Yii::getPathOfAlias('application.models');
		$model_names = array();
		$model_files = CFileHelper::findFiles($models_path, array(
			'level' => 0,
			'fileTypes' => array('php'),
		));
		foreach ($model_files as $model_file) {
			$model_name = str_replace(DIRECTORY_SEPARATOR, '', str_replace('.php', '', str_replace($models_path, '', $model_file)));
			if (method_exists($model_name, 'model')) {
				$model_names[] = $model_name;
			}
		}
		return $model_names;
	}
}

?>
