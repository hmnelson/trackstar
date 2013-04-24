<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $issueDataProvider Issues array */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Manage Projects', 'url'=>array('admin')),
	array('label'=>'This Project:', 'template'=>'<h4>{menu}</h4>'),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Create Issue', 'url'=>array('issue/create', 'pid'=>$model->id)),
);
if(Yii::app()->user->checkAccess('createUser', array('project'=>$model)))
{
	array_splice($this->menu, 2, 0, array(array('label'=>'Add User', 'url'=>array('adduser', 'id'=>$model->id))));
}
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
