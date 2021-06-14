# Reproducer for issue #149

[Interacting with the driverContainer doesn't work when running multiple scenario in a row](https://github.com/FriendsOfBehat/SymfonyExtension/issues/149)

## Use this reproducer

```shell
git pull ... reproducer-149
cd reproducer-149
composer install
vendor/bin/behat features/forecast.feature
# or
composer exec behat
```


Please the below the results. Obvisouly the 3rd scenario should be green
as the first one.


```diff
vendor/bin/behat features/forecast.feature
Feature:
  In order to prove that multiple interaction with the container
  doesn't work when using mink

+  Scenario: The first call will work                            # features/forecast.feature:6
+    Given I force the degreeInCelsius to "20"                   # App\Tests\Behat\ForecastContext::iForceTheDegreeincelsiusTo()
+    When I send a GET request to '/api/forecasts/BE'            # Behatch\Context\RestContext::iSendARequestTo()
+    And the JSON node 'degreeInCelsius' should be equal to "20" # Behatch\Context\JsonContext::theJsonNodeShouldBeEqualTo()

  Scenario: using default value works                             # features/forecast.feature:12
    When I send a GET request to '/api/forecasts/BE'              # Behatch\Context\RestContext::iSendARequestTo()
    And the JSON node 'degreeInCelsius' should be equal to "34.3" # Behatch\Context\JsonContext::theJsonNodeShouldBeEqualTo()

  Scenario: Same as first test, but doesn't work                # features/forecast.feature:16
    Given I force the degreeInCelsius to "20"                   # App\Tests\Behat\ForecastContext::iForceTheDegreeincelsiusTo()
    When I send a GET request to '/api/forecasts/BE'            # Behatch\Context\RestContext::iSendARequestTo()
    Then the response status code should be 200                 # Behat\MinkExtension\Context\MinkContext::assertResponseStatus()
-    And the JSON node 'degreeInCelsius' should be equal to "20" # Behatch\Context\JsonContext::theJsonNodeShouldBeEqualTo()
-      The node value is '"34.3"' (Exception)

- - Failed scenarios:

-    features/forecast.feature:16
```