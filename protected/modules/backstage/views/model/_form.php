<?php
$model_name = get_class($model);
if ($model->isNewRecord) {
	$action_name = 'Create';
	$model_id = false;
} else {
	$action_name = 'Update';
	$model_id = $model->id;
}
$this_models = $this->module->models[$model_name];
?>
<div class="span2" id='nav-main'>
	<div class="sidebar-nav">
		<?php
		$this->renderPartial('_model_list', compact(array(
				'model',
			)));
		?>
	</div><!-- sidebar-nav -->
</div>
<div class="span7" id='con-main'>
	<div id="con-alert">
		<?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
			<div class='alert alert-<?php echo $key ?>' style='margin:0 0 10px 0;'>
				<a class='close'>×</a>
				<h4 class='alert-heading'><?php echo $key ?></h4>
				<?php echo $message ?>
			</div>
		<?php } ?>
	</div><!-- con-alert -->

	<?php if ($model_id): ?>
		<h2 class='pull-left' style='min-width:180px'><?php echo $model_name ?> #<?php echo $model_id ?></h2>
	<?php else: ?>
		<h2 class='pull-left' style='min-width:180px'><?php echo $model_name ?></h2>

	<?php endif ?>
	<div class='clear' style='height:20px;'></div>
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'model-form',
		'enableClientValidation' => false,
		'errorMessageCssClass' => 'help-inline',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'clientOptions' => array(
			'enctype' => 'multipart/form-data',
			'validateOnSubmit' => true,
		),
		));
	?>

	<?php
	echo $form->errorSummary($model, null, null, array('class' => 'alert-message block-message error fade in'));
	foreach ($this_models as $name => $attr) {

		if (
			$attr['visible'] &&
			!$attr['locked']
		) {
			?>
			<div class="form-row control-group <?php echo (is_null($model->getError($name))) ? '' : 'error' ?>">
				<?php echo $form->labelEx($model, $name); ?>
				<div class="controls" >
					<?php
					if ($attr['control'] == 'richtext') {
						Yii::import('backstage.extensions.krichtexteditor.KRichTextEditor');
						$this->widget('KRichTextEditor', array(
							'model' => $model,
							'value' => $model->isNewRecord ? $model->{$name} : '',
							'attribute' => $name,
							'options' => array(
								'theme_advanced_resizing' => 'true',
								'theme_advanced_statusbar_location' => 'bottom',
							),
						));
					} elseif ($attr['control'] == 'textarea') {
						echo $form->textarea($model, $name);
					} elseif ($attr['control'] == 'datetime') {
						Yii::import('backstage.extensions.kdateselect.KDateSelect');
						$this->widget('KDateSelect', array(
							'model' => $model,
							'value' => $model->isNewRecord ? $model->{$name} : '',
							'startDate' => '-3 years',
							'endDate' => '+4 years',
							'reverseYears' => true,
							'attribute' => $name,
						));
					} elseif ($attr['control'] == 'file') {
						echo $form->fileField($model, $name);
					} elseif ($attr['control'] == 'password') {
						echo $form->passwordField($model, $name);
					} elseif ($attr['control'] == 'relation') {
						$model_belongs_to = BackstageHelper::findModelBelongsTo($model, $attr['name']);
						$model_belongs_to_keys = array_keys($model_belongs_to);
						$model_belongs_to_key = array_shift($model_belongs_to_keys);
						$related_model = $model_belongs_to[$model_belongs_to_key][1]::model();
						$display_attribute = BackstageHelper::getDisplayNameAttribute($related_model);
						$related_list_data = CHtml::listData($related_model::model()->findAll(), BackstageHelper::getPrimaryKey($related_model), $display_attribute);
						echo $form->dropDownList($model, $name, $related_list_data, array('empty' => ''));
					} elseif ($attr['control'] == 'email') {
						?>
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<?php echo $form->textField($model, $name, array('style' => 'width:184px')); ?>
						</div><!-- inputPrepend -->
					<?php } elseif ($attr['control'] == 'url') { ?>
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<?php echo $form->textField($model, $name, array('style' => 'width:184px')); ?>
						</div><!-- inputPrepend -->
						<?php
					} else {
						echo $form->textField($model, $name);
					}
					echo $form->error($model, $name);
					?>
				</div>
			</div><!-- form-row control-group -->
		<?php } ?>
	<?php } ?>

	<div class="actions">
		<?php echo CHtml::submitButton($action_name, array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 0;')); ?>
		<?php echo CHtml::link('Back to ' . $model_name . ' List', array('/backstage/model/index', 'name' => $model_name), array('class' => 'btn')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>

<?php if ($action_name == 'Update'): ?>
	<div class="well span2">
		<?php
		foreach ($this_models as $name => $attr) {
			# Field investigate process
			if (
				$attr['locked']
			) {
				?>
				<div class="sys-field">
					<?php echo $form->labelEx($model, $name); ?>
					<div class="sys-value">
						<?php if (!empty($model->{$name})): ?>
							<?php echo $model->{$name}; ?>
						<?php else: ?>
							-
						<?php endif ?>
					</div><!-- sys-value -->
				</div><!-- sys-field -->
			<?php } ?>
		<?php } ?>
	</div><!-- right -->
<?php endif ?>

<?php
Yii::app()->clientScript->registerCss("modules.backstage.views.model._form.css", <<<CSS
	form .control-group {margin-bottom: 18px;zoom:1;}
	form label {padding-top: 6px;font-size: 13px;line-height: 18px;float: left;width: 130px;text-align: right;color: #404040;}

	/* container */
	form div.actions {background: whiteSmoke;margin:18px 0;padding: 17px 20px 18px 150px; border-top: 1px solid #DDD;-webkit-border-radius: 0 0 3px 3px;-moz-border-radius: 0 0 3px 3px;border-radius: 0 0 3px 3px;}
	form div.controls {margin-left: 150px;}

	form div.help-inline {padding-left: 5px;display:inline;font-size: 11px;}

	form div.control-group.error > label,
	form div.control-group.error .help-inline,
	form div.control-group.error .help-block {color: #9D261D;}
	div.form-row.control-group.error{background-color:#FAE5E3;padding:10px 0;margin: -10px 0 18px;border-radius: 4px;}

	/* input field error */
	form div.control-group.error input, form div.control-group.error textarea {border-color: #C87872;-webkit-box-shadow: 0 0 3px rgba(171, 41, 32, 0.25);-moz-box-shadow: 0 0 3px rgba(171, 41, 32, 0.25);box-shadow: 0 0 3px rgba(171, 41, 32, 0.25);}

	/* error summary */
	form .alert-message.block-message.error {background-color: #FDDFDE;border-color: #FBC7C6; color: #404040; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);position: relative;margin-bottom: 18px;border-width: 1px; border-style: solid;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding: 14px;}

	div.sys-field label{font-weight:bold;}
	div.sys-field div.sys-value{margin-bottom:10px;color:#888;padding-left:4px;}
CSS
);
?>
