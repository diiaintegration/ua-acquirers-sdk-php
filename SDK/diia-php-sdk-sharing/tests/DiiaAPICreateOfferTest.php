<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPICreateOfferTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testCreateOffer(): void
    {
        $branchId = 'Branch_Id'; // Branch Identifier
        $offerName = 'Offer Name'; // Name of the Offer
        $scope = ["passport", "driver-license"]; // Specifies the list of documents for sharing; available documents for sharing include: ["passport", "internal-passport", "foreign-passport", "taxpayer-card", "reference-internally-displaced-person", "birth-certificate", "driver-license", "vehicle-license", "student-id-card", "pension-card", "education-document", "veteran-certificate", "name-change-act-record", "marriage-act-record", "divorce-act-record"]

        try {
            $offerId = $this->diiaAPI->createOffer($branchId, $offerName, $scope);
            echo "Created Offer ID: " . $offerId . PHP_EOL;
            $this->assertNotEmpty($offerId, 'Offer ID is empty');
        } catch (Exception $e) {
            $this->fail('Error while creating the offer: ' . $e->getMessage());
        }
    }
}
