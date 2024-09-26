<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIDeeplinkSharingTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testDeepinkSharing(): void
    {
        $branchId = 'Branch_Id'; // Branch Identifier
        $offerId = 'Offer_Id'; // Offer Identifier
        $returnLink = 'https://return_link'; // Return Link in https:// format
        $requestId = '2783f8bd-0b5d-48a2-becf-d308a8b2026a'; // Generated UUID v4
        $useDiiaId = true; // User's signature
    
        try {
            $deeplink = $this->diiaAPI->getDeepinkSharingLink($branchId, $offerId, $returnLink, $requestId, $useDiiaId);
            $this->assertNotEmpty($deeplink, 'Deeplink was not obtained.');
            echo "Obtained deeplink: $deeplink" . PHP_EOL;
        } catch (Exception $e) {
            $this->fail('Error while obtaining deeplink: ' . $e->getMessage());
        }
    }
}
