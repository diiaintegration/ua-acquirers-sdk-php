<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPICreateBranchTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testCreateBranch(): void
    {
        $branchData = [
            "name" => "Branch Name",
            "email" => "test@email.com",
            "region" => "Kyiv Region",
            "district" => "Kyivo-Sviatoshynskyi District",
            "location" => "Vyshneve",
            "street" => "Kyivska Street",
            "house" => "2g",
            "customFullName" => "Full name of the requester", // If necessary
            "customFullAddress" => "Full branch address", // If necessary
            "deliveryTypes" => ["api"],
            "offerRequestType" => "dynamic",
            "scopes" => [
                "diiaId" => ["auth"] // Or hashedFilesSigning
            ]
        ];

        try {
            $branchId = $this->diiaAPI->createBranch($branchData);
            echo "Created Branch ID: " . $branchId . PHP_EOL;
            $this->assertNotEmpty($branchId, 'Branch ID is empty');
        } catch (Exception $e) {
            $this->fail('Exception: ' . $e->getMessage());
        }
    }
}
