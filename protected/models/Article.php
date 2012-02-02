<?php

Yii::import('application.models._base.BaseArticle');

class Article extends BaseArticle
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}