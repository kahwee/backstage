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
			<div class='alert alert-<?php echo $key ?>' style='margin:0 0 10px 0;'>
				<a class='close'>×</a>
				<h4 class='alert-heading'><?php echo $key ?></h4>
				<?php echo $message ?>
			</div>
		<?php } ?>
	</div><!-- con-alert -->

	<h2 class='pull-left' style='min-width:180px'><?php echo $name; ?></h2>
	<div class='clear'></div>

	<div class="search-form" style="display:none">
		<?php
		$this->renderPartial('_search', compact(array(
				'model',
			)));
		?>
	</div><!-- search-form -->

	<?php
	Yii::import('zii.widgets.grid.CGridView');
	Yii::import('backstage.extensions.bootstrap.widgets.BootButtonColumn');
	$columns = array();
	foreach ($this_models as $column_k => $column_v) {
		if (in_array('index', $column_v['visible'])) {
			$belongsToRelation = BackstageHelper::findAllModelBelongsTo($model, $column_k);
			if (empty($belongsToRelation)) {
				if ($column_v['control'] == 'datetime') {
					$columns[] = array(
						'name' => $column_k,
						'value' => '(!empty($data->' . $column_k . '))?date("M j, Y", strtotime($data->' . $column_k . ')):"-"',
					);
				} else if ($column_v['control'] == 'richtext') {
					$columns[] = array(
						'class' => 'backstage.extensions.kcolumns.KHtmlPurifierColumn',
						'name' => $column_k,
						'options' => array(
							'HTML.AllowedElements' => array('i', 'em', 'strong', 'b', 'sup', 'sub'),
							'HTML.AllowedAttributes' => array(),
						),
						'truncate_length' => 250,
					);
				} else {
					$columns[] = array(
						'name' => $column_k,
						'type' => 'raw',
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
	}
	$columns[] = array(
		'class' => 'BootButtonColumn',
		'viewButtonIconCssClass' => 'icon-eye-open',
		'viewButtonUrl' => 'Yii::app()->controller->createUrl("model/view", array("name" => "' . $name . '", "id" => $data->id))',
		'updateButtonUrl' => 'Yii::app()->controller->createUrl("model/update", array("name" => "' . $name . '", "id" => $data->id))',
		'deleteButtonUrl' => 'Yii::app()->controller->createUrl("model/delete", array("name" => "' . $name . '", "id" => $data->id))',
	);
	$this->widget('CGridView', array(
		'id' => 'gridview',
		'itemsCssClass' => 'table',
		'pagerCssClass' => 'pagination',
		'pager' => array('class' => 'backstage.extensions.bootstrap.widgets.BootPager'),
		'dataProvider' => $model->search(),
		'template' => '<!--{summary}-->{items} {pager}',
		'columns' => $columns,
	));
	?>
</div>

