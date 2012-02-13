<?php

/**
 * BackstageController is the customized base controller class for Backstage.
 * All BackstageController classes for this module should extend from this base class.
 */
class BackstageController extends Controller {

	public $layout = 'backstage';

	/**
	 * @var array Names of all models
	 */
	public $backstage_models = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	/**
	 * Initializes the controller.
	 * This method is called by the application before the controller starts to execute.
	 * You may override this method to perform the needed initialization for the controller.
	 */
	public function init() {
		#Init models.
		$this->buildModelsOptions();
		$this->buildModelsColumnsOptions();
		#Legacy, to be removed in future:
		$this->backstage_models = array_keys(Yii::app()->controller->module->models);
	}

	/**
	 * Finds all the models in the directory and merge them with the ones
	 * found in options.
	 */
	private function buildModelsOptions() {
		$load_models = array();
		if (Yii::app()->controller->module->autoloadModels) {
			$load_models = BackstageHelper::getModels();
			Yii::app()->controller->module->models = CMap::mergeArray(Yii::app()->controller->module->models, $load_models);
		}
	}

	/**
	 * Find all the columns for the respective models and merge them into options.
	 * Additionally this also assigns default controls if not present.
	 */
	private function buildModelsColumnsOptions() {
		foreach (Yii::app()->controller->module->models as $model_k => &$model_v) {
			if ($model_v !== false) {
				$loaded_columns = $model_k::model()->metaData->columns;
				#Converted to array as it is more consistent with options.
				$model_v = CMap::mergeArray(array_map('get_object_vars', $loaded_columns), $model_v);
				foreach ($model_v as $column_k => &$column_v) {
					$column_v['control'] = $this->assignControl($column_v);
					$column_v['visible'] = $this->assignVisible($column_v);
				}
			}
		}
	}

	/**
	 * With the column data, discover the most suited HTML control to use.
	 *
	 * @param array $column_data Array converted from any one of metaData->columns
	 * @return string The type of control suitable.
	 */
	private function assignControl($column_data) {
		if (isset($column_data['control'])) return $column_data['control'];
		if (BackstageHelper::endsWith($column_data['dbType'], array('_rich'))) {
			return 'richtext';
		}
		if (strcasecmp($column_data['name'], 'email') === 0) {
			return 'email';
		}
		if (strcasecmp($column_data['dbType'], 'text') === 0) {
			return 'textarea';
		}
		if (strcasecmp($column_data['dbType'], 'datetime') === 0) {
			return 'datetime';
		}
		if (strcasecmp($column_data['dbType'], 'date') === 0) {
			return 'date';
		}
		return 'textfield';
	}

	/**
	 * With the column data, discover the most suited visibility to use.
	 *
	 * @param array $column_data Array converted from any one of metaData->columns
	 * @return mixed An array of the views where the type of visibility are most
	 * appropriate. A boolean of false if visible is negative for everything.
	 */
	private function assignVisible($column_data) {
		if (isset($column_data['visible'])) {
			if ($column_data['visible'] === false) {
				return false;
			}
			#This means it is an array and it is not an empty one.
			if (is_array($column_data['visible']) && isset($column_data['visible'][0])) {
				return $column_data['visible'];
			}
		} else {
			#What to do when there is no indication. Guess?
			#Since autoincrement, don't show.
			if ($column_data['autoIncrement'] === true) return false;
		}
		return array('index', 'view', 'search', 'create', 'update');
	}
}
