<?php

namespace Ilpaijin\Controller;

use Ilpaijin\Services\Container;
use Ilpaijin\Exception\CaseException;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * @package    SmallestAPIEver
 * @author     Paolo Pietropoli (ilpaijin) <ilpaijin@gmail.com>
 * @copyright  ilpaijin
 * @license
 * @version    Release: @package_version@
 */
class AnswerController
{
    /**
     * @var Container
     */
    protected $Container;

    /**
     *
     *
     * @param Container $Container
     */
    public function __construct(Container $Container)
    {
        $this->container = $Container;
    }

    /**
     * Get the answer from the case
     *
     * @return use Symfony\Component\HttpFoundation\Response;
     * @return use Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function indexAction()
    {
        $token = $this->container->get('request')->query->get('token');
        $sum = $this->container->get('request')->query->get('sum');

        if (!isset($token) && !isset($url)) {
            return new JsonResponse(array('error' => 'Endpoint Not Found'), 404);
        }

        try {
            $answer = $this->container->get('mamonCase')->getAnswer($token.'/'.$sum);
        } catch (CaseException $e) {
            return new JsonResponse(array('error' => $e->getMessage()), 404);
        }

        if (isset(json_decode($answer, true)['error'])) {
            return new JsonResponse(array('error' => 'Unprocessable Entity'), 422);
        }

        return Response::create($answer, 200, ['Content-type' => 'application/json']);
    }
}
