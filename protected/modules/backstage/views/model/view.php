<?php
$model_name = (isset($_GET['name'])) ? $_GET['name'] : '';
$model_id = isset($_GET['id']) ? $_GET['id'] : '';
?>
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
	<h2 class='pull-left' style='min-width:180px'><?php echo $name; ?> #<?php echo $model_id ?></h2>
	<div class="btn-group" style="margin: 4px 30px;">
		<?php echo CHtml::link('Index'	, array('/backstage/model/index', 'name' => $model_name), array('class' => 'btn','id'=>'btn-index')); ?>
		<?php echo CHtml::link('Search'	, array('/backstage/model/index'), array('class' => 'btn disabled','id'=>'btn-search')); ?>
		<?php echo CHtml::link('Create'	, array('/backstage/model/create', 'name' => $model_name), array('class' => 'btn')); ?>
		<?php echo CHtml::link('Update'	, array('/backstage/model/update', 'name' => $model_name, 'id' => $model_id ), array('class' => 'btn')); ?>
		<?php echo CHtml::link('Delete'	, array('/backstage/model/delete', 'name' => $model_name, 'id' => $model_id ), array('class' => 'btn ')); ?>
		<?php echo CHtml::link('View'	, array('#'), array('class' => 'btn active')); ?>
	</div><!-- btn-group -->
	<div class='clear' style='height:20px;'></div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'baseScriptUrl' => false,
		'cssFile' => false,
		'htmlOptions' => array('class' => 'table table-bordered'),
	));
	?>

</div>

<?php Yii::app()->clientScript->registerScript('search', <<<JAVASCRIPT
$(function(){
	$('.btn.disabled,.btn.active').click(function(e){
		return false;
	});
});
JAVASCRIPT
); ?>