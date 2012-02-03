<?php

class DefaultController extends Controller
{
	public $layout = 'default';
	public function actionIndex()
	{
		Yii::app()->user->setFlash('success',"Data saved!");
		$this->render('index');
	}
}