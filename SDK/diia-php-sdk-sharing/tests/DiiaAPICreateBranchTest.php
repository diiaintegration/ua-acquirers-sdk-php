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
                "sharing" => ["passport", "driver-license"] // Grants the branch access to share "passport" and "driver-license" documents; available documents for sharing include: ["passport", "internal-passport", "foreign-passport", "taxpayer-card", "reference-internally-displaced-person", "birth-certificate", "driver-license", "vehicle-license", "student-id-card", "pension-card", "education-document", "veteran-certificate", "name-change-act-record", "marriage-act-record", "divorce-act-record"]
            ]
        ];

        try {
            $branchId = $this->diiaAPI->createBranch($branchData);
            echo "Created branch ID: " . $branchId . PHP_EOL;
            $this->assertNotEmpty($branchId, 'Error while creating the branch');
        } catch (Exception $e) {
            $this->fail('Exception: ' . $e->getMessage());
        }
    }
}
