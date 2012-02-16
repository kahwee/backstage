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
		<div class='clear' style='height:60px'></div>
		<div >
			<?php
			foreach (Yii::app()->user->getFlashes() as $key => $message) {
				if ($key == 'counters') {
					continue;
				} //no need next line since 1.1.7
				echo "<div class='alert alert-{$key}' style='margin:0 20px 20px 20px;'>" .
				"<a class='close'>×</a>" .
				"<h4 class='alert-heading'>{$key}</h4>" .
				"{$message}" .
				"</div>";
			}
			?>
		</div>
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
.sidebar-nav{
	background-color:whiteSmoke;
	min-height:580px;
	margin-top:-40px; padding-top:40px;
	margin-left:-20px; padding-left:0px;
	border-right:1px solid #CCC;
}
.clear{clear:both;}
</style>
	</body>
</html>
