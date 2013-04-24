<?php /* @var $this Controller */ ?>
<?php date_default_timezone_set('America/New_York'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" <?php if(isset($this->htmlId)): ?><?php echo 'id="' . $this->htmlId . '-page"'; ?><?php endif ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  
  <?php Yii::app()->bootstrap->register(); ?>
  
</head>

<body>

<div class="container-fluid span12" id="page">

	<div id="mainmenu">
		<?php 
			$this->widget('bootstrap.widgets.TbNavbar', array(
				'type'=>'inverse',
				'brand'=>CHtml::encode(Yii::app()->name),
				'brandUrl'=>array('/site/index'),
				'fixed'=>'top',
				'fluid'=>true,
				'collapse'=>true,
				'items'=>array(
					array(
						'class'=>'bootstrap.widgets.TbMenu',
						'type'=>'pills',
						'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
							array('label'=>'Admin', 'url'=>array('/site/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
				),
			)); ?>
	</div><!-- mainmenu -->
  
	<?php if(isset($this->breadcrumbs)):?>
    <?php 
      $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        )
      ); ?><!-- breadcrumbs -->
  <?php endif; ?>

  <div class="row-fluid">
  
	  <?php echo $content; ?>
    
  </div>
  
  <?php if(!Yii::app()->user->isGuest): ?>
    <div id="login-info" class="row-fluid">
      <div class="span6 pull-right text-right muted">
        <small>Logged in since <?php echo date('l, F d, Y, g:i a', Yii::app()->user->lastLogin ); ?></small>
      </div>
    </div>
  <?php endif; ?>
  
<div id="footer-container" class="row-fluid"> 
      
  <div id="footer-purdue-signature-tab" class="span2">
    <div class="gold-bar">&nbsp;</div>
    <div id="footer-purdue-signature-container"> 
      <a href="http://www.purdue.edu/"><img src="https://marketing.purdue.edu/wraps/wrap009/graphics/PU_signature_black_bg_125x45.png" alt="Purdue signature" title="" height="45" width="125" border="0" id="footer-purdue-signature"></a> 
    </div>
  </div>

  <div id="left-foot" class="span10 offset2">
    Purdue University, West Lafayette, IN 47907, (765) 494-4600<br> 
    <a href="http://www.purdue.edu/purdue/disclaimer.html">&copy; <?php echo date('Y'); ?> Purdue University</a> | <a href="http://www.purdue.edu/purdue/ea_eou_statement.html">An equal access/equal opportunity university</a> | <a href="http://www.purdue.edu/securepurdue/DMCAAgent.cfm">Copyright Complaints</a> | <a href="http://marketing.purdue.edu/Contact/Input/">Your Input</a> | <a href="http://www.purdue.edu/purdue/about/contact.html" title="Contact Purdue">Contact Purdue</a><br> 
    If you have trouble accessing this page because of a disability, please contact Purdue Marketing and Media at <a href="mailto:marketing@purdue.edu">marketing@purdue.edu</a>.<br/>
    <?php echo Yii::powered(); ?>
  </div>  
  
</div><!-- footer -->

</div><!-- page -->

</body>
</html>
