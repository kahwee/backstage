<?php
$model_name = get_class($model);
$this_models = $this->module->models[$model_name];
$model_id = isset($_GET['id']) ? $_GET['id'] : '';
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
<div class="span10" id='con-main'>
	<div id="con-alert">
		<?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
			<div class='alert alert-<?php echo $key?>' style='margin:0 0 10px 0;'>
			<a class='close'>×</a>
			<h4 class='alert-heading'><?php echo $key ?></h4>
			<?php echo $message ?>
			</div>
		<?php } ?>
	</div><!-- con-alert -->

	<h2 class='pull-left' style='min-width:180px'><?php echo $name; ?> #<?php echo $model_id ?></h2>
	<div class="btn-group" style="margin: 4px 30px;">
		<?php echo CHtml::link('Index'	, array('/backstage/model/index', 'name' => $model_name), array('class' => 'btn')); ?>
		<?php echo CHtml::link('Search'	, array('/backstage/model/index'), array('class' => 'btn disabled')); ?>
		<?php echo CHtml::link('Create'	, array('/backstage/model/create', 'name' => $model_name), array('class' => 'btn')); ?>
		<?php echo CHtml::link('Update'	, array('/backstage/model/update', 'name' => $model_name, 'id' => $model_id ), array('class' => 'btn')); ?>
		<?php echo CHtml::link('Delete'	, array('/backstage/model/delete', 'name' => $model_name, 'id' => $model_id ), array('class' => 'btn ')); ?>
		<?php echo CHtml::link('View'	, array('#'), array('class' => 'btn active')); ?>
	</div><!-- btn-group -->
	<div class='clear' style='height:20px;'></div>

	<?php
	$columns = array();
	foreach ($model->metaData->columns as $column_k => $column_v) {
		$belongsToRelation = BackstageHelper::findAllModelBelongsTo($model, $column_k);
		if (empty($belongsToRelation)) {
			if($this_models[$column_k]['control']=='datetime'){
				$columns[] = array(
					'name' => $column_k,
					'type' => 'raw',
					'value'=>(!empty($model->$column_k))?date("M j, Y", strtotime($model->$column_k)):"-",
				);
			} else if($this_models[$column_k]['control']=='richtext') {
				$columns[] = $column_k.':html';
			} else {
				$columns[] = array(
					'name' => $column_k,
				);
			}
		} else {
			$columns[] = array(
				'name' => $column_k,
				'type' => 'raw',
				'value' => BackstageHelper::getRelatedAttribute($model,$column_k),
			);
		}
	}
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'baseScriptUrl' => false,
		'cssFile' => false,
		'htmlOptions' => array('class' => 'table table-bordered'),
		'attributes' => $columns,
	));
	?>

</div>
