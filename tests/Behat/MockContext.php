<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Happyr\ServiceMocking\ServiceMock;

final class MockContext implements Context
{
    /**
     * @afterScenario
     */
    public function resetMocks(): void
    {
        ServiceMock::resetAll();
    }
}
