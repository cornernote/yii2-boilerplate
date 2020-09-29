<?php

namespace app\components\console;


/**
 * Console Request
 */
class Request extends \yii\console\Request
{

    private $_queryParams;

    public function getQueryParams()
    {
        if ($this->_queryParams === null) {
            return [];
        }
        return $this->_queryParams;
    }

    public function setQueryParams($values)
    {
        $this->_queryParams = $values;
    }

    public function get($name = null, $defaultValue = null)
    {
        if ($name === null) {
            return $this->getQueryParams();
        }
        return $this->getQueryParam($name, $defaultValue);
    }

    public function getQueryParam($name, $defaultValue = null)
    {
        $params = $this->getQueryParams();

        return isset($params[$name]) ? $params[$name] : $defaultValue;
    }

    public function getAbsoluteUrl()
    {
        return $this->getHostInfo() . $this->getUrl();
    }

    private $_url;

    public function getUrl()
    {
        if ($this->_url === null) {
            $this->_url = $this->resolveRequestUri();
        }
        return $this->_url;
    }

    public function setUrl($value)
    {
        $this->_url = $value;
    }

    protected function resolveRequestUri()
    {
        return '';
    }

    public function getQueryString()
    {
        return '';
    }

    public function getIsSecureConnection()
    {
        return true;
    }

    private $_hostInfo;
    private $_hostName;

    public function getHostInfo()
    {
        return $this->_hostInfo;
    }

    public function setHostInfo($value)
    {
        $this->_hostName = null;
        $this->_hostInfo = $value === null ? null : rtrim($value, '/');
    }

    public function getHostName()
    {
        if ($this->_hostName === null) {
            $this->_hostName = parse_url($this->getHostInfo(), PHP_URL_HOST);
        }
        return $this->_hostName;
    }

    private $_baseUrl;

    public function getBaseUrl()
    {
        return $this->_baseUrl;
    }

    public function setBaseUrl($value)
    {
        $this->_baseUrl = $value;
    }

}