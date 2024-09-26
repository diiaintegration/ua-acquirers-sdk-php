<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIDeleteOfferTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testDeleteOffer(): void
    {
        $branchId = 'Branch_Id'; // Branch Identifier
        $offerId = 'Offer_Id'; // Offer Identifier

        try {
            $this->diiaAPI->deleteOffer($branchId, $offerId);
            $this->assertTrue(true);
            echo "Offer with ID $offerId in branch with ID $branchId has been successfully deleted." . PHP_EOL;
        } catch (Exception $e) {
            $this->fail('Error while deleting the offer: ' . $e->getMessage());
        }
    }
}
