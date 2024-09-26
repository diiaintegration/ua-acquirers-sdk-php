<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIGetOffersTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testGetOffers(): void
    {
        $branchId = 'Branch_Id'; // Replace with a real branch ID
        $skip = 0;
        $limit = 100;

        try {
            // Calling the method to get offers
            $offers = $this->diiaAPI->getOffers($branchId, $skip, $limit);
            echo "Received list of offers: " . json_encode($offers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;

            // Checking that the result is an array
            $this->assertIsArray($offers, 'The result is not an array');

            // Checking that the total number of offers (if any) is greater than or equal to zero
            $this->assertArrayHasKey('total', $offers);
            $this->assertGreaterThanOrEqual(0, $offers['total'], 'The total number of offers must be greater than or equal to zero.');

            // Checking that the offers are an array
            $this->assertArrayHasKey('offers', $offers);
            $this->assertIsArray($offers['offers'], 'Offers are not an array');
        } catch (Exception $e) {
            $this->fail('Error while getting the list of offers: ' . $e->getMessage());
        }
    }
}
