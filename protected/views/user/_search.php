<div class="wide form">

<?php $form=$this->beginWidget('BActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="clearfix">
		<?php echo $form->label($model,'id'); ?>
		<div class="input">
			<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'name'); ?>
		<div class="input">
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'email'); ?>
		<div class="input">
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'pwd'); ?>
		<div class="input">
			<?php echo $form->textField($model,'pwd',array('size'=>60,'maxlength'=>255)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'user_status_id'); ?>
		<div class="input">
			<?php echo $form->textField($model,'user_status_id'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'user_group_id'); ?>
		<div class="input">
			<?php echo $form->textField($model,'user_group_id'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'create_at'); ?>
		<div class="input">
			<?php echo $form->textField($model,'create_at'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'create_by'); ?>
		<div class="input">
			<?php echo $form->textField($model,'create_by',array('size'=>11,'maxlength'=>11)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'update_at'); ?>
		<div class="input">
			<?php echo $form->textField($model,'update_at'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'update_by'); ?>
		<div class="input">
			<?php echo $form->textField($model,'update_by',array('size'=>11,'maxlength'=>11)); ?>
		</div>
	</div>

	<div class="actions">
		<?php echo BHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->