<?php

namespace Ilpaijin;

use Ilpaijin\Services\Container;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * @package    SmallestAPIEver
 * @author     Paolo Pietropoli (ilpaijin) <ilpaijin@gmail.com>
 * @copyright  ilpaijin
 * @license
 * @version    Release: @package_version@
 */
class Application
{
    /**
     * Primordial Service Container, DIC can wait
     *
     * @var Container
     */
    protected $container;

    /**
     * Allowed Endpoints regexp
     *
     * @var string
     */
    protected $allowedEndpoints = '#^\/question\/$|\/answer\/(.*)#';

    /**
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Let's dance!
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function run()
    {
        $request = Request::createFromGlobals();

        if ($request->getMethod() !== 'GET' && $request->getMethod() !== 'POST') {
            return $this->methodNotAllowed();
        }

        if ($request->getMethod() === 'GET' && !preg_match_all($this->allowedEndpoints, $request->getPathInfo())) {
            return $this->itemNotFound();
        }

        $controller = 'Ilpaijin\\Controller\\'.ucfirst(str_replace('/', '', $request->getPathInfo())) . 'Controller';

        $this->container->set('request', $request);

        if (!class_exists($controller)) {
            return $this->itemNotFound();
        }

        $controller = new $controller($this->container);

        return $controller->indexAction()->send();
    }

    /**
     * 405 Http Status Wrapper
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function methodNotAllowed()
    {
        return JsonResponse::create(array('error' => 'Method Not Allowed'), 405)->send();
    }

    /**
     * 404 Http Status wrapper
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function itemNotFound()
    {
        return JsonResponse::create(array('error' => 'Endpoint Not Found'), 404)->send();
    }
}
