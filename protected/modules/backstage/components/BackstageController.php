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
	public $models_key = array();

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
		#Legacy, to be removed in future:
		$this->models_key = array_keys(Yii::app()->controller->module->models);
	}
}
