<?php

namespace Ilpaijin\Domain\Cases;

use GuzzleHttp\Client as HttpClient;

use Ilpaijin\Exception\CaseException;

/**
 *
 * @package    SmallestAPIEver
 * @author     Paolo Pietropoli (ilpaijin) <ilpaijin@gmail.com>
 * @copyright  ilpaijin
 * @license
 * @version    Release: @package_version@
 */
class MamonCase
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $host = 'http://aerial-valor-93012.appspot.com/';

    /**
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->httpClient = new HttpClient(array('base_uri' => $this->host));
    }

    /**
     * Call the challenge url and get the answer
     *
     * @param  string $url
     * @throws Ilpaijin\Exception\CaseException
     * @return string
     */
    public function getAnswer($url)
    {
        try {
            $answer = $this->httpClient->get('challenge/'.$url);
        } catch (\Exception $e) {
            throw new CaseException('No answer, somethig bad happened');
        }

        return $answer->getBody()->getContents();
    }

    /**
     * Call the challenge url and get the question
     *
     * @throws Ilpaijin\Exception\CaseException
     * @return string
     */
    public function getQuestion()
    {
        try {
            $response = $this->httpClient->get('challenge');
        } catch (\Exception $e) {
            throw new CaseException();
        }

        return $response->getBody()->getContents();
    }
}
