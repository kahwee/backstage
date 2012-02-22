<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<?php
		# inc bootstrap
		$asset_url = Yii::app()->assetManager->publish(Yii::getPathOfAlias('backstage.bootstrap'), false, -1, true);
		Yii::app()->clientScript->registerScriptFile("$asset_url/js/bootstrap.min.js", CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerCssFile("$asset_url/css/bootstrap.css");
		?>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body>

		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<div class="nav-collapse row-fluid">
						<div class="span2" style='position:fixed'>
							<?php echo CHtml::link(Yii::app()->name, array('default/index'), array('class' => 'brand')); ?>
						</div><!-- span2 -->
						<div class='span10' style='padding-left: 14.89361702%; margin-left:-14px'>
							<?php
							$this->widget('zii.widgets.CMenu', array(
								'items' => $this->navBarItems,
								'htmlOptions' => array('class' => 'nav'),
								'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
								'encodeLabel' => false,
							));?>

							<ul class='nav pull-right'>
								<li >
									<a href="/" > <span style='padding:0 10px'>View Site</span> <i class="icon-home icon-white"></i></a>
								</li>
							</ul>
						</div><!-- span10 -->
					</div>
				</div>
			</div>
		</div>
		<div class='clear' style='height:54px'></div>
		<div class="container-fluid">
			<div class="row-fluid">
				<?php echo $content; ?>
			</div>
			<div id="footer" style='text-align:center;font-size:8pt;color:#777'>
				<div class="clear"></div>
				&copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?>.
			</div><!-- footer -->
		</div>
<?php Yii::app()->clientScript->registerCss('backstage/layout/css', <<<CSS
div#nav-main{
	background-color:whiteSmoke;
	margin-top:-40px; padding-top:40px;
	margin-left:-20px; padding-left:0px;
	border-right:1px solid #CCC;
	height:100%;
	position:fixed;
	overflow:auto;
}
div#con-main{
	padding-left:14.89361702%;
}
.clear{clear:both;}

div.navbar i.icon-white {
	opacity: .5;
}
div.navbar a:hover i.icon-white {
	opacity: 1;
}
CSS
);
?>
<?php Yii::app()->clientScript->registerScript('search', <<<JAVASCRIPT
jQuery(function($) {

	$('#btn-search').click(function(ev) {
		$('.search-form').slideToggle();
		$(this).parent('li').toggleClass('active');
		ev.stopPropagation();
	});

	$('#btn-index').click(function() {
		$('.search-form').hide('slide');
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		return false;
	});
	$('.btn.disabled,.btn.active').click(function(e){
		return false;
	});
	$('.close').click(function(e){
		var target = $( this );
		target.parent().hide('fade');
	});
	$('.search-form form').submit(function() {
		$.fn.yiiGridView.update('gridview', {
			data: $(this).serialize()
		});
		return false;
	});
});
JAVASCRIPT
); ?>
	</body>
</html>
