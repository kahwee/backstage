<?php
Yii::import('backstage.extensions.bootstrap.widgets.BootActiveForm');
$form = $this->beginWidget('BootActiveForm', array(
	'id'=>'example-form',
	'enableAjaxValidation' => false,
));

foreach ($model->metaData->columns as $k => $v) {
	if (!isset($v->autoIncrement) || $v->autoIncrement === false) {
		echo $form->textFieldRow($model, $k);
	}
}
?>
<div class="actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-large btn-primary')); ?>
	<?php echo CHtml::link('Back to list', array('index')); ?>
</div>
<?php $this->endWidget(); ?>
