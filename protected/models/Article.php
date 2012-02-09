<?php

Yii::import('application.models._base.BaseArticle');

class Article extends BaseArticle {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function attributeLabels() {
		return array(
			'create_by' => 'Created By',
			'update_by' => 'Updated by',
		) + parent::attributeLabels();
	}

}
