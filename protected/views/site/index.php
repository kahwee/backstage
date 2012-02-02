<h1 >Instruction</h1>
<?php
	$label = '<button class="bt3">Link to Back Stage</button>';
	$rurl= array('/backstage');
	$htmlOption = array();
	echo CHtml::link($label,$rurl,$htmlOption);
?>