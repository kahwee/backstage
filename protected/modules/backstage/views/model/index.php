<h2><?php echo get_class($model); ?></h2>
<?php echo CHtml::link('Add', array('model/create', 'name' => get_class($model)), array('class' => 'btn btn-small')); ?>

<?php
Yii::import('backstage.extensions.bootstrap.widgets.BootGridView');
Yii::import('backstage.extensions.bootstrap.widgets.BootButtonColumn');
$columns = array_keys($model->metaData->columns);
$columns[] = array(
	'class' => 'BootButtonColumn',
);
$this->widget('BootGridView', array(
	'id' => 'alert',
	'htmlOptions' => array('class' => 'table-striped'),
	'dataProvider' => $model->search(),
	'template' => '<!--{summary}-->{items} {pager}',
	'columns' => $columns,
));
?>
