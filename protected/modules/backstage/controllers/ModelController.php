<?php

class ModelController extends BackstageController {

	/**
	 * This method is invoked at the beginning of {@link render()}.
	 * You may override this method to do some preprocessing when rendering a view.
	 * @param string $view the view to be rendered
	 * @return boolean whether the view should be rendered.
	 * @since 1.1.5
	 */
	protected function beforeRender($view) {
		$model_name = Yii::app()->request->getParam('name');
		$model_id = Yii::app()->request->getParam('id');
		$this->navBarItems = array(
			array(
				'label' => '<i class="icon-th-list icon-white"></i> List',
				'url' => array('model/index', 'name' => $model_name),
				'active' => $view == 'index',
			),
			array(
				'label' => '<i class="icon-plus icon-white"></i> New',
				'url' => array('model/create', 'name' => $model_name),
				'active' => $view == 'create',
				'visible' => in_array($view, array('create', 'index')),
			),
			array(
				'label' => '<i class="icon-search icon-white"></i> Search',
				'url' => '#',
				'linkOptions' => array('onclick' => 'js:return false;', 'id' => 'btn-search'),
				'active' => $view == 'create',
				'visible' => $view == 'index',
			),
			array(
				'label' => '<i class="icon-eye-open icon-white"></i> View',
				'url' => array('model/view', 'name' => $model_name, 'id' => $model_id),
				'active' => $view == 'view',
				'visible' => in_array($view, array('update', 'view', 'delete')),
			),
			array(
				'label' => '<i class="icon-edit icon-white"></i> Update',
				'url' => array('model/update', 'name' => $model_name, 'id' => $model_id),
				'active' => $view == 'update',
				'visible' => in_array($view, array('update', 'view', 'delete')),
			),
			array(
				'label' => '<i class="icon-trash icon-white"></i> Delete',
				'url' => array('model/delete', 'name' => $model_name, 'id' => $model_id),
				'active' => $view == 'delete',
				'visible' => in_array($view, array('update', 'view', 'delete')),
				'confirm' => 'a',
				'linkOptions' => array('confirm' => 'Can I delete this?', 'submit' => array('model/delete', 'name' => $model_name, 'id' => $model_id)),
			),
		);
		return true;
	}

	/**
	 * Initializes the controller.
	 * This method is called by the application before the controller starts to execute.
	 * You may override this method to perform the needed initialization for the controller.
	 */
	public function init() {
	}

	public function buildNavMenu() {

	}

	public function actionIndex($name=null) {
		$model = new $name('search');
		$model->unsetAttributes();
		if(isset($_GET[$name])) $model->attributes = $_GET[$name];
		$this->render('index', compact(array(
				'model',
				'name',
			)));
	}

	public function actionCreate($name) {
		$model = new $name('create');
		if (isset($_POST[$name])) {
			$model->attributes = $_POST[$name];
			if ($model->save()) {
				Yii::app()->user->setFlash('success',"Data saved successfully");
				$this->redirect(array('model/index', 'name' => $name));
			}
		}
		$this->render('create', compact(array(
				'model',
				'name',
			)));
	}

	public function actionView($name, $id) {
		$model = $this->loadModel($name, $id);
		$this->render('view', compact(array(
				'model',
				'name',
			)));
	}

	public function actionUpdate($name, $id) {
		$model = $this->loadModel($name, $id);
		if (isset($_POST[$name])) {
			$model->attributes = $_POST[$name];
			if ($model->save()) {
				Yii::app()->user->setFlash('success',"Data updated successfully");
				$this->redirect(array('model/index', 'name' => $name));
			}
		}
		$this->render('update', compact(array(
				'model',
				'name',
			)));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel($name, $id) {
		$model = $name::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete($name, $id) {
		if (Yii::app()->request->isPostRequest) {
			$model = $this->loadModel($name, $id);
			$model->delete();
			if (!isset($_POST['ajax'])) {

				Yii::app()->user->setFlash('success',"Data delete");
				$this->redirect(array('index'));
			}
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
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
