<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser {

	const PAGE_SIZE = 2;
	public function rules() {
		return array(
			array('email', 'required'),
		)+parent::rules();
	}
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function search() {
		
		$pagination = new CPagination;
		$pagination->pageSize = self::PAGE_SIZE;
		
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('pwd', $this->pwd, true);
		$criteria->compare('user_status_id', $this->user_status_id);
		$criteria->compare('user_group_id', $this->user_group_id);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('create_by', $this->create_by);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('update_by', $this->update_by);
	
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => $pagination,

		));
	}

}