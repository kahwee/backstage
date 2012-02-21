<h1>Instructions</h1>
<?php
var_dump(Yii::app()->modules);
exit;
	$label = '<button class="bt3">Link to Back Stage</button>';
	$rurl= array('/backstage2');
	$htmlOption = array();
	echo CHtml::link('Go to Backstage', $rurl,$htmlOption);
?>
