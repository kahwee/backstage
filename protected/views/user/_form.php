<div class="form">

<?php $form=$this->beginWidget('BActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php $this->widget('BAlert',array(

		'content'=>'<p>Fields with <span class="required">*</span> are required.</p>'
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="<?php echo $form->fieldClass($model, 'name'); ?>">
		<?php echo $form->labelEx($model,'name'); ?>
		<div class="input">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'email'); ?>">
		<?php echo $form->labelEx($model,'email'); ?>
		<div class="input">
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'pwd'); ?>">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<div class="input">
			<?php echo $form->textField($model,'pwd',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'pwd'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'user_status_id'); ?>">
		<?php echo $form->labelEx($model,'user_status_id'); ?>
		<div class="input">
			<?php echo $form->textField($model,'user_status_id'); ?>
			<?php echo $form->error($model,'user_status_id'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'user_group_id'); ?>">
		<?php echo $form->labelEx($model,'user_group_id'); ?>
		<div class="input">
			<?php echo $form->textField($model,'user_group_id'); ?>
			<?php echo $form->error($model,'user_group_id'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'create_time'); ?>">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<div class="input">
			<?php echo $form->textField($model,'create_time'); ?>
			<?php echo $form->error($model,'create_time'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'create_by'); ?>">
		<?php echo $form->labelEx($model,'create_by'); ?>
		<div class="input">
			<?php echo $form->textField($model,'create_by',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'create_by'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'create_time'); ?>">
		<?php echo $form->labelEx($model,'update_at'); ?>
		<div class="input">
			<?php echo $form->textField($model,'create_time'); ?>
			<?php echo $form->error($model,'create_time'); ?>
		</div>
	</div>

	<div class="<?php echo $form->fieldClass($model, 'update_by'); ?>">
		<?php echo $form->labelEx($model,'update_by'); ?>
		<div class="input">
			<?php echo $form->textField($model,'update_by',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'update_by'); ?>
		</div>
	</div>

	<div class="actions">
		<?php echo BHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->