<?php

class ModelController extends BackstageController {

	public function actionIndex($name=null) {
		#var_dump(Yii::app()->controller->module->models);
		$model = new $name('search');
		$models_key = $this->models_key;
		$this->render('index', compact(array(
				'model',
				'name',
				'models_key',
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
		$models_key = $this->models_key;
		$this->render('create', compact(array(
				'model',
				'name',
				'models_key',
			)));
	}

	public function actionView($name, $id) {
		$model = $this->loadModel($name, $id);
		$models_key = $this->models_key;
		$this->render('view', compact(array(
				'model',
				'name',
				'models_key',
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
		$models_key = $this->models_key;
		$this->render('update', compact(array(
				'model',
				'name',
				'models_key',
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
