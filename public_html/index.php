<?php

mb_internal_encoding('utf-8');

$yii    = '../vendor/yiisoft/yii/framework/yii.php';
$config = '../protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

error_reporting(E_ALL);
if (defined('YII_DEBUG') && YII_DEBUG === true) {
    ini_set('display_errors', 'on');
    ini_set('html_errors', 'on');
}

require_once($yii);
Yii::createWebApplication($config)->run();
