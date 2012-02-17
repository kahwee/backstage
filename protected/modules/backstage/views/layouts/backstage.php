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
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="/backstage"><?php echo CHtml::encode(Yii::app()->name) ?></a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class='active'><a href="/">View Sites</a></li>
							<li><a href="/backstage/default/faq">FAQ</a></li>
						</ul>
						<ul class="nav pull-right">
							<li ><a href="#" >Logout</a></li>
						</ul>
						<p class="navbar-text pull-right">Welcome Admin! </p>
					</div><!--/.nav-collapse -->
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
<style type="text/css" media="screen">
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
</style>
<?php Yii::app()->clientScript->registerScript('search', <<<JAVASCRIPT
$(function(){
	$('#btn-search').click(function() {
		$('.search-form').show('slide');
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		return false;
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
