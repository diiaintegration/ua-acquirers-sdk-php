<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPISignFileHashTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testGetSignLink(): void
    {
        $branchId = 'Branch_Id'; // Branch Identifier
        $offerId = 'Offer_Id'; // Offer Identifier
        $returnLink = 'https://return_link'; // Return Link в форматі https://
        $requestId = '2783f8bd-0b5d-48a2-becf-d508a9b2086a'; // Generated UUID v4
        $signAlgo = 'DSTU'; // Or 'ECDSA'
        $fileName = '1.pdf'; // Name of the file to be signed
        $fileHash = 'MTIzNDU4Nzg4MDEyMzQ1Njc4OTAxMjM0NTY4ODkwMTI='; // File hash in base64 format

        try {
            $deeplink = $this->diiaAPI->getSignLink($branchId, $offerId, $returnLink, $requestId, $signAlgo, $fileName, $fileHash);
            $this->assertNotEmpty($deeplink, 'Deeplink was not received.');
            echo "Received deeplink: $deeplink" . PHP_EOL;
        } catch (Exception $e) {
            $this->fail('Error while obtaining deeplink: ' . $e->getMessage());
        }
    }
}
