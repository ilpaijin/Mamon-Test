<?php

namespace Ilpaijin\Controller;

use Ilpaijin\Services\Container;
use Ilpaijin\Exception\CaseException;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @package    SmallestAPIEver
 * @author     Paolo Pietropoli (ilpaijin) <ilpaijin@gmail.com>
 * @copyright  ilpaijin
 * @license
 * @version    Release: @package_version@
 */
class QuestionController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     *
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get the question from the case
     *
     * @return use Symfony\Component\HttpFoundation\Response;
     * @return use Symfony\Component\HttpFoundation\JsonResponse;
     */
    public function indexAction()
    {
        //look 'ma, I'm Hexagonal!!!
        try {
            $answer = $this->container->get('mamonCase')->getQuestion();
        } catch (CaseException $e) {
            return new JsonResponse(array('error' => $e->getMessage()), 404);
        }

        return Response::create($answer, 200, ['Content-type' => 'application/json']);
    }
}
