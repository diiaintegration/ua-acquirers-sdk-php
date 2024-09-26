<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIAuthTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testGetAuthLink(): void
    {
        $branchId = 'Branch_Id'; // Branch Identifier
        $offerId = 'Offer_Id'; // Offer Identifier
        $returnLink = 'https://return_link';; // Return Link in format https://
        $requestId = 'MzBhMDc1YTktYTkxZC00YjFjLWJjYjctYTI4NjgzOTA5OGEx'; // Generated UUID v4
        $signAlgo = 'DSTU'; // Or 'ECDSA'

        $base64RequestId = base64_encode(hash('sha256', $requestId, true)); // Hashed requestId

        try {
            $deeplink = $this->diiaAPI->getAuthLink($branchId, $offerId, $returnLink, $base64RequestId, $signAlgo);
            $this->assertNotEmpty($deeplink, 'Deeplink was not obtained.');
            echo "Obtained authorization deeplink: $deeplink" . PHP_EOL;
        } catch (Exception $e) {
            $this->fail('Error obtaining authorization deeplink: ' . $e->getMessage());
        }
    }
}
