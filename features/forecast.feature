Feature:
  In order to prove that multiple interaction with the container
  doesn't work when using mink


  Scenario: The first call will work
    Given I force the degreeInCelsius to "20"
    When I send a GET request to '/api/forecasts/BE'
    And the JSON node 'degreeInCelsius' should be equal to "20"

  Scenario: using default value works
    When I send a GET request to '/api/forecasts/BE'
    And the JSON node 'degreeInCelsius' should be equal to "34.3"

  Scenario: Same as first test, but doesn't work
    Given I force the degreeInCelsius to "20"
    When I send a GET request to '/api/forecasts/BE'
    Then the response status code should be 200
    And the JSON node 'degreeInCelsius' should be equal to "20"