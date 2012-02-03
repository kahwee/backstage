<?php

class DefaultController extends BackstageController
{
	public function actionIndex()
	{
		Yii::app()->user->setFlash('success',"Data saved!");
		$this->render('index');
	}

	public function actionD() {
		$model_names = $this->k_return_models();
		print_r($model_names);
	}

}
