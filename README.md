### classin-api-sdk-php

classin-api-sdk-php 是为了让PHP开发者能够在自己的代码里更快捷方便的使用 ClassIn 的 API 而开发的 SDK 工具包。

### 入门

1. 申请安全认证。在第一次使用 API 之前，用户首先需要在 eeo.cn 网站上申请机构认证 API 密钥，密钥包含 SID 和 SECRET，SID 是用于标识调用者机构身份，SECRET 是用于服务器端验证签名字符串的密钥。SID 和 SECRET 需要严格保管，避免泄露。

2. 使用方法请参考下面的例子。

先安装 composer require classin-api/classin-api

云盘资源请求

```
<?php
use ClassInApi\Module\Cloud as ClassInCloudApi;

$config = array(
    'SID' => getenv('CLASSINAPI_SID'), //'您的 SID',
    'SECRET' => getenv('CLASSINAPI_SECRET'), //'您的 SECRET'
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

```

课程列表请求

```
<?php
use ClassInApi\Module\Course as ClassInCourseApi;

$config = array(
    'SID' => getenv('CLASSINAPI_SID'), //'您的 SID',
    'SECRET' => getenv('CLASSINAPI_SECRET'), //'您的 SECRET'
);

$classincourseapi = new ClassInCourseApi($config);
// 请求参数，请参考官方 API 文档上对应接口的说明
// 请求前可以通过下面四个方法重新设置请求的 SID/SECRET参数
// 请求方法对应api 文档 action值

// 重新设置 SID
$sid = '您的 SID';
$classincourseapi->setConfigSid($sid);

// 重新设置 SECRET
$secret = '您的 SECRET';
$classincourseapi->setConfigSecret($secret);

// 重新设置 ServerHost
$serverhost = '您的 ClassinApi ServerHost';
$classincourseapi->setServerHost($serverhost);

$res = $classincourseapi->getCourseList();

var_dump($res);

```
