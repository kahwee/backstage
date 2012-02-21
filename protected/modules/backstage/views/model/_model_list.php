<?php
$model_name = isset($model) ? get_class($model) : '';
?>
<ul class="nav nav-list">
	<li class="nav-header">Models</li>
	<?php
	foreach (array_keys(Yii::app()->controller->module->models) as $t_model) {
		$is_active = $model_name == $t_model && $this->id == 'model';
		echo CHtml::tag('li', array('class' => ($is_active ? 'active' : '' )), CHtml::link($t_model, array('model/index', 'name' => $t_model)));
	}
	?>
</ul>
