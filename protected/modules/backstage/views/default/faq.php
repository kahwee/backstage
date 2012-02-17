<div class="span2" id='nav-main'>
	<div class="sidebar-nav">
		<?php $this->renderPartial('../model/_model_list'); ?>
	</div><!-- sidebar-nav -->
</div>
<div class="span10" id='con-main'>
	<div id="con-alert">
		<?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
			<div class='alert alert-<?php echo $key?>' style='margin:0 0 10px 0;'>
			<a class='close'>×</a>
			<h4 class='alert-heading'><?php echo $key ?></h4>
			<?php echo $message ?>
			</div>
		<?php } ?>
	</div><!-- con-alert -->
	
<pre>
<?php  echo file_get_contents('README.md'); ?>
</pre>
</div>
