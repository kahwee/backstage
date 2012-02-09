<?php
	$model_name = (isset($_GET['name'])) ? $_GET['name'] : '';
	$model_id = isset($_GET['id'])?$_GET['id']:'';
?>
<div class="span2">
	<div class="sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Models</li>
			<?php foreach ($backstage_models as $t_model) {
				$is_active = $model_name == $t_model && $this->id == 'model';
				echo CHtml::tag('li', array('class' => ($is_active ? 'active' : '' )), CHtml::link($t_model, array('model/index', 'name' => $t_model)));
			} ?>
		</ul>
	</div><!-- sidebar-nav -->
</div>
<div class="span10">
	<h2 class='pull-left' style='min-width:180px'>View <?php echo $name; ?> #<?php echo $model_id ?></h2>
	<?php echo CHtml::link('Update '.$name, array('model/update', 'name' => $name,'id'=>$model_id), array('class' => 'btn btn-small btn-primary pull-left','style'=>'margin: 4px 5px 0px 30px;')); ?>
	<?php echo CHtml::link('Back to '.$model_name.' List', array('/backstage/model/index','name'=>$model_name), array('class' => 'btn btn-small pull-left','style'=>'margin: 4px 5px 0 0px;')); ?>
	<div class='clear' style='height:20px;'></div>
	
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'baseScriptUrl'=>false,
		'cssFile'=>false,
		'htmlOptions'=>array('class'=>'table table-bordered'),
	)); ?>
	
</div>
