<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

<div class="view row-fluid">
  <div class="span11">
  
    <div class="span12 name">
      <b><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?></b>
    </div>
  
    <p class="span12">
      <?php echo CHtml::encode($data->description); ?>
    </p>
  
    <div class="span6 small muted left">
      Created by
      <?php echo CHtml::encode($data->creator->fullName); ?>,
			<?php echo CHtml::encode(date('l, F d, Y, g:i a', strtotime($data->createTime))); ?>
    </div>
  
    <div class="span6 small muted right text-right">
      Updated by
      <?php echo CHtml::encode($data->updater->fullName); ?>,
			<?php echo CHtml::encode(date('l, F d, Y, g:i a', strtotime($data->updateTime))); ?>
    </div>
    
   </div>

</div>