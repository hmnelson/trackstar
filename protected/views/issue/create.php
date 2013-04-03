<?php
$this->breadcrumbs=array(
  'Projects'=>array('project/index'),
  'Project'=>array('project/view', 'id'=>$this->project->id),
	'Issues'=>array('index', 'pid'=>$this->project->id),
	'Create',
);

$this->menu=array(
	array('label'=>'List Issues','url'=>array('index', 'pid'=>$this->project->id)),
	array('label'=>'Manage Issues','url'=>array('admin', 'pid'=>$this->project->id)),
);
?>

<h1>Create Issue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>