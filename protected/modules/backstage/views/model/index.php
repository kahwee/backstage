<h2><?php echo $name; ?></h2>
<?php echo CHtml::link('Add', array('model/create', 'name' => $name), array('class' => 'btn btn-small')); ?>

<?php
Yii::import('backstage.extensions.bootstrap.widgets.BootGridView');
Yii::import('backstage.extensions.bootstrap.widgets.BootButtonColumn');
$columns = array_keys($model->metaData->columns);
$columns[] = array(
	'class' => 'BootButtonColumn',
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
