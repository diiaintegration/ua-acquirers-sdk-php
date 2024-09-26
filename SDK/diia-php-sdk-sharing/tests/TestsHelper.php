<?php
namespace Tests;

use DiiaAPI;

class TestsHelper
{
    public static function getInstanceOfDiiaAPI()
    {
        $environment = 'test'; // Or 'prod', depending on the environment
        $acquirerToken = 'acquirer_token';
        $authAcquirerToken = 'auth_acquirer_token'; // If necessary

        $diiaAPI = new DiiaAPI($environment, $acquirerToken, $authAcquirerToken);
        return $diiaAPI;
    }
}
