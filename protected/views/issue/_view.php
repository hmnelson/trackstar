<?php
/* @var $this IssueController */
/* @var $data Issue */
?>

<div class="view">

	<div>
  	<b><?php echo CHtml::link(CHtml::encode($data->name), array('/issue/view','id'=>$data->id,)); ?></b>
   </div>

	<div>
		<?php echo CHtml::encode($data->description); ?>
	</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('typeId')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusId')); ?>:</b>
	<?php echo CHtml::encode($data->getStatus()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownerId')); ?>:</b>
	<?php echo CHtml::encode($data->getOwnerName()); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('requesterId')); ?>:</b>
	<?php echo CHtml::encode($data->requesterId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createTime')); ?>:</b>
	<?php echo CHtml::encode($data->createTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creatorId')); ?>:</b>
	<?php echo CHtml::encode($data->creatorId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updaterId')); ?>:</b>
	<?php echo CHtml::encode($data->updaterId); ?>
	<br />

	*/ ?>

</div>