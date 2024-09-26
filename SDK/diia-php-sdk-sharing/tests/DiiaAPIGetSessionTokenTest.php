<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIGetSessionTokenTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testGetSessionToken(): void
    {
        try {
            $token = $this->diiaAPI->getToken();

            echo "Session token: " . $token . PHP_EOL;
            $this->assertNotEmpty($this->diiaAPI->getToken(), 'Session token is empty');
        } catch (Exception $e) {
            $this->fail('Exception: ' . $e->getMessage());
        }
    }
}
