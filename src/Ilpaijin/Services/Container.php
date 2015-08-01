<?php

namespace Ilpaijin\Services;

/**
 *
 * @package    SmallestAPIEver
 * @author     Paolo Pietropoli (ilpaijin) <ilpaijin@gmail.com>
 * @copyright  ilpaijin
 * @license
 * @version    Release: @package_version@
 */
class Container
{
    /**
     * Services list
     *
     * @var array
     */
    protected $services = array();

    /**
     * Get the service, if is set
     *
     * @param string $serviceName
     * @return boolean
     */
    public function get($serviceName)
    {
        return isset($this->services[$serviceName]) ? $this->services[$serviceName] : false;
    }

    /**
     * Set the service
     *
     * @param string $serviceName
     * @param mixed $service
     */
    public function set($serviceName, $service)
    {
        $this->services[$serviceName] = $service;
    }
}
