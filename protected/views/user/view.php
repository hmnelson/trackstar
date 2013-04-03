<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->fullNameLastFirst,
);

$this->menu=array(
	array('label'=>'List Users','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users','url'=>array('admin')),
);
?>

<h1>View User: <?php echo CHtml::link($model->fullNameLastFirst, array('update', 'id'=>$model->id)); ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'firstName',
		'lastName',
		'id',
		'email',
		'careerAcct',
		'puid',
		'lastLogin',
	),
)); ?>
