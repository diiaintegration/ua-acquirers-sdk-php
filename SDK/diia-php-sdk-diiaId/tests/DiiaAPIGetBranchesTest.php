<?php
use PHPUnit\Framework\TestCase;
use Tests\TestsHelper;

class DiiaAPIGetBranchesTest extends TestCase
{
    private $diiaAPI;

    protected function setUp(): void
    {
        $this->diiaAPI = TestsHelper::getInstanceOfDiiaAPI();
    }

    public function testGetBranches(): void
    {
        try {
            // Call the method to get branches
            $branches = $this->diiaAPI->getBranches();
            echo "List of branches: " . json_encode($branches, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;

            // Check that the returned branches are not empty
            $this->assertNotEmpty($branches, 'The list of branches is empty');
        } catch (Exception $e) {
            $this->fail('Exception: ' . $e->getMessage());
        }
    }
}
