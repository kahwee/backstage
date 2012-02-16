<div class="span2">
	<div class="sidebar-nav">
		<?php
		$this->renderPartial('_model_list', compact(array(
			'model',
		)));
		?>
	</div><!-- sidebar-nav -->
</div>
<div class="span10">
	<h2 class='pull-left' style='min-width:180px'>Search <?php echo $name; ?></h2>
	<?php echo CHtml::link('Add New '. $name, array('model/create', 'name' => $name), array('class' => 'btn btn-small btn-primary pull-left','style'=>'margin: 4px 30px;')); ?>
	<div class='clear'></div>

	<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
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
			$columns[] = array(
				'name' => $column_k,
			);
		} else {
			$belongsToRelationKeys = array_keys($belongsToRelation[0]);
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

<?php

Yii::app()->clientScript->registerScript('search', <<<JAVASCRIPT
$('.search-button').click(function() {
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function() {
	console.log($(this).serialize());
	$.fn.yiiGridView.update('gridview', {
		data: $(this).serialize()
	});
	return false;
});
JAVASCRIPT
);
?>