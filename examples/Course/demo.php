<?php
/**
 * Created by PhpStorm.
 * User: gradydong
 * Date: 2018/7/9
 * Time: 13:09
 */

error_reporting(E_ALL ^ E_NOTICE);
require '../../vendor/autoload.php';

use ClassInApi\Module\Course as ClassInCourseApi;

$config = array(
    'SID' => "", // getenv('CLASSINAPI_SID'), //'您的 SID',
    'SECRET' => "", // getenv('CLASSINAPI_SECRET'), //'您的 SECRET',
);
$classincourseapi = new ClassInCourseApi($config);
$res = $classincourseapi->getCourseList();
var_dump($res);