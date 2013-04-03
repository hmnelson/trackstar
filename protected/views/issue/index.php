<?php
/* @var $this IssueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
  'Projects'=>array('project/index'),
  'Project'=>array('project/view', 'id'=>$this->project->id),
	'Issues',
);

$this->menu=array(
	array('label'=>'Create Issue','url'=>array('create','pid'=>$this->project->id)),
	array('label'=>'Manage Issues','url'=>array('admin','pid'=>$this->project->id)),
);
?>

<h1>Issues</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
