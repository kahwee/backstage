<div class="span2">
	<div class="sidebar-nav">
		<?php $this->renderPartial('../model/_model_list'); ?>
	</div><!-- sidebar-nav -->
</div>
<div class="span10">
<pre>
<?php  echo file_get_contents('README.md'); ?>
</pre>
</div>