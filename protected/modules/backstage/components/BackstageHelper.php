<?php

class BackstageHelper {

	/**
	 * Discovers what is in 'application.models' path.
	 *
	 * @return array Names of all models in 'application.models'
	 */
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

	/**
	 * Checks if the string ends with
	 *
	 * @author KahWee Teng <t@kw.sg>
	 * @param string $haystack The string to search in.
	 * @param mixed $needle partial string to end with. If it is an array, it will test all.
	 * @return boolean True if ends with at least one correct entry.
	 */
	public static function endsWith($haystack, $needle) {
		$success = false;
		$haystack_length = strlen($haystack);
		if (is_string($needle)) {
			$needle_length = strlen($needle);
			if ($needle_length > $haystack_length)
				return false;
			return substr_compare($haystack, $needle, -$needle_length) === 0;
		} elseif (is_array($needle)) {
			foreach ($needle as $needle_single) {
				$needle_length = strlen($needle_single);
				if ($needle_length <= $haystack_length && substr_compare($haystack, $needle_single, -$needle_length) === 0)
					return true;
			}
		}
		return $success;
	}

}

?>
