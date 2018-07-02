<?php
/**
 * Created by PhpStorm.
 * User: gradydong
 * Date: 2018/7/2
 * Time: 15:00
 */
namespace ClassInApi;

class ClassInApi
{

    /**
     * API serverhost
     * @var string
     */
    protected $_serverHost = 'www.eeo.cn';

    /**
     * Action url
     * @var string
     */
    protected $_actionUrl = '';

    /**
     * Accredited institution ID
     * @var string
     */
    protected $_SID = "";

    /**
     * Accredited institution secret key
     * @var string
     */
    protected $_SECRET = "";


    /**
     * Request action
     * @var string
     */
    protected $_action = "";

    /**
     * Raw response
     * @var string
     */
    protected $_rawResponse = '';


    /**
     * Setting timeout
     * @var int
     */
    protected $_timeOut = 60;


    /**
     * __construct
     * @param array $config [description]
     */
    public function __construct($config = array())
    {
        if (!empty($config)) {
            $this->setConfig($config);
        }
    }


    /**
     * Load classinapi
     * @param array  $config  config
     * @return
     */
    public static function load($config = array())
    {
        $classinapi = new ClassInApi($config);
        return $classinapi;
    }


    /**
     * Set configuration
     * @param $config
     * @return bool
     */
    public function setConfig($config)
    {
        if (!is_array($config) || !count($config))
            return false;

        foreach ($config as $key => $val) {
            switch ($key) {
                case 'SID':
                    $this->setConfigSid($val);
                    break;

                case 'SECRET':
                    $this->setConfigSecret($val);
                    break;

                default:
                    ;
                    break;
            }
        }
        return true;
    }

    /**
     * Set SID
     * @param $sid
     * @return $this
     */
    public function setConfigSID($sid)
    {
        $this->_SID = $sid;
        return $this;
    }

    /**
     * Set SECRET
     * @param $secret
     * @return $this
     */
    public function setConfigSECRET($secret)
    {
        $this->_SECRET = $secret;
        return $this;
    }

    /**
     * Set server host
     * @return string
     */
    public function setServerHost($serverHost)
    {
        $this->_serverHost = $serverHost;
        return $this;
    }


    /**
     * Set request url
     * @return string
     */
    public function setRequestUrl()
    {
        $this->_actionUrl = 'https://' . $this->_serverHost . '/partner/api/course.api.php?action=' . $this->_action;
        return $this;
    }

    /**
     * Get response
     * @return
     */
    public function getResponse()
    {
        return $this->_rawResponse;
    }

    /**
     * Forward the request through __call
     * @param  string $name action name
     * @param  array $arguments arguments
     * @return
     */
    public function __call($name, $arguments)
    {
        $this->_action = $name;
        $this->setRequestUrl();
        return $this->_dispatchRequest($arguments);
    }

    /**
     * Initiate request
     * @param  string $name action name
     * @param  array $arguments arguments
     * @return
     */
    protected function _dispatchRequest($arguments)
    {
        $params = array();
        if (is_array($arguments) && !empty($arguments)) {
            $params = (array)$arguments[0];
        }
        $response = $this->send($params);
        return $response;
    }


    /**
     * Initiate request
     * @param  array $paramArray request data
     * @param  string $sid sid
     * @param  string $secret secret
     * @return
     */
    public function send($paramArray)
    {
        if (!isset($paramArray['SID'])) {
            $paramArray['SID'] = $this->_SID;
        }
        if (!isset($paramArray['timeStamp'])) {
            $paramArray['timeStamp'] = time();
        }
        if (!isset($paramArray['SECRET'])) {
            $paramArray['safeKey'] = md5($this->_SECRET . $paramArray['timeStamp']);
        }
        //used to uploadFile API
        if(isset($paramArray['Filedata'])&&
            !empty($paramArray['Filedata'])
        ){
            $paramArray['Filedata'] = fopen($paramArray['Filedata'], 'r');
        }
        return $this->_sendRequest($paramArray);
    }

    /**
     * send request
     * @param  array $paramArray request data
     * @return object|array
     */
    protected function _sendRequest($paramArray)
    {
        $client = new \GuzzleHttp\Client();
        $multipart = [];
        foreach ($paramArray as $item => $value){
            $multipart[] = [
                'name' => $item,
                'contents' => $value,
            ];
        }
        $option = [
            'multipart' => $multipart,
            'timeout' => $this->_timeOut
        ];
        if (false !== strpos($this->_actionUrl, "https")) {
            $option['verify'] = false;
        }
        $guzzlehttp = $client->request('POST', $this->_actionUrl, $option);
        $response = $guzzlehttp->getBody();
        $this->_rawResponse = $response;
        $response = json_decode($response,JSON_UNESCAPED_UNICODE);
        return $response;
    }

}
