<?php
/**
 * Created by PhpStorm.
 * User: gradydong
 * Date: 2018/7/9
 * Time: 13:08
 */
error_reporting(E_ALL ^ E_NOTICE);
require '../../vendor/autoload.php';

use ClassInApi\Module\Cloud as ClassInCloudApi;

$config = array(
    'SID' => "", // getenv('CLASSINAPI_SID'), //'您的 SID',
    'SECRET' => "", // getenv('CLASSINAPI_SECRET'), //'您的 SECRET',
);


$classincloudapi = new ClassInCloudApi($config);
// 请求参数，请参考官方 API 文档上对应接口的说明
// 请求前可以通过下面四个方法重新设置请求的 SID/SECRET参数
// 请求方法对应api 文档 action值

// 重新设置 SID
$sid = '您的 SID';
$classincloudapi->setConfigSid($sid);

// 重新设置 SECRET
$secret = '您的 SECRET';
$classincloudapi->setConfigSecret($secret);

// 重新设置 ServerHost
$serverhost = '您的 ClassinApi ServerHost';
$classincloudapi->setServerHost($serverhost);

$res = $classincloudapi->getCloudList([
    'folderId' => 0
]);

var_dump($res);