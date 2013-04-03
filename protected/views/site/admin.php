<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Administration';
$this->breadcrumbs=array(
	'admin',
);
?>

<h1><?php echo $this->pageTitle=Yii::app()->name ?> Administration</h1>

<?php if(Yii::app()->user->isGuest): ?>
  <p>You must <?php echo CHtml::link('log in', 'site/login'); ?> to manage this application.</p>
<?php endif ?>

<?php if(!Yii::app()->user->isGuest): ?>

  <div class="span3" id="sidebar">
    <h4>Operations</h4>
    <?php
      $this->widget('bootstrap.widgets.TbMenu', array(
        'type'=>'tabs',
        'stacked'=>true,
        'htmlOptions'=>array('class'=>'Options'),
        'items'=>array(
					array('label'=>'Manage Projects','url'=>array('project/admin')),
					array('label'=>'Manage Users','url'=>array('user/admin')),
				),
      ));
    ?>
	</div><!-- sidebar -->

<?php endif ?>
