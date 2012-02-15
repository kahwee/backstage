<?php
	$model_name = (isset($_GET['name'])) ? $_GET['name'] : '';
?>
<div class="span2">
	<div class="sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Models</li>
			<?php foreach ($models_key as $t_model) {
				$is_active = $model_name == $t_model && $this->id == 'model';
				echo CHtml::tag('li', array('class' => ($is_active ? 'active' : '' )), CHtml::link($t_model, array('model/index', 'name' => $t_model)));
			} ?>
		</ul>
	</div><!-- sidebar-nav -->
</div>
<div class="span10">
	<h2 class='pull-left' style='min-width:180px'>Search <?php echo $name; ?></h2>
	<?php echo CHtml::link('Add New '. $name, array('model/create', 'name' => $name), array('class' => 'btn btn-small btn-primary pull-left','style'=>'margin: 4px 30px;')); ?>
	<div class='clear'></div>

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
		'id' => 'alert',
		'htmlOptions' => array('class' => 'table-striped'),
		'dataProvider' => $model->search(),
		'template' => '<!--{summary}-->{items} {pager}',
		'columns' => $columns,
	));
	?>
</div>

