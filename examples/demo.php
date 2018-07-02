<?php
/**
 * Created by PhpStorm.
 * User: gradydong
 * Date: 2018/7/2
 * Time: 14:48
 */
error_reporting(E_ALL ^ E_NOTICE);
require '../../../../vendor/autoload.php';

use ClassInApi\ClassInApi;

$config = array(
    'SID' => "", // getenv('CLASSINAPI_SID'), //'您的 SID',
    'SECRET' => "", // getenv('CLASSINAPI_SECRET'), //'您的 SECRET',
);
$classinapi = ClassInApi::load($config);
$res = $classinapi->getCourseList();
var_dump($res);
