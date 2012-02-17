<div class="wide form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
		));
	$backstage_model_columns = Yii::app()->controller->module->models[get_class($model)];
	foreach ($backstage_model_columns as $name => $meta) {
		if (!empty($meta['visible']) && in_array('search', $meta['visible'])) {
			?>

			<div class="input-prepend pull-left" style='width:300px;'>
				<span class="add-on" style='width:70px; font-size:8pt; text-align: right;'> 
					<?php echo $model->getAttributeLabel($meta['name']); ?> 
				</span>
				<?php echo $form->textField($model, $name, array('style' => 'width:184px')); ?>
			</div><!-- inputPrepend -->

			<?php
		}
	}
	?>
	<div class='clear'></div>
	<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary')); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->