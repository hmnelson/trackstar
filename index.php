<?php

// change the following paths if necessary
// uncomment the following line for use in a sandbox directory on mmweb
// $yii= '/var/www/data/root/mmweb/yii/framework/yii.php';
// uncomment the following line for use in your local Sites folder
$yii=dirname(__FILE__).'/../yii/framework/yii.php';

$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
