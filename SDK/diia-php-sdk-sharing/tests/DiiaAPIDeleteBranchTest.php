<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIDeleteBranchTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testDeleteBranch(): void
    {
        $branchId = 'Branch_Id'; // Branch Identifier

        try {
            $this->diiaAPI->deleteBranch($branchId);
            $this->assertTrue(true);
            echo "Branch with ID $branchId was successfully deleted." . PHP_EOL;
        } catch (Exception $e) {
            $this->fail('Error while deleting branch: ' . $e->getMessage());
        }
    }
}
