<h1>Instructions</h1>
<?php
$backstage_path = "";
foreach (Yii::app()->modules as $k => $v) {
	if (strpos($v['class'], 'BackstageModule') > 0) {
		$backstage_path = $k;
	}
}
echo CHtml::link('Go to Backstage', array("/$backstage_path"));
?>
