<?php
$model_name = get_class($model);
?>
<ul class="nav nav-list">
	<li class="nav-header">Models</li>
	<?php
	foreach ($models_key as $t_model) {
		$is_active = $model_name == $t_model && $this->id == 'model';
		echo CHtml::tag('li', array('class' => ($is_active ? 'active' : '' )), CHtml::link($t_model, array('model/index', 'name' => $t_model)));
	}
	?>
</ul>