<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
  'Projects'=>array('project/index'),
  'Project'=>array('project/view', 'id'=>$this->project->id,),
	'Issues'=>array('index', 'pid'=>$this->project->id,),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Issues','url'=>array('index', 'pid'=>$model->project->id)),
	array('label'=>'Create Issue','url'=>array('create', 'pid'=>$model->project->id)),
	array('label'=>'Update Issue','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Issue','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Issues','url'=>array('admin', 'pid'=>$model->project->id)),
);
?>

<h1>View Issue #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		array(
		  'name'=>'projectId',
			'value'=>CHtml::encode($this->project->name),
		),
		array(
		  'name'=>'typeId',
		  'value'=>CHtml::encode($model->type),
		),
		array(
		  'name'=>'statusId',
			'value'=>CHtml::encode($model->status),
		),
		array(
			'name'=>'requesterId',
			'value'=>CHtml::encode($model->requester->fullName),
		),
		array(
			'name'=>'ownerId',
			'value'=>CHtml::encode($model->owner->fullName),
		),
		array(
			'name'=>'creatorId',
			'value'=>CHtml::encode($model->creator->fullName),
		),
		array(
			'name'=>'updaterId',
			'value'=>CHtml::encode($model->updater->fullName),
		),
		/* 
		'createTime',
		'updateTime',
		*/
	),
)); ?>
