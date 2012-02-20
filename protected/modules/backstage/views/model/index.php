<?php
$model_name = get_class($model);
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

	<h2 class='pull-left' style='min-width:180px'><?php echo $name; ?></h2>
	<div class="btn-group" style="margin: 4px 30px;">
		<?php echo CHtml::link('Index'	, array('/backstage/model/index', 'name' => $name), array('class' => 'btn active','id'=>'btn-index')); ?>
		<?php echo CHtml::link('Search'	, array('#'), array('class' => 'btn','id'=>'btn-search')); ?>
		<?php echo CHtml::link('Create'	, array('/backstage/model/create', 'name' => $name), array('class' => 'btn')); ?>
		<?php echo CHtml::link('Update'	, array('#'), array('class' => 'btn disabled')); ?>
		<?php echo CHtml::link('Delete'	, array('#'), array('class' => 'btn disabled')); ?>
		<?php echo CHtml::link('View'	, array('#'), array('class' => 'btn disabled')); ?>
	</div><!-- btn-group -->
	<div class='clear'></div>

	<div class="search-form" style="display:none">
		<?php
		$this->renderPartial('_search', compact(array(
			'model',
		)));
		?>
	</div><!-- search-form -->

	<?php
	Yii::import('backstage.extensions.bootstrap.widgets.BootGridView');
	Yii::import('backstage.extensions.bootstrap.widgets.BootButtonColumn');
	$columns = array();
	foreach ($model->metaData->columns as $column_k => $column_v) {
		$belongsToRelation = BackstageHelper::getModelBelongsTo($model, $column_k);
		if (empty($belongsToRelation)) {
			if($this_models[$column_k]['control']=='datetime'){
				$columns[] = array(
					'name' => $column_k,
					'value'=>'(!empty($data->'.$column_k.'))?date("M j, Y", strtotime($data->'.$column_k.')):"-"',
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
				'value' => 'BackstageHelper::getRelatedAttribute($data, "' . $column_k . '")',
			);
		}
	}
	$columns[] = array(
		'class' => 'BootButtonColumn',
		'viewButtonUrl' => 'Yii::app()->controller->createUrl("model/view", array("name" => "' . $name . '", "id" => $data->id))',
		'updateButtonUrl' => 'Yii::app()->controller->createUrl("model/update", array("name" => "' . $name . '", "id" => $data->id))',
		'deleteButtonUrl' => 'Yii::app()->controller->createUrl("model/delete", array("name" => "' . $name . '", "id" => $data->id))',
	);
	$this->widget('BootGridView', array(
		'id' => 'gridview',
		'htmlOptions' => array('class' => 'table-striped'),
		'dataProvider' => $model->search(),
		'template' => '<!--{summary}-->{items} {pager}',
		'columns' => $columns,
	));
	?>
</div>

