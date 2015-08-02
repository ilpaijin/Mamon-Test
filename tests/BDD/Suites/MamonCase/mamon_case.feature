Feature: mamon_case
    In order to test the mamon case calls
    As a browser client
    I need to be able to make calls to it and get the response payloads

    Scenario: Getting a "question", means obtaining a token, and a list of values
        Given I need to obtain a token and a list of values
        When I send a "GET" request to the "/question/" endpoint
        Then the responseCode should be "200"
        And the response should have JSON format
        And the JSON should contain the attributes
            | token |
            | values |
