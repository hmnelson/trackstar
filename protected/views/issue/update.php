<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->htmlClass='issue update';

$this->breadcrumbs=array(
  'Projects'=>array('project/index'),
  'Project'=>array('project/view', 'id'=>$this->project->id),
	'Issues'=>array('index', 'pid'=>$this->project->id),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Issues','url'=>array('index')),
	array('label'=>'Create Issue','url'=>array('create')),
	array('label'=>'View Issue','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Issues','url'=>array('admin')),
);
?>

<h1>Update Issue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>