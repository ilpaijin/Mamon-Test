<?php

namespace Tests\BDD\Suites\MamonCase\Contexts;

use \PHPUnit_Framework_Assert;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

use Tests\BDD\ApiContext;

/**
 * Defines application features from the specific context.
 */
class MamonCaseContext extends ApiContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given I need to obtain a token and a list of values
     */
    public function iNeedToObtainATokenAndAListOfValues()
    {
        return true;
    }

    /**
     * @When I send a :method request to the :url endpoint
     */
    public function iSendARequestToTheEndpoint($method, $url)
    {
        $this->request = $this->createRequest($method, $url);
    }

    /**
     * @Then the responseCode should be :statusCode
     */
    public function theResponsecodeShouldBe($statusCode)
    {
        $this->response = $this->client->send($this->request);

        PHPUnit_Framework_Assert::assertEquals($this->response->getStatusCode(), $statusCode);
    }

    /**
     * @Then the response should have JSON format
     */
    public function theResponseShouldHaveJsonFormat()
    {
        $this->jsonResponse = $this->response->getBody()->getContents();

        $this->response = json_decode($this->jsonResponse, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Not a json response');
        }
    }

    /**
     * @Then the JSON should contain the attributes
     */
    public function theJsonShouldContainTheAttributes(TableNode $table)
    {
        foreach ($table as $attribute) {
            PHPUnit_Framework_Assert::assertArrayHasKey(key($attribute), $this->response);
        }
    }
}
