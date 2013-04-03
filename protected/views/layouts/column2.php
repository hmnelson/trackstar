<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="span9" id="main-content">
	<?php echo $content; ?>
</div><!-- content -->

<div class="span3" id="sidebar">
  <h4>Operations</h4>
	<?php
		$this->widget('bootstrap.widgets.TbMenu', array(
			'type'=>'tabs',
			'stacked'=>true,
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
	?>
	</div><!-- sidebar -->
  
<?php $this->endContent(); ?>