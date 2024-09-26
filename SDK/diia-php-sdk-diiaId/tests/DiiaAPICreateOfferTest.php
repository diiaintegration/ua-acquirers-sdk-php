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
        $offerName = 'Offer Name'; // Offer's name
        $scope = 'auth'; // or hashedFilesSigning

        try {
            $offerId = $this->diiaAPI->createOffer($branchId, $offerName, $scope);
            echo "Created Offer ID: " . $offerId . PHP_EOL;
            $this->assertNotEmpty($offerId, 'Offer ID is empty');
        } catch (Exception $e) {
            $this->fail('Failed to create offer: ' . $e->getMessage());
        }
    }
}
