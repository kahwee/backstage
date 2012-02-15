<div class="wide form">

	<?php
	$form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));

	$backstage_model_columns = Yii::app()->controller->module->models[get_class($model)];
	foreach ($backstage_model_columns as $k => $v) {
		if (!empty($v['visible']) && in_array('search', $v['visible'])) {
			echo '<div class="row">';
			echo $form->label($model, $k);
			echo $form->textField($model, $k);
			echo '</div>';
		}
	}
	?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->