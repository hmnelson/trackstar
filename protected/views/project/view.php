<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $issueDataProvider Issues array */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Projects', 'url'=>array('admin')),
	array('label'=>'Create Issue', 'url'=>array('issue/create', 'pid'=>$model->id)),
);
?>

<h1>View Project #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'createTime',
		array(
		  'name'=>'creatorId',
			'value'=>$model->creator->fullName,
		),
		'updateTime',
		array(
			'name'=>'updaterId',
			'value'=>$model->updater->fullName,
		),
	),
)); ?>

<h2>Project Issues</h2>

<?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$issueDataProvider,
	'itemView'=>'/issue/_view',
)); ?>
