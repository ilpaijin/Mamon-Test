<?php

namespace Tests\BDD;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;

/**
 * Defines application features from the specific context.
 */
class ApiContext implements Context, SnippetAcceptingContext
{
    protected $client;

    protected $request;

    protected $response;

    protected $testingHost = 'http://localhost:8090/api.php';

    public function __construct()
    {
        $this->client = new Client([
            ['base_uri' => $this->testingHost],
            'exceptions' => false,
            'http_errors' => false,
        ]);
    }

    public function createRequest($method, $url)
    {
        return new Request(
            $method,
            $this->testingHost.$url
        );
    }
}
